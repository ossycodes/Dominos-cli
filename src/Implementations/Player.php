<?php

namespace App\Implementations;

use App\Contracts\Bone;
use App\Contracts\Player as PlayerContract;

class Player implements PlayerContract
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $bones;

    /**
     * Player constructor
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->bones = array();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Bone $bone
     * @return PlayerContract
     */
    public function addBone(Bone $bone): PlayerContract
    {
        $this->bones[] = $bone;

        return $this;
    }

    /**
     * @param array $bones
     * @return PlayerContract
     */
    public function addBones(array $bones): PlayerContract
    {
        foreach ($bones as $bone) {
            $this->addBone($bone);
        }

        return $this;
    }

    public function getBones()
    {
        return $this->bones;
    }

    public function drawMatchingBone(...$ends)
    {
        foreach ($this->bones as $key => $bone) {
            // var_dump($bone->getHead(), $bone->getTail(), $ends);
            if (in_array($bone->getHead(), $ends) || in_array($bone->getTail(), $ends)) {
               var_dump("drew matching bone");
                unset($this->bones[$key]);
                return $bone;
            }
            // var_dump("no matching bone");
        }
    }

    public function isEmpty(): bool
    {
        return empty($this->bones);
    }
}
