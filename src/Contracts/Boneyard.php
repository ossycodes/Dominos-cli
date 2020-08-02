<?php

namespace App\Contracts;

interface Boneyard {
    /**
     * @param int $count
     * @return Bone []
     */
    public function draw($count): array;

    /**
     * @return Bone
     */
    public function drawOne(): Bone;

    /**
     * @return Bone[]
     */
    public function getBones(): array;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @return void
     */
    public function shuffle(): void;
}