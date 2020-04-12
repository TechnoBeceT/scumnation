<?php

namespace App\Http\Controllers;

use App\Helpers\EloCalculator;
use App\Models\Logs\Admin;
use App\Models\Logs\Kill;
use App\Models\Logs\Login;
use App\Models\Users\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class LogController extends Controller
{
    use ApiResponser;
    
    public function fetchLoginLogs(Request $request)
    {
        $loginRows = str_replace("'", '', explode(' ', $request['logLine']));
        //If line is about player login
        if (count($loginRows) >= 4 && $loginRows[1] !== 'Game' && $loginRows[2] !== 'version:' && $loginRows[2] !== 'logging' && $loginRows[3] !== 'out') {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;
            preg_match("/\\'[\d\.-]+ [\d]*[\d]{17}\:.*' /", $request['logLine'], $catchedCharacterName);
            $characterName = preg_replace('/\([\d]*\)\'/', '', explode(':', $catchedCharacterName[0])[1]);;
            

            //IP pharse
            $ip = str_replace("'", '', $loginRows[1]);

            //SteamID Pharse
            preg_match("/\\'[\d\.-]+ [\d]*[\d]{17}\:/", $request['logLine'], $catchedSteamID);
            $steamID = str_replace(':', '', explode(' ', $catchedSteamID[0]))[1];

            //UserID Pharse
            preg_match('/\([\d]*\)\' logged in/', $request['logLine'], $catchedUserID);
            $userID = str_replace(")'", '', str_replace('(', '', str_replace(':', '', explode(' ', $catchedUserID[0]))))[0];

            //Searching for User with SteamID in Users Table
            $checkUser = User::where('steamid', $steamID)->first();

            //If checkUser returning Null
            if (is_null($checkUser)) {
                try {
                    //Create new User
                    $user = User::create([
                        'steamid' => $steamID,
                        'scumid' => $userID,
                    ]);
                    $user->statistics()->update([
                        'last_login' => $fullDate,
                    ]);
                    //If User Created
                    $userCreate = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=52A66B13219F645834149F1A1180770A&steamids='.$steamID);
                    $userCreateParse = json_decode($userCreate);
                    foreach($userCreateParse->response->players as $player) {
                        $newUserAvatar = User::where('steamid', $player->steamid)->first();
                        $newUserAvatar->steam_name = $player->personaname;
                        $newUserAvatar->nickname = $characterName;
                        $newUserAvatar->avatar   = $player->avatarfull;
                        $newUserAvatar->save();
                    }
                    //Create New Login Log
                    Login::create([
                        'user_id' => $user->id,
                        'date' => $fullDate,
                        'action' => Login::LOGGED_IN
                    ]);
                    //Return Success Response
                    return $this->successResponse(['status' => 'Success', 'response' => 'Login Log Added'], 200);
                } catch (\Throwable $th) {
                    //Return Failed Response
                    return $this->errorResponse(['status' => 'Failed', 'response' => 'Could not create user'], 500);
                }
            //If this user is exists in the database
            } else {
                try {
                    $userCreate = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=52A66B13219F645834149F1A1180770A&steamids='.$steamID);
                        $userCreateParse = json_decode($userCreate);
                        foreach($userCreateParse->response->players as $player) {
                            $newUserAvatar = User::where('steamid', $player->steamid)->first();
                            $newUserAvatar->steam_name = $player->personaname;
                            $newUserAvatar->nickname = $characterName;
                            $newUserAvatar->avatar   = $player->avatarfull;
                            $newUserAvatar->save();
                        }
                    //If the incoming UserID is not the same as the UserID in the database write new UserID to database
                    if ($checkUser->scumid !== $userID) {
                        //Find old user with this UserID and change to NULL
                        $oldUser = User::where('scumid', $userID)->first();
                        if (!is_null($oldUser)) {
                            $oldUser->scumid = null;
                            $oldUser->save();
                        }
                        $checkUser->scumid = $userID;
                        $checkUser->save();
                    }
                    //Update user's last login date
                    $checkUser->statistics()->update([
                        'last_login' => $fullDate,
                    ]);
                    //Create New Login Log
                    Login::create([
                        'user_id' => $checkUser->id,
                        'date' => $fullDate,
                        'action' => Login::LOGGED_IN
                    ]);
                    //Return Success Response
                    return $this->successResponse(['status' => 'Success', 'response' => 'Login Log Added'], 200);
                } catch (\Throwable $th) {
                    //Return Failed Response
                    return $this->errorResponse(['status' => 'Failed', 'response' => 'Something went wrong'], 500);
                }
            }
            //If line is about game version
        } elseif (count($loginRows) === 4 && $loginRows[1] === 'Game' && $loginRows[2] === 'version:') {
            //Return Failed Response
            return $this->errorResponse(['status' => 'Failed', 'response' => 'Game Version Line'], 406);
        //If line is about player logout
        } elseif (count($loginRows) === 4 && $loginRows[2] === 'logging' && $loginRows[3] === 'out') {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;

            //UserID pharse
            $userID = $loginRows[1];

            //Searching for User with UserID in Users Table
            $checkUser = User::where('scumid', $userID)->first();

            //If checkUser returning Null
            if (is_null($checkUser)) {
                //Return Failed Response
                return $this->errorResponse(['status' => 'Failed', 'response' => 'User not found'], 404);
            //If this user is exists in the database
            } else {
                try {
                    //Update user's last logout date
                    $checkUser->statistics()->update([
                        'last_logout' => $fullDate,
                    ]);
                    //Create New Login Log
                    Login::create([
                        'user_id' => $checkUser->id,
                        'date' => $fullDate,
                        'action' => Login::LOGGED_OUT
                    ]);
                    //Calculate coins given to player, using last login and logout times
                    $ts1 = strtotime($checkUser->statistics->last_login);
                    $ts2 = strtotime($checkUser->statistics->last_logout);
                    $seconds_diff = $ts2 - $ts1;
                    $time = ($seconds_diff / 3600);
                    //Calculated Coins
                    $addToCurrency = round($time * 10, 2);
                    //Give calculated coins
                    $checkUser->addCredits($addToCurrency);
                    //Return Success Response
                    return $this->successResponse(['status' => 'Success', 'response' => 'Login Log Added'], 200);
                } catch (\Throwable $th) {
                    //Return Failed Response
                    return $this->errorResponse(['status' => 'Failed', 'response' => 'Something went wrong'], 500);
                }
            }
            //If line is unnecessary
        } else {
            //Return Failed Response
            return $this->errorResponse(['status' => 'Failed', 'response' => 'Line Is Not The Right Line'], 406);
        }
    }

    public function fetchKillLogs(Request $request)
    {
        $loginRows = str_replace("'", '', explode(' ', $request['logLine']));
        preg_match('/\(killer participating in game event\)/', $request['logLine'], $checkEventResult);
        preg_match('/\ \([\d]{17}\) S\[KillerLoc\:/', $request['logLine'], $checkedLocation);

        if (count($loginRows) >= 11 && $loginRows[1] !== 'Game' && $loginRows[2] !== 'version:' && count($checkEventResult) !== 1 && count($checkedLocation) === 1) {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;
            //Victim SteamID Pharse
            preg_match('/\ \([\d]{17}\), Killer/', $request['logLine'], $catchedVictimSteamID);
            $victimSteamID = str_replace('(', '', str_replace(',', '', str_replace(')', '', explode(' ', $catchedVictimSteamID[0]))))[1];
            $victim = User::where('steamid', $victimSteamID)->first();
            //Killer SteamID Pharse
            preg_match('/\ \([\d]{17}\) S\[KillerLoc\:/', $request['logLine'], $catchedKillerSteamID);
            $killerSteamID = str_replace('(', '', str_replace(')', '', explode(' ', $catchedKillerSteamID[0])))[1];
            $killer = User::where('steamid', $killerSteamID)->first();

            //Killer Location Pharse
            preg_match('/\ S\[KillerLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+, VictimLoc:/', $request['logLine'], $catchedKillerLocation);
            $killerLocation = explode(' ', str_replace(',', '', str_replace(' S[KillerLoc:', '', $catchedKillerLocation[0])));
            $killerX = $killerLocation[1];
            $killerY = $killerLocation[2];
            $killerZ = $killerLocation[3];

            //Victim Location Pharse
            preg_match('/, VictimLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+\] C\[KillerLoc:/', $request['logLine'], $catchedVictimLocation);
            $victimLocation = explode(' ', str_replace(']', '', str_replace(',', '', str_replace(', VictimLoc: ', '', $catchedVictimLocation[0]))));
            $victimX = $victimLocation[0];
            $victimY = $victimLocation[1];
            $victimZ = $victimLocation[2];
            if (is_null($victim) || is_null($killer)) {
                //Return Failed Response
                return $this->errorResponse(['status' => 'Failed', 'response' => 'User not found'], 404);
            }

            try {
                Kill::create([
                    'killer_id' => $killer->id,
                    'killerX' => $killerX,
                    'killerY' => $killerY,
                    'killerZ' => $killerZ,
                    'victim_id' => $victim->id,
                    'victimX' => $victimX,
                    'victimY' => $victimY,
                    'victimZ' => $victimZ,
                    'type' => Kill::NOT_EVENT,
                    'date' => $fullDate
                ]);

                if ($victim->credit->amount >= 10) {
                    //Give coins to killer
                    $killer->addCredits(10);
                    //Remove coins from victim
                    $victim->deductCredits(10);
                }
                $killer->addKill(1);
                $victim->addDeath(1);
                $calculateElo = new EloCalculator($killer->statistics->elo, $victim->statistics->elo, EloCalculator::WIN, EloCalculator::LOST);
                $calculateResults = $calculateElo->getNewRatings();
                //Killer Statistical Calculations
                $killer->statistics()->update([
                    'elo' => round(max($calculateResults['Killer'], 0), 2),
                ]);
                if ($killer->statistics->total_deads == 0 || $killer->statistics->total_kills) {
                    $killer->statistics()->update([
                        'kd' => null,
                    ]);
                } else {
                    $killer->statistics()->update([
                        'kd' => round($killer->statistics->total_kills / $killer->statistics->total_deads),
                    ]);
                }
                //Victim Statistical Calculations
                $victim->statistics()->update([
                    'elo' => round(max($calculateResults['Victim'], 0), 2),
                ]);
                if ($victim->statistics->total_deads == 0 || $victim->statistics->total_kills) {
                    $victim->statistics()->update([
                        'kd' => null,
                    ]);
                } else {
                    $victim->statistics()->update([
                        'kd' => round($victim->statistics->total_kills / $victim->statistics->total_deads, 2),
                    ]);
                }
                return $this->successResponse(['status' => 'Success', 'response' => 'Kill Log Added'], 200);
            } catch (\Throwable $th) {
                return $this->errorResponse(['status' => 'Failed', 'response' => 'Something went wrong'], 500);
            }
        } elseif (count($loginRows) >= 11 && $loginRows[1] !== 'Game' && $loginRows[2] !== 'version:' && count($checkEventResult) === 1 && count($checkedLocation) === 1) {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;
            //Victim SteamID Pharse
            preg_match('/\ \([\d]{17}\), Killer/', $request['logLine'], $catchedVictimSteamID);
            $victimSteamID = str_replace('(', '', str_replace(',', '', str_replace(')', '', explode(' ', $catchedVictimSteamID[0]))))[1];
            $victim = User::where('steamid', $victimSteamID)->first();
            //Killer SteamID Pharse
            preg_match('/\ \([\d]{17}\) S\[KillerLoc\:/', $request['logLine'], $catchedKillerSteamID);
            $killerSteamID = str_replace('(', '', str_replace(')', '', explode(' ', $catchedKillerSteamID[0])))[1];
            $killer = User::where('steamid', $killerSteamID)->first();

            //Killer Location Pharse
            preg_match('/\ S\[KillerLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+, VictimLoc:/', $request['logLine'], $catchedKillerLocation);
            $killerLocation = explode(' ', str_replace(',', '', str_replace(' S[KillerLoc:', '', $catchedKillerLocation[0])));
            $killerX = $killerLocation[1];
            $killerY = $killerLocation[2];
            $killerZ = $killerLocation[3];

            //Victim Location Pharse
            preg_match('/, VictimLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+\] C\[KillerLoc:/', $request['logLine'], $catchedVictimLocation);
            $victimLocation = explode(' ', str_replace(']', '', str_replace(',', '', str_replace(', VictimLoc: ', '', $catchedVictimLocation[0]))));
            $victimX = $victimLocation[0];
            $victimY = $victimLocation[1];
            $victimZ = $victimLocation[2];

            if (is_null($victim) || is_null($killer)) {
                //Return Failed Response
                return $this->errorResponse(['status' => 'Failed', 'response' => 'User not found'], 404);
            }

            try {
                Kill::create([
                    'killer_id' => $killer->id,
                    'killerX' => $killerX,
                    'killerY' => $killerY,
                    'killerZ' => $killerZ,
                    'victim_id' => $victim->id,
                    'victimX' => $victimX,
                    'victimY' => $victimY,
                    'victimZ' => $victimZ,
                    'type' => Kill::IS_EVENT,
                    'date' => $fullDate
                ]);

                if ($victim->currency >= 3) {
                    //Give coins to killer
                    $killer->addCredits(2.5);
                    //Remove coins from victim
                    $victim->deductCredits(2.5);
                }
                $killer->addKill(1);
                $victim->addDeath(1);
                $calculateElo = new EloCalculator($killer->statistics->elo, $victim->statistics->elo, EloCalculator::DRAW, EloCalculator::DRAW);
                $calculateResults = $calculateElo->getNewRatings();
                //Killer Statistical Calculations
                $killer->statistics()->update([
                    'elo' => round(max($calculateResults['Killer'], 0), 2),
                ]);
                if ($killer->statistics->total_deads == 0 || $killer->statistics->total_kills) {
                    $killer->statistics()->update([
                        'kd' => null,
                    ]);
                } else {
                    $killer->statistics()->update([
                        'kd' => round($killer->statistics->total_kills / $killer->statistics->total_deads),
                    ]);
                }
                //Victim Statistical Calculations
                $victim->statistics()->update([
                    'elo' => round(max($calculateResults['Victim'], 0), 2),
                ]);
                if ($victim->statistics->total_deads == 0 || $victim->statistics->total_kills) {
                    $victim->statistics()->update([
                        'kd' => null,
                    ]);
                } else {
                    $victim->statistics()->update([
                        'kd' => round($victim->statistics->total_kills / $victim->statistics->total_deads, 2),
                    ]);
                }
                return $this->successResponse(['status' => 'Success', 'response' => 'Kill Log Added'], 200);
            } catch (\Throwable $th) {
                return $this->errorResponse(['status' => 'Failed', 'response' => 'Something went wrong'], 500);
            }

        } elseif (count($loginRows) >= 4 && $loginRows[1] === 'Game' && $loginRows[2] === 'version:' || count($checkedLocation) === 0) {
            //Return Failed Response
            return $this->errorResponse(['status' => 'Failed', 'response' => 'Line Is Not The Right Line'], 406);
        }
    }

    public function fetchAdminLogs(Request $request)
    {
        $loginRows = str_replace("'", '', explode(' ', $request['logLine']));
        if (count($loginRows) >= 4 && $loginRows[1] === 'Game' && $loginRows[2] === 'version:') {
            //Return Failed Response
            return $this->errorResponse(['status' => 'Failed', 'response' => 'Game Version Line'], 406);
        } elseif (count($loginRows) >= 4 && $loginRows[1] !== 'Game' && $loginRows[2] !== 'version:') {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;
            //SteamId pharse
            preg_match("/[\d\.-]+\: \\'[\d]*[\d]{17}\:/", $request['logLine'], $catchedSteamID);
            $adminSteamID = str_replace("'", '', str_replace(':', '', explode(' ', $catchedSteamID[0])))[1];
            //Command pharse
            preg_match("/\'\ Command: \'.+/", $request['logLine'], $catchedAdminCommand);
            $adminCommand = str_replace("'", '', explode(': ', $catchedAdminCommand[0]))[1];
            try {
                //Getting admin
                $admin = User::where('steamid', $adminSteamID)->first();
                Admin::create([
                    'admin_id' => $admin->id,
                    'command' => $adminCommand,
                    'date' => $fullDate
                ]);
                return $this->successResponse(['status' => 'Success', 'response' => 'Admin Log Added'], 200);
            } catch (\Throwable $th) {
                return $this->errorResponse(['status' => 'Failed', 'response' => 'Something went wrong'], 500);
            }
        } else {
            //Return Failed Response
            return $this->errorResponse(['status' => 'Failed', 'response' => 'Line Is Not The Right Line'], 406);
        }
    }
}
