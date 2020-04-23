<?php

namespace App\Helpers;

class DistanceCalculator
{
     /**
     * Protected & private variables.
     */
    protected $distance;
    /**
     * Constructor function which does all the maths and stores the results ready
     * for retrieval.
     *
     * @param int $ratingKiller Current rating of Killer
     * @param int $ratingVictim Current rating of Victim
     * @param int $scoreKiller Score of Killer
     * @param int $scoreVictim Score of Victim
     */
    public function __construct($killerX, $killerY, $victimX, $victimY)
    {
        $this->setNewSettings($killerX, $killerY, $victimX, $victimY);
    }

    /**
     * Set new input data.
     *
     * @param int $ratingKiller Current rating of Killer
     * @param int $ratingVictim Current rating of Victim
     * @param int $scoreKiller Score of Killer
     * @param int $scoreVictim Score of Victim
     * @return self
     */
    public function setNewSettings($killerX, $killerY, $victimX, $victimY)
    {
        $x = $this->squareIt(abs($killerX) - abs($victimX));
        $y = $this->squareIt(abs($killerY) - abs($victimY));
        $distance = sqrt($x + $y);
        $this->distance =  round(($distance / 100), 2);
        return $this;
    }

    /**
     * Calculate the Sector Letter.
     *
     * @return string Letter.
     */
    public function squareIt($number)
    {
        return $number * $number;
    }

    public function getDistance()
    {
        return $this->distance;
    }
}
