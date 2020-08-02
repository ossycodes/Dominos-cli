<?php

namespace App\Contracts;

interface Player {

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param Bone $bone
     * @return \App\Contracts\Player
     */
    public function addBone(Bone $bone): self;

    /**
     * @param array $bones
     * @return \App\Contracts\Player
     */
    public function addBones(array $bones): self;

    /**
     * @return mixed
     */
    public function getBones();

    /**
     * @param array $ends
     * @return mixed
     */
    public function drawMatchingBone(...$ends);

    /**
     * @return boolean
     */
    public function isEmpty(): bool;
}