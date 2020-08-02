<?php

namespace App\Implementations;

use App\Contracts\Bone as BoneContract;

class Bone implements BoneContract
{
    /**
     * #var int
     */
    private $head;

    /**
     * @var int
     */
    private $tail;

    /**
     * Bone constructor
     * @param $head
     * @param $tail
     */
    public function __construct($head, $tail)
    {
        $this->head = $head;
        $this->tail = $tail;
    }

    /**
     * @return boolean
     */
    public function isDouble(): bool
    {
        return $this->head === $this->tail;
    }

    /**
     * @return BoneContract
     */
    public function invert(): BoneContract
    {
        [$this->head, $this->tail] = [$this->tail, $this->head];
        return $this;
    }

    /**
     * @return int 
     */
    public function getHead(): int
    {
        return $this->head;
    }

    /**
     * @return int
     */
    public function getTail(): int
    {
        return $this->tail;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->head + $this->tail;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("<%d:%d>", $this->head, $this->tail);
    }
}
