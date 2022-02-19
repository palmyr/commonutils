<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Collection;

use Palmyr\CommonUtils\String\StringInterface;
use Palmyr\CommonUtils\String\StringObject;

class ArrayCollection implements Collection
{
    protected array $collection;

    public function __construct(
        array $collection = []
    ) {
        $this->collection = $collection;
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->collection);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value): Collection
    {
        $this->set($offset, $value);

        return $this;
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    public function count()
    {
        return count($this->collection);
    }

    public function serialize()
    {
        return serialize($this->collection);
    }

    public function unserialize($data)
    {
        $this->collection = unserialize($data);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }

    public function get($key)
    {
        return $this->collection[$key] ?? null;
    }

    public function set($key, $value): Collection
    {
        $this->collection[$key] = $value;

        return $this;
    }

    public function remove($key)
    {
        if ($this->offsetExists($key)) {
            $value = $this->collection[$key];
            unset($this->collection[$key]);

            return $value;
        }

        return null;
    }

    public function add(array $values): Collection
    {
        $this->collection = array_merge($this->collection, $values);

        return $this;
    }

    public function implode(string $separator): string
    {
        return implode($separator, $this->collection);
    }

    public function toArray(): array
    {
        return $this->collection;
    }
}
