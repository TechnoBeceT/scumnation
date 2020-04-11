<?php

namespace App\Helpers;

class EloCalculator
{
    /**
    * @var int The K Factor used.
    */
    const KFACTOR = 16;
    const WIN = 1;
    const DRAW = 0.5;
    const LOST = 0;
    /**
     * Protected & private variables.
     */
    protected $_ratingKiller;
    protected $_ratingVictim;

    protected $_scoreKiller;
    protected $_scoreVictim;
    protected $_expectedKiller;
    protected $_expectedVictim;
    protected $_newRatingKiller;
    protected $_newRatingVictim;

    /**
     * Constructor function which does all the maths and stores the results ready
     * for retrieval.
     *
     * @param int $ratingKiller Current rating of Killer
     * @param int $ratingVictim Current rating of Victim
     * @param int $scoreKiller Score of Killer
     * @param int $scoreVictim Score of Victim
     */
    public function __construct($ratingKiller, $ratingVictim, $scoreKiller, $scoreVictim)
    {
        $this->setNewSettings($ratingKiller, $ratingVictim, $scoreKiller, $scoreVictim);
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
    public function setNewSettings($ratingKiller, $ratingVictim, $scoreKiller, $scoreVictim)
    {
        $this->_ratingKiller = $ratingKiller;
        $this->_ratingVictim = $ratingVictim;
        $this->_scoreKiller = $scoreKiller;
        $this->_scoreVictim = $scoreVictim;
        $expectedScores = $this->_getExpectedScores($this->_ratingKiller, $this->_ratingVictim);
        $this->_expectedKiller = $expectedScores['Killer'];
        $this->_expectedVictim = $expectedScores['Victim'];
        $newRatings = $this->_getNewRatings($this->_ratingKiller, $this->_ratingVictim, $this->_expectedKiller, $this->_expectedVictim, $this->_scoreKiller, $this->_scoreVictim);
        $this->_newRatingKiller = $newRatings['Killer'];
        $this->_newRatingVictim = $newRatings['Victim'];
        return $this;
    }

    /**
     * Retrieve the calculated data.
     *
     * @return array An array containing the new ratings for Killer and Victim.
     */
    public function getNewRatings()
    {
        return [
            'Killer' => $this->_newRatingKiller,
            'Victim' => $this->_newRatingVictim
        ];
    }

    // Protected & private functions begin here

    /**
     * @param int $ratingKiller The Rating of Player Killer
     * @param int $ratingVictim The Rating of Player Victim
     * @return array
     */
    protected function _getExpectedScores($ratingKiller, $ratingVictim)
    {
        $expectedScoreKiller = 1 / (1 + (pow(10, ($ratingVictim - $ratingKiller) / 400)));
        $expectedScoreVictim = 1 / (1 + (pow(10, ($ratingKiller - $ratingVictim) / 400)));
        return [
            'Killer' => $expectedScoreKiller,
            'Victim' => $expectedScoreVictim
        ];
    }

    /**
     * @param int $ratingKiller The Rating of Player Killer
     * @param int $ratingVictim The Rating of Player Killer
     * @param int $expectedKiller The expected score of Player Killer
     * @param int $expectedVictim The expected score of Player Victim
     * @param int $scoreKiller The score of Player Killer
     * @param int $scoreVictim The score of Player Victim
     * @return array
     */
    protected function _getNewRatings($ratingKiller, $ratingVictim, $expectedKiller, $expectedVictim, $scoreKiller, $scoreVictim)
    {
        $newRatingKiller = $ratingKiller + (self::KFACTOR * ($scoreKiller - $expectedKiller));
        $newRatingVictim = $ratingVictim + (self::KFACTOR * ($scoreVictim - $expectedVictim));
        return [
            'Killer' => $newRatingKiller,
            'Victim' => $newRatingVictim
        ];
    }
}
