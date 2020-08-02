#!/usr/bin/env php

<?php
require __DIR__ . '/vendor/autoload.php';

use App\Game;
use App\Iterators\CircularIterator;

/**
 * group use declaration php 7 +
 */
use App\Implementations\{Board, Bone, Boneyard, CliOutput, Player, Test};

$player1 = new Player("Alice");
$player2 = new Player("Bob");
$bone1 = new Bone(1, 2);
$bone2 = new Bone(2, 4);
$aliceBone = new Bone(1, 5);
$boneyard = new Boneyard();
$board = new Board();
$clioutput = new CliOutput();
$players = [$player1, $player2];

/**
 * instantiating the CircularIterator class
 * to infintely loop through the two players
 * element in the array given to it, until this 
 * meets a conditon (count ===  10) and manually exits
 */
// $count = 0;
// foreach(new CircularIterator($players) as $p) {
//     $count++;
//     var_dump($p->getName(), $count);
//     if($count == 10) {
//         exit();
//     }
// }

$game = new Game($board, $boneyard, $clioutput, [$player1, $player2]);
$game->initializeGame();
