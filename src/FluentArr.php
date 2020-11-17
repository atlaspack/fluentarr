<?php


namespace Atlas\FluentArr;


use Iterator, ArrayAccess, Countable;


class FluentArr implements Iterator, ArrayAccess, Countable
{
    private array $array;
    private array $keys;
    private int $counter;
    private int $length;

    public function __construct(array $array)
    {
        $this->array = $array;
        $this->keys = array_keys($array);
        $this->length = count($array);
    }

    public function current()
    {
        return $this->array[$this->keys[$this->counter]];
    }

    public function next()
    {
        ++$this->counter;
    }

    public function key()
    {
        return $this->keys[$this->counter];
    }

    public function valid()
    {
        return isset($this->keys[$this->counter]);
    }

    public function rewind()
    {
        $this->counter = 0;
    }

    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->array[$offset] = $value;
        ++$this->length;
    }

    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
        --$this->length;
    }

    public function count()
    {
        return $this->length;
    }
}