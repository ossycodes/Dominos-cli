<?php

namespace App\Implementations;

use App\Contracts\Board as BoardContract;
use App\Contracts\Bone;
use App\Exceptions\InvalidBoneException;
use Exception;
use SplDoublyLinkedList;

class Board implements BoardContract
{
    /**
     * @var SplDoublyLinkedList
     */
    private $board;

    public function __construct()
    {
        $this->board = new SplDoublyLinkedList();
    }

    /**
     * @param Bone
     * @return $this
     * @throws InvalidBoneException
     */
    public function insertBone(Bone $bone)
    {
        if ($this->board->isEmpty()) {
            var_dump("inserting bone into board", $bone);
            $this->board->push($bone);
            return $this;
        }

        $this->insertIntoMatchingEnd($bone);
    }

    /**
     * @param Bone $bone
     */
    public function insertIntoMatchingEnd(Bone $bone)
    {
        // var_dump("insert to matching end");
        if ($tail = $this->isMatchingForTail($bone)) {
            // var_dump("tail, add to end");
            $this->board->push($tail);
            return $this;
        }   

        if($head = $this->isMatchingForHead($bone)) {
            // var_dump("head, unshift (prepend)");
            $this->board->unshift($head);
            return $this;
        }

        throw new InvalidBoneException("Invalid Bone supplied");
    }

    /**
     * @return Bone
     */
    public function getTopBone(): Bone
    {
        return $this->board->bottom();
    }

    /**
     * @return Bone
     */
    public function getBottomBone(): Bone
    {
        return $this->board->top();
    }

    public function isMatchingForHead(Bone $bone)
    {
        if ($this->getTopBone()->getHead() == $bone->getHead()) {
            return $bone->invert();
        }

        if ($this->getTopBone()->getHead() == $bone->getTail()) {
            return $bone;
        }

        return null;
    }

    public function isMatchingForTail(Bone $bone)
    {
        if ($this->getBottomBone()->getTail() == $bone->getHead()) {
            return $bone;
        }

        if ($this->getBottomBone()->getTail() == $bone->getTail()) {
            return $bone->invert();
        }

        return null;
    }

    public function __toString()
    {
        $board = "";
        foreach ($this->board as $bone) {
            $board .= sprintf(" %s ", $bone);
        }
        return $board;
    }
}
