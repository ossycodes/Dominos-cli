<?php

namespace App\Contracts;

interface Output {
    /**
     * @return void
     */
    public function showWelcome();

    /**
     * @param Board $board
     * @return mixed
     */
    public function displayBoard(Board $board);

    /**
     * @param Player $currentPlayer
     * @param Player $previousPlayer
     * @return mixed
     */
    public function gameBlocked(Player $currentPlayer, Player $previousPlayer);

    /**
     * @param Player $player
     * @param Bone $bone
     */ 
    public function playerWon(Player $player, Bone $bone);

    /**
     * @param Player $player
     * @param Bone $bone
     * @return mixed
     */
    public function bonePlaced(Player $player, Bone $bone);

    /**
     * @param Player $player
     * @return mixed
     */
    public function playerDrawsFromBoneyard(Player $player);

    /**
     * @param Player $player
     * @return mixed
     */
    public function invalidBoneSupplied(Player $player);
}