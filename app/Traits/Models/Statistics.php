<?php

namespace App\Traits\Models;

use App\Models\Users\FamePoint;
use App\Models\Users\Statistic;

trait Statistics
{

    /**
     * Get user's statistics.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statistics()
    {
        return $this->hasOne(Statistic::class, 'user_id');
    }

    /**
     * Get user's fame points.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function famePoints()
    {
        return $this->hasOne(FamePoint::class, 'user_id');
    }

    /**
     * Handles adding more credits to the user's existing
     * amount of credits.
     *
     * @param $amount
     * @return mixed
     */
    public function addKill($amount)
    {
        $statistics = Statistic::where('user_id', '=', $this->id)->first();
        $statistics->total_kills = $statistics->total_kills + $amount;
        $statistics->save();

        return $statistics;
    }

    /**
     * Handles adding more fame points to the user's existing
     * amount of fame points.
     *
     * @param $amount
     * @return mixed
     */
    public function addFame($amount)
    {
        $famePoints = FamePoint::where('user_id', '=', $this->id)->first();
        $famePoints->amount = $famePoints->amount + $amount;
        $famePoints->save();

        return $famePoints;
    }

    /**
     * Handles deducting fame points from the user's existing
     * amount of fame points.
     *
     * @param $amount
     * @return mixed
     */
    public function deductFame($amount)
    {
        $famePoints = FamePoint::where('user_id', '=', $this->id)->first();
        $famePoints->amount = $famePoints->amount - $amount;
        $famePoints->save();

        return $famePoints;
    }


    /**
     * Handles adding more credits to the user's existing
     * amount of credits.
     *
     * @param $amount
     * @return mixed
     */
    public function addDeath($amount)
    {
        $statistics = Statistic::where('user_id', '=', $this->id)->first();
        $statistics->total_deads = $statistics->total_deads + $amount;
        $statistics->save();

        return $statistics;
    }

    /**
     * Handles updating the user's credits
     *
     * @param $amount
     * @return mixed
     */
    public function updateKD($amount)
    {
        $statistics = Statistic::where('user_id', '=', $this->id)->first();
        $statistics->kd = $amount;
        $statistics->save();

        return $statistics;
    }

    /**
     * Handles updating the user's credits
     *
     * @param $amount
     * @return mixed
     */
    public function updateELO($amount)
    {
        $statistics = Statistic::where('user_id', '=', $this->id)->first();
        $statistics->elo = $amount;
        $statistics->save();

        return $statistics;
    }
}
