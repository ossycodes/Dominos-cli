<?php

namespace App\Contracts;

interface Bone {

    /**
     * @return Bone
     */
    public function invert(): self;

    /**
     * @return bool
     */
    public function isDouble(): bool;

    /**
     * @return int
     */
    public function getHead(): int;

    /**
     * @return int
     */
    public function getTail(): int;

    /**
     * @return int
     */
    public function getWeight(): int;
}