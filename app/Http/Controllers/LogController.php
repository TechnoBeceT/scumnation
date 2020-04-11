<?php

namespace App\Http\Controllers;

use App\Helpers\EloCalculator;
use App\Models\Logs\Admin;
use App\Models\Logs\Kill;
use App\Models\Logs\Login;
use App\Models\Users\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
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

            //IP pharse
            $ip = str_replace("'", '', $loginRows[1]);

            //SteamID Pharse
            $catchSteamID = preg_match("/\\'[\d\.-]+ [\d]*[\d]{17}\:/", $request['logLine'], $catchedSteamID);
            $steamID = str_replace(':', '', explode(' ', $catchedSteamID[0]))[1];

            //UserID Pharse
            $catchUserID = preg_match('/\([\d]*\)\' logged in/', $request['logLine'], $catchedUserID);
            $userID = str_replace(")'", '', str_replace('(', '', str_replace(':', '', explode(' ', $catchedUserID[0]))))[0];

            //Searching for User with SteamID in Users Table
            $checkUser = User::where('steamid', $steamID)->first();

            //If checkUser returning Null
            if (is_null($checkUser)) {
                //Create new User
                $user = User::create([
                    'steamid' => $steamID,
                    'scumid' => $userID,
                    'last_login' => $fullDate
                ]);
                //If User Created
                if ($user) {
                    $userCreate = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=52A66B13219F645834149F1A1180770A&steamids='.$steamID);
                    $userCreateParse = json_decode($userCreate);
                    foreach($userCreateParse->response->players as $player) {
                        $newUserAvatar = User::where('steamid', $player->steamid)->first();
                        $newUserAvatar->nickname = $player->personaname;
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
                    return response()->json([
                        'status' => 'Success',
                        'response' => 'Login Log Added'
                    ], 200);
                } else {
                    //Return Failed Response
                    return response()->json([
                        'status' => 'Failed',
                        'response' => 'Could not create user'
                    ], 500);
                }
                //If this user is exists in the database
            } else {
                $userCreate = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=52A66B13219F645834149F1A1180770A&steamids='.$steamID);
                    $userCreateParse = json_decode($userCreate);
                    foreach($userCreateParse->response->players as $player) {
                        $newUserAvatar = User::where('steamid', $player->steamid)->first();
                        $newUserAvatar->nickname = $player->personaname;
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
                $checkUser->last_login = $fullDate;
                $checkUser->save();
                //Create New Login Log
                Login::create([
                    'user_id' => $checkUser->id,
                    'date' => $fullDate,
                    'action' => Login::LOGGED_IN
                ]);
                //Return Success Response
                return response()->json([
                    'status' => 'Success',
                    'response' => 'Login Log Added'
                ], 200);
            }
            //If line is about game version
        } elseif (count($loginRows) === 4 && $loginRows[1] === 'Game' && $loginRows[2] === 'version:') {
            //Return Failed Response
            return response()->json([
                'status' => 'Failed',
                'response' => 'Game Version Line'
            ], 406);
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
                return response()->json([
                    'status' => 'Failed',
                    'response' => 'User not found'
                ], 404);
            //If this user is exists in the database
            } else {
                //Update user's last logout date
                $checkUser->last_logout = $fullDate;
                $checkUser->save();
                //Create New Login Log
                Login::create([
                    'user_id' => $checkUser->id,
                    'date' => $fullDate,
                    'action' => Login::LOGGED_OUT
                ]);
                //Calculate coins given to player, using last login and logout times
                $ts1 = strtotime($checkUser->last_login);
                $ts2 = strtotime($checkUser->last_logout);
                $seconds_diff = $ts2 - $ts1;
                $time = ($seconds_diff / 3600);
                //Calculated Coins
                $addToCurrency = round($time * 10, 2);
                //Give calculated coins
                $checkUser->currency = $checkUser->currency + $addToCurrency;
                //Return Success Response
                return response()->json([
                    'status' => 'Success',
                    'response' => 'Login Log Added'
                ], 200);
            }
            //If line is unnecessary
        } else {
            //Return Failed Response
            return response()->json([
                'status' => 'Failed',
                'response' => 'Line Is Not The Right Line'
            ], 406);
        }
    }

    public function fetchKillLogs(Request $request)
    {
        $loginRows = str_replace("'", '', explode(' ', $request['logLine']));
        $checkEvent = preg_match('/\(killer participating in game event\)/', $request['logLine'], $checkEventResult);
        $checkLocation = preg_match('/\ \([\d]{17}\) S\[KillerLoc\:/', $request['logLine'], $checkedLocation);

        if (count($loginRows) >= 11 && $loginRows[1] !== 'Game' && $loginRows[2] !== 'version:' && count($checkEventResult) !== 1 && count($checkedLocation) === 1) {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;
            //Victim SteamID Pharse
            $catchVictimSteamID = preg_match('/\ \([\d]{17}\), Killer/', $request['logLine'], $catchedVictimSteamID);
            $victimSteamID = str_replace('(', '', str_replace(',', '', str_replace(')', '', explode(' ', $catchedVictimSteamID[0]))))[1];
            $victim = User::where('steamid', $victimSteamID)->first();
            //Killer SteamID Pharse
            $catchKillerSteamID = preg_match('/\ \([\d]{17}\) S\[KillerLoc\:/', $request['logLine'], $catchedKillerSteamID);
            $killerSteamID = str_replace('(', '', str_replace(')', '', explode(' ', $catchedKillerSteamID[0])))[1];
            $killer = User::where('steamid', $killerSteamID)->first();

            //Killer Location Pharse
            $catchKillerLocation = preg_match('/\ S\[KillerLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+, VictimLoc:/', $request['logLine'], $catchedKillerLocation);
            $killerLocation = explode(' ', str_replace(',', '', str_replace(' S[KillerLoc:', '', $catchedKillerLocation[0])));
            $killerX = $killerLocation[1];
            $killerY = $killerLocation[2];
            $killerZ = $killerLocation[3];

            //Victim Location Pharse
            $catchVictimLocation = preg_match('/, VictimLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+\] C\[KillerLoc:/', $request['logLine'], $catchedVictimLocation);
            $victimLocation = explode(' ', str_replace(']', '', str_replace(',', '', str_replace(', VictimLoc: ', '', $catchedVictimLocation[0]))));
            $victimX = $victimLocation[0];
            $victimY = $victimLocation[1];
            $victimZ = $victimLocation[2];
            if (is_null($victim) || is_null($killer)) {
                //Return Failed Response
                return response()->json([
                    'status' => 'Failed',
                    'response' => 'User not found'
                ], 404);
            }

            $kill = Kill::create([
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
            if ($kill) {
                if ($victim->currency >= 10) {
                    //Give coins to killer
                    $killer->currency = $killer->currency + 10;
                    //Remove coins from victim
                    $victim->currency = $victim->currency - 10;
                }
                $killer->total_kills = $killer->total_kills + 1;
                $victim->total_deads = $victim->total_deads + 1;
                $calculateElo = new EloCalculator($killer->elo, $victim->elo, EloCalculator::WIN, EloCalculator::LOST);
                $calculateResults = $calculateElo->getNewRatings();
                //Killer Statistical Calculations
                $killer->elo = round(max($calculateResults['Killer'], 0), 2);
                if ($killer->total_deads == 0) {
                    $killer->kd = null;
                } else {
                    $killer->kd = round($killer->total_kills / $killer->total_deads);
                }
                $killer->save();
                //Victim Statistical Calculations
                $victim->elo = round(max($calculateResults['Victim'], 0), 2);
                if ($victim->total_deads == 0) {
                    $victim->kd = null;
                } else {
                    $victim->kd = round($victim->total_kills / $victim->total_deads, 2);
                }
                $victim->save();

                return response()->json([
                    'status' => 'Success',
                    'response' => 'Kill Log Added'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Fail',
                    'response' => 'Something went Wrong'
                ], 200);
            }
        } elseif (count($loginRows) >= 11 && $loginRows[1] !== 'Game' && $loginRows[2] !== 'version:' && count($checkEventResult) === 1 && count($checkedLocation) === 1) {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;
            //Victim SteamID Pharse
            $catchVictimSteamID = preg_match('/\ \([\d]{17}\), Killer/', $request['logLine'], $catchedVictimSteamID);
            $victimSteamID = str_replace('(', '', str_replace(',', '', str_replace(')', '', explode(' ', $catchedVictimSteamID[0]))))[1];
            $victim = User::where('steamid', $victimSteamID)->first();
            //Killer SteamID Pharse
            $catchKillerSteamID = preg_match('/\ \([\d]{17}\) S\[KillerLoc\:/', $request['logLine'], $catchedKillerSteamID);
            $killerSteamID = str_replace('(', '', str_replace(')', '', explode(' ', $catchedKillerSteamID[0])))[1];
            $killer = User::where('steamid', $killerSteamID)->first();

            //Killer Location Pharse
            $catchKillerLocation = preg_match('/\ S\[KillerLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+, VictimLoc:/', $request['logLine'], $catchedKillerLocation);
            $killerLocation = explode(' ', str_replace(',', '', str_replace(' S[KillerLoc:', '', $catchedKillerLocation[0])));
            $killerX = $killerLocation[1];
            $killerY = $killerLocation[2];
            $killerZ = $killerLocation[3];

            //Victim Location Pharse
            $catchVictimLocation = preg_match('/, VictimLoc: [\d\.-]+, [\d\.-]+, [\d\.-]+\] C\[KillerLoc:/', $request['logLine'], $catchedVictimLocation);
            $victimLocation = explode(' ', str_replace(']', '', str_replace(',', '', str_replace(', VictimLoc: ', '', $catchedVictimLocation[0]))));
            $victimX = $victimLocation[0];
            $victimY = $victimLocation[1];
            $victimZ = $victimLocation[2];

            if (is_null($victim) || is_null($killer)) {
                //Return Failed Response
                return response()->json([
                    'status' => 'Failed',
                    'response' => 'User not found'
                ], 404);
            }

            $kill = Kill::create([
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
            if ($kill) {
                if ($victim->currency >= 10) {
                    //Give coins to killer
                    $killer->currency = $killer->currency + 2.5;
                    //Remove coins from victim
                    $victim->currency = $victim->currency - 2.5;
                }
                $killer->total_kills = $killer->total_kills + 1;
                $victim->total_deads = $victim->total_deads + 1;
                $calculateElo = new EloCalculator($killer->elo, $victim->elo, EloCalculator::DRAW, EloCalculator::DRAW);
                $calculateResults = $calculateElo->getNewRatings();
                //Killer Statistical Calculations
                $killer->elo = round(max($calculateResults['Killer'], 0), 2);
                if ($killer->total_deads == 0) {
                    $killer->kd = null;
                } else {
                    $killer->kd = round($killer->total_kills / $killer->total_deads);
                }
                $killer->save();
                //Victim Statistical Calculations
                $victim->elo = round(max($calculateResults['Victim'], 0), 2);
                if ($victim->total_deads == 0) {
                    $victim->kd = null;
                } else {
                    $victim->kd = round($victim->total_kills / $victim->total_deads, 2);
                }
                $victim->save();
                return response()->json([
                    'status' => 'Success',
                    'response' => 'Kill Log Added'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Fail',
                    'response' => 'Something went Wrong'
                ], 200);
            }
        } elseif (count($loginRows) >= 4 && $loginRows[1] === 'Game' && $loginRows[2] === 'version:' || count($checkedLocation) === 0) {
            //Return Failed Response
            return response()->json([
                'status' => 'Failed',
                'response' => 'Line Is Not The Right Line'
            ], 406);
        }
    }

    public function fetchAdminLogs(Request $request)
    {
        $loginRows = str_replace("'", '', explode(' ', $request['logLine']));
        if (count($loginRows) >= 4 && $loginRows[1] === 'Game' && $loginRows[2] === 'version:') {
            //Return Failed Response
            return response()->json([
                'status' => 'Failed',
                'response' => 'Game Version Line'
            ], 406);
        } elseif (count($loginRows) >= 4 && $loginRows[1] !== 'Game' && $loginRows[2] !== 'version:') {
            //Date pharse
            $loginRows[0] = str_replace(':', '', $loginRows[0]);
            $loginDate = explode('-', $loginRows[0]);
            $date0 = str_replace('.', '-', $loginDate[0]);
            $date1 = str_replace('.', ':', $loginDate[1]);
            $fullDate = $date0 . ' ' . $date1;
            //SteamId pharse
            $catchSteamID = preg_match("/[\d\.-]+\: \\'[\d]*[\d]{17}\:/", $request['logLine'], $catchedSteamID);
            $adminSteamID = str_replace("'", '', str_replace(':', '', explode(' ', $catchedSteamID[0])))[1];
            //Command pharse
            $catchAdminCommand = preg_match("/\'\ Command: \'.+/", $request['logLine'], $catchedAdminCommand);
            $adminCommand = str_replace("'", '', explode(': ', $catchedAdminCommand[0]))[1];
            //Getting admin
            $admin = User::where('steamid', $adminSteamID)->first();
            $adminLog = Admin::create([
                'admin_id' => $admin->id,
                'command' => $adminCommand,
                'date' => $fullDate
            ]);
            if ($adminLog) {
                return response()->json([
                    'status' => 'Success',
                    'response' => 'Admin Log Added'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Fail',
                    'response' => 'Something went Wrong'
                ], 200);
            }
        } else {
            //Return Failed Response
            return response()->json([
                'status' => 'Failed',
                'response' => 'Line Is Not The Right Line'
            ], 406);
        }
    }
}
