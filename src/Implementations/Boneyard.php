<?php

namespace App\Implementations;

use App\Contracts\Bone as BoneContract;
use App\Contracts\Boneyard as BoneyardContract;

class Boneyard implements BoneyardContract
{

    /**
     * This specifies how many tiles combinations of bones are there. 
     */
    const PACK_SIZE = 6;

    /**@var array BoneContract */
    private $bones;

    /**
     * Boneyard constructor
     */
    public function __construct()
    {
        $this->bones = array();
        $this->initBones();
    }

    /**
     * @param int $count
     * @return Bone[]
     */
    public function draw($count): array
    {
        $bones = array();

        foreach (range(1, $count) as $c) {
            $bones[] = $this->drawOne();
        }

        return $bones;
    }

    /**
     * @return Bone []
     */
    public function getBones(): array
    {
        return $this->bones;    
    }

    /**
     * @return Bone
     */
    public function drawOne(): BoneContract
    {
        return array_pop($this->bones);
    }

    public function isEmpty(): bool
    {
        return empty($this->bones);
    }

    public function initBones()
    {
        foreach (range(0, self::PACK_SIZE) as $head) {
            foreach (range($head, self::PACK_SIZE) as $tail) {
                $this->bones[] = new Bone($head, $tail);
            }
        }

        $this->shuffle();

        return $this;
    }

    public function shuffle(): void
    {
        shuffle($this->bones);
    }
}
