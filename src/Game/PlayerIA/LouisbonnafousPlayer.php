<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class LouisbonnafousPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class LouisbonnafousPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    protected $myPreviousChoice;
    protected $enemyPreviousChoice;

    public function getWinningMove($move) {
        if ($move == 'rock') {
            return 'paper';
        }
        if ($move == 'paper') {
            return 'scissors';
        }
        if ($move == 'scissors') {
            return 'rock';
        }
        return 'rock';
    }

    public function getLosingMove($move) {
        if ($move == 'rock') {
            return 'scissors';
        }
        if ($move == 'scissors') {
            return 'paper';
        }
        if ($move == 'paper') {
            return 'rock';
        }
        return 'paper';
    }

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        $myLastChoice = $this->result->getLastChoiceFor($this->mySide);
        $lastEnemyChoice = $this->result->getLastChoiceFor($this->opponentSide);
        $lastEnemyScore = $this->result->getLastScoreFor($this->opponentSide);
        $enemyStats = $this->result->getStatsFor($this->opponentSide);
        
        //$allEnemyChoices = $this->result->getChoicesFor($this->opponentSide);
        
        $mynextmove = 'rock';

        if ($this->result->getNbRound() > 300) {
            if ($lastEnemyScore == 3) { // Enemi a gagné avant
                $mynextmove = $lastEnemyChoice;;
            } else if ($lastEnemyScore == 1) { // Enemi a fait nul avant
                $mynextmove = $this->getWinningMove($lastEnemyChoice);
            } else if ($lastEnemyChoice != 0) { // Enemi a perdu avant
                $mynextmove = $this->getLosingMove($lastEnemyChoice);
            }   
        } else {
            if ($lastEnemyScore == 3) { // Enemi a gagné avant
                $mynextmove = $this->getWinningMove($lastEnemyChoice);
            } else if ($lastEnemyScore == 1) { // Enemi a fait nul avant
                $mynextmove = $this->getLosingMove($lastEnemyChoice);
            } else if ($lastEnemyChoice != 0) { // Enemi a perdu avant
                $mynextmove = $lastEnemyChoice;
            }   
        }
        //$myPreviousChoice = $myLastChoice;
        //$enemyPreviousChoice = $lastEnemyChoice;
        return $mynextmove;           
  }
};
