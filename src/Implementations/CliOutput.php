<?php

namespace App\Implementations;

use App\Contracts\Board;
use App\Contracts\Bone;
use App\Contracts\Output;
use App\Contracts\Player;
use League\CLImate\CLImate;

class CliOutput implements Output
{

    /**
     * @var CLImate
     */

    /**
     * CliOutput constructor
     */
    public function __construct()
    {
        $this->climate = new CLImate();
    }

    /**
     * shows welcome message
     */
    public function showWelcome()
    {
        $this->climate->bold()->backgroundGreen("Welcome to Dominoes");
        $this->climate->red("Game Begins");
    }

    /**
     * @param Board $board
     */
    public function displayBoard(Board $board)
    {
        $this->climate->backgroundLightBlue("Board is now");
        $this->climate->bold($board);
    }

    /**
     * @param Player $currentPlayer
     * @param Player $previousPlayer
     */
    public function gameBlocked(Player $currentPlayer, Player $previousPlayer)
    {
        $this->climate
            ->bold()
            ->backgroundRed($currentPlayer->getName() . " Tries to draw from Boneyard, but it is empty, Game blocked");

        $this->climate
            ->bold()
            ->blink()->bakcgroundGreen($previousPlayer->getName(), " wins by placing last bone");
    }

    /**
     * @param Player $player
     * @param Bone $bone
     */
    public function playerWon(Player $player, Bone $bone)
    {
        $this->climate->bold()->blink()->backgroundGreen($player->getName() . " wins by playing" . $bone);
    }

    /**
     * @param Player $plalyer
     * @param Bone $bone
     */
    public function bonePlaced(Player $player, Bone $bone)
    {
        $this->climate->bold()->info($player->getName() . " plays " . $bone);        
    }

    /**
     * @param Player $player
     */
    public function playerDrawsFromBoneyard(Player $player)
    {
        $this->climate->bold()->info($player->getName() . " draws a bone from boneyard ");        
    }

    /**
     * @param Player $player
     */
    public function invalidBoneSupplied(Player $player)
    {
        $this->climate->bold()->error($player->getName() . " supplied an invalid bone ");
    }

    public function displayBoneCount($name, $count) {
        $this->climate
            ->bold()
            ->backgroundRed("$name has $count number of bones");
    }
}
