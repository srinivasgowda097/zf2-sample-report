<?php

namespace Application\Model\Report;

abstract class AbstractReport implements \Countable, \IteratorAggregate
{

    protected $collection;

    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public function count($mode = 'COUNT_NORMAL')
    {
        return count($this->collection);
    }

    public function getIterator()
    {
        return $this->collection;
    }

    abstract public function toText();
}
