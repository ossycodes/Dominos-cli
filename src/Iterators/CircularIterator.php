<?php

namespace App\Iterators;

use Iterator;

/**
 * so basically this class just loops between each element 
 * (continuosly an infinite loop) in the array passed to it (in this case $entries) until the 
 * class implementation(the code using this to loop throgh) 
 * manually exits.  (check Domino.php line 23 - 36) for example implementation 
 * (should help understand this better)
 */

class CircularIterator implements Iterator
{
    private $entries;

    public function __construct($entries)
    {
        $this->entries = $entries;

        $this->rewind();
    }

    public function current()
    {
        // var_dump(__METHOD__);
        return current($this->entries);
    }

    public function prev()
    {
        prev($this->entries);

        if (!$this->current()) {
            $this->end();
        }
    }

    public function key()
    {
        // var_dump(__METHOD__);
        return key($this->entries);
    }

    public function next()
    {
        // var_dump(__METHOD__);
        next($this->entries);

        if (!$this->current()) {
            $this->rewind();
        }
    }

    public function rewind()
    {
        // var_dump(__METHOD__);
        reset($this->entries);
    }

    public function valid()
    {
        // var_dump(__METHOD__);
        return true;
    }

    public function end()
    {
        // var_dump(__METHOD__);
        end($this->entries);
    }
}
