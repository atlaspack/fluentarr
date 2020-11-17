<?php


namespace Atlas\FluentArr;


use Iterator, ArrayAccess, Countable;


class FluentArr implements Iterator, ArrayAccess, Countable
{
    private int $counter;
    private int $length;

    protected array $array;
    protected array $keys;

    public function __construct(array $array = [])
    {
        $this->array = $array;
        $this->keys = array_keys($array);
        $this->length = count($array);
    }

    public function &__get($offset)
    {
        return $this->get($offset);
    }

    public function __set($offset, $value)
    {
        $this->set($offset, $value);
    }

    final public function &get($offset)
    {
        return $this->array[$offset];
    }

    final public function set($offset, $value): self
    {
        $this->array[$offset ?? $this->length] = $value;
        ++$this->length;
        return $this;
    }

    final public function unset($offset): self
    {
        unset($this->array[$offset]);
        --$this->length;
        return $this;
    }

    final public function current()
    {
        return $this->array[$this->keys[$this->counter]];
    }

    final public function next()
    {
        ++$this->counter;
    }

    final public function key()
    {
        return $this->keys[$this->counter];
    }

    final public function valid()
    {
        return isset($this->keys[$this->counter]);
    }

    final public function rewind()
    {
        $this->counter = 0;
    }

    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
       return $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->unset($offset);
    }

    public function count()
    {
        return $this->length;
    }
}