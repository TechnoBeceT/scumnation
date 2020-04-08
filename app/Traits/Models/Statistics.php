<?php

namespace App\Traits\Models;

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
     * Handles adding more credits to the user's existing
     * amount of credits.
     *
     * @param $amount
     * @return mixed
     */
    public function addDead($amount)
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
