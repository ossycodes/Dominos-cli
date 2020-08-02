<?php

namespace App\Contracts;

interface Board 
{
    /**
     * @param Bone $bone
     * @return mixed
     */
    public function insertBone(Bone $bone);

     /**
      * @return Bone
      */
    public function getTopBone(): Bone;

     /**
      * @return Bone
      */
    public function getBottomBone(): Bone;

    /**
     * @param Bone $bone
     * @return mixed
     */
    public function isMatchingForHead(Bone $bone);
    
    /**
     * @param Bone $bone
     * @return mixed
     */
    public function isMatchingForTail(Bone $bone);
}