# Summary
This is a straight CLI domino game written in PHP, with a focus to object-oriented programming practices.
As of now the game is not interactive but can be made interactive very easily by extending appropriate interfaces given. More on the details section below.


## The rules of this straight domino
 - A total of 28 tiles/bones, can be customized/made configurable using the `PACK_SIZE` constant in the `Implementations/Boneyard` Class and its implementation
 - Each player gets 7 bones/tiles rest is kept separately and are called Boneyard.  can be customized/made configurable using the `HAND_SIZE` constant in the `src/Game` Class and its implementation
 - The board starts with a random bone from the boneyard 
 - Each player can place a tile alternatively either side(Head or Tail) of the existing bone/bones group,
 - No consideration for the spinner, either you extend at the head or tail
 - The bone played by a player should match according to the number printed on the tile otherwise an `InvalidBoneException` will be raised
 - If a player doesn't have a matching tile he can draw from the boneyard until he gets a match.
 - The player who placed the last tile will be the winner 
   * Either the player played all his cards (Current player wins)
   * The boneyard got empty while drawing the tiles (the Previous Player wins because he laid the last tile)
- Still don;t understand ? no problem watch this youtube tutorial on how to play Dominos
[how to play dominos](https://www.youtube.com/watch?v=K2uyXwuYSS4&list=PL2bHlYM4hHq2NF5hCEwTHdeWEbpCxGMPn)
    
# Installation & Usage
you need php7+ and composer to make this game work.

- Clone/Copy this repository 
- `cd` into the repository and open up a terminal 
- Execute `$ composer install`
- Then give executable permissions to the `Domino.php` file using `$ chmod +x Domino.php`
- Then run the file using `./Domino.php` you should be presented with an output similar to the below one (But with coloured output)

```
Welcome to Dominoes
Game Begins
Board is now
 <2:5>
Alice Plays <5:5>
Board is now
 <2:5>  <5:5>
Bob Plays <5:1>
Board is now
 <2:5>  <5:5>  <5:1>
Alice Plays <1:2>
Board is now
 <2:5>  <5:5>  <5:1>  <1:2>
Bob draws a bone from boneyard
Bob Plays <2:6>
Board is now
 <2:5>  <5:5>  <5:1>  <1:2>  <2:6>
Alice Plays <6:6>
Board is now
 <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>
Bob Plays <6:0>
Board is now
 <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>
Alice Plays <0:0>
Board is now
 <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>  <0:0>
Bob Plays <0:1>
Board is now
 <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>  <0:0>  <0:1>
Alice Plays <1:4>
Board is now
 <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>  <0:0>  <0:1>  <1:4>
Bob draws a bone from boneyard
Bob draws a bone from boneyard
Bob Plays <0:2>
Board is now
 <0:2>  <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>  <0:0>  <0:1>  <1:4>
Alice Plays <4:5>
Board is now
 <0:2>  <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>  <0:0>  <0:1>  <1:4>  <4:5>
Bob Plays <5:6>
Board is now
 <0:2>  <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>  <0:0>  <0:1>  <1:4>  <4:5>  <5:6>
Alice Plays <6:4>
Board is now
 <0:2>  <2:5>  <5:5>  <5:1>  <1:2>  <2:6>  <6:6>  <6:0>  <0:0>  <0:1>  <1:4>  <4:5>  <5:6>  <6:4>
Alice Wins by Playing <6:4>
```

# Directory Structure
    domino/
    ├── src/
    |   ├── Contracts
    |   ├── Implementations
    |   ├── Exceptions
    |   ├── Iterators
    |   ├── Game.php
    |
    |── Domino.php  

 - `Contracts/` - This directory contains all the necessary interfaces for the game. You can simply implement the interfaces in your own way (a web app, console app)and you will have a straight domino for yourself.
 - `Implementations/` - This directory contains the implementations for the interfaces
 - `Exceptions/` - This contains all the exceptions, as now only one exception is present `InvalidBoneException`
 - `Iterators/` - This contains CircularIterator which acts like an Infinite Array, Which I have used to keep the player's array in the `Game` class. Since I can iterate over the players Until they run out of moves,
 -  `Game.php` - This Game class is supposed to take in all the implementations via constructor injection and control the gameplay. 
 - `Domino.php` - This is simply a driver program, which new up few players, board, boneyard, and an output interface and ultimately the `Game` class and start the game. In fact you can customize the number of players from here
 
 # Libraries used
  - [Climate](http://climate.thephpleague.com/) - For colored terminal output. The colors will work in normal bash shells
  - PHP 7.2 
  
 # Caveats
  - There is no intelligence involved in this game. In each turn the player simply try to match a bone for a given end of the board, a quick solution is to sort the existing bones in decending order, so that atleast the high weighted bones will go off first.
  - There are some constants involved such as `HAND_SIZE`, `PACK_SIZE` etc... Actually it could have been a configurable option.
  
  #TODOS
  - Add tests 
  -another actual implemntations maybe a game BOT.