<?php

namespace App;

use App\Contracts\Board;
use App\Contracts\Player;
use App\Contracts\Boneyard;
use App\Implementations\CliOutput;
use App\Iterators\CircularIterator;
use App\Exceptions\InvalidBoneException;

class Game
{
    /**
     * @var Boneyard 
     */
    private $boneyard;

    /**
     * @var Player
     */
    private $players;

    /**
     * @var Output
     */
    private $output;

    /**
     * @var Board
     */
    private $board;

    /**
     * @var Player 
     */
    private $previousPlayer;

    /**
     * @var Player
     */
    private $currentPlayer;

    /**
     * this specofoes how many bones each player gets to have
     */
    const HAND_SIZE = 7;

    /**
     * @param Players [] $players
     */
    public function __construct(Board $board, Boneyard $boneyard, CliOutput $output, $players)
    {
        $this->board = $board;
        $this->boneyard = $boneyard;
        $this->players = $players;
        $this->output = $output;
    }

    /**
     * @param Player $player
     * @return self
     */
    public function setCurrentPlayer(Player $player): self
    {
        $this->currentPlayer = $player;
        return $this;
    }

    /**
     * @return Player
     */
    public function getCurrentPlayer(): Player
    {
        return $this->currentPlayer;
    }

    /**
     * @param Player $player
     * @return self
     */
    public function setPreviousPlayer(Player $player): self
    {
        $this->previousPlayer = $player;
        return $this;
    }

    /**
     * @return Player $player
     */
    public function getPreviousPlayer()
    {
        return $this->previousPlayer;
    }

    /**
     * initializes the Game
     */
    public function initializeGame()
    {
        $this->distributeBones();
        $this->initializeBoard();
        $this->output->showWelcome();
        $this->output->displayBoard($this->board);
        $this->enterGameLoop();
    }

    /**
     * initiailizes the baord using one bone from the boneyard
     */
    public function initializeBoard()
    {
        $this->board->insertBone($this->boneyard->drawOne());
    }

    /**
     * distributes bones among the players
     * @param
     */
    public function distributeBones()
    {
        foreach ($this->players as $player) {
            $player->addBones($this->boneyard->draw(self::HAND_SIZE));
        }
    }

    /**
     * Exits the game
     */
    public function exit()
    {
        exit(0);
    }

    public function enterGameLoop()
    {
        foreach (new CircularIterator($this->players) as $player) {
            $this->setCurrentPlayer($player);
            var_dump("current player", $this->getCurrentPlayer()->getName());
            
            if ($bone = $this->placeBone()) {
                $this->output->bonePlaced($this->getCurrentPlayer(), $bone);
                $this->output->displayBoard($this->board);
            } else {
                $this->output->gameBlocked($this->getCurrentPlayer(), $this->previousPlayer);
                $this->exit();
            }

            if ($this->getCurrentPlayer()->isEmpty()) {
                $this->output->playerWon($this->getCurrentPlayer(), $bone);
                $this->exit();
            }

            $this->setPreviousPlayer($this->getCurrentPlayer());
        }
    }

    public function placeBone()
    {
        while (
            /**
             * expr == if there is no matching bone to insert for player
             * then execute the statement (player draws from the boneyard,
             * if the boneyard is not empty and then tries to insert a bone again
             * ), this loop continues until the boneyard is empty.
             */
            !$bone =  $this->insertMatchingBone($this->currentPlayer)
        ) {
            if (!$this->boneyard->isEmpty()) {
                // var_dump("boneyard is not empty");
                $this->currentPlayer->addBone($this->boneyard->drawOne());
                $this->output->playerDrawsFromBoneyard($this->currentPlayer);
                continue;
            }
            // var_dump("bone yard is empty");
            return false;
        }

        // var_dump("while loop didnt run cuz there was a matching bone for player");
        return $bone;
    }

    public function insertMatchingBone(Player $player)
    {
        try {
            if (
                $bone =  $player->drawMatchingBone($this->board->getTopBone()->getHead(), $this->board->getBottomBone()->getTail())
            ) {
                $this->board->insertBone($bone);
            }
        } catch (InvalidBoneException $e) {
            $this->output->invalidBoneSupplied($player);
            return null;
        }

        return $bone;
    }
}
