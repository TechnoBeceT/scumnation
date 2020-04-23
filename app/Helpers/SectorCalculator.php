<?php

namespace App\Helpers;

class SectorCalculator
{
    /**
     * Protected & private variables.
     */
    protected $sector;
    /**
     * Constructor function which does all the maths and stores the results ready
     * for retrieval.
     *
     * @param int $ratingKiller Current rating of Killer
     * @param int $ratingVictim Current rating of Victim
     * @param int $scoreKiller Score of Killer
     * @param int $scoreVictim Score of Victim
     */
    public function __construct($killerX, $killerY)
    {
        $this->setNewSettings($killerX, $killerY);
    }

    /**
     * Set new input data.
     *
     * @param int $killerX Killer 
     * @param int $ratingVictim Current rating of Victim
     * @param int $scoreKiller Score of Killer
     * @param int $scoreVictim Score of Victim
     * @return self
     */
    public function setNewSettings($killerX, $killerY)
    {
        $letter = $this->getLetter($killerX);
        $number = $this->getNumber($killerY);

        $sector = $letter . $number;
        $this->sector = $sector;
        return $this;
    }

    /**
     * Calculate the Sector Letter.
     *
     * @return string Letter.
     */
    public function getNumber($killerX)
    {
        $number = '';
        if($killerX < 630000 && $killerX > 320000) {
            $number = '4';
        }
        if($killerX < 320000 && $killerX > 0) {
            $number = '3';
        }

        if($killerX < 0 && $killerX > -320000) {
            $number = '2';
        } 
          
        if($killerX < -320000) {
            $number = '1';
        }
        
        return $number;
    }

    /**
     * Calculate the Sector Number.
     * 
     * @return string Number.
     */
    public function getLetter($killerY)
    {
        $letter = '';
        if($killerY < 630000 && $killerY > 320000) {
            $letter = 'D';
        }
      
        if($killerY < 320000 && $killerY > 0) {
            $letter = 'C';
        }
    
        if($killerY < 0 && $killerY > -320000) {
            $letter = 'B';
        } 
        
        if($killerY < -320000) {
            $letter = 'A';
        }
        
        return $letter;
    }

    public function getSector()
    {
        return $this->sector;
    }
}
