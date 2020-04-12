<?php

namespace App\Traits\Models;

use App\Models\Finance\Credit;
use App\Models\Finance\History;

trait Finance
{

    /**
     * Get the credit amount for specified user
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function credit()
    {
        return $this->hasOne(Credit::class, 'user_id');
    }

    /**
     * Get the credit amount for specified user
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(History::class, 'user_id');
    }

    /**
     * Handles updating the user's credits
     *
     * @param $amount
     * @return mixed
     */
    public function updateCredits($amount)
    {
        $credits = Credit::where('user_id', '=', $this->id)->first();
        $credits->amount = $amount;
        $credits->save();

        return $credits;
    }

    /**
     * Handles adding more credits to the user's existing
     * amount of credits.
     *
     * @param $amount
     * @return mixed
     */
    public function addCredits($amount)
    {
        $credits = Credit::where('user_id', '=', $this->id)->first();
        $credits->amount = $credits->amount + $amount;
        $credits->save();

        return $credits;
    }


    /**
     * Handles deducting credits from the user's existing
     * amount of credits
     *
     * @param $amount
     * @return mixed
     */
    public function deductCredits($amount)
    {
        $credits = Credit::where('user_id', '=', $this->id)->first();
        $credits->amount = $credits->amount - $amount;
        $credits->save();

        return $credits;
    }
}
