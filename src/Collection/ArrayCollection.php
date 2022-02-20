<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Collection;

class ArrayCollection implements Collection
{
    /**
     * @var array<int|string,mixed>
     */
    protected array $collection;

    /**
     * @param array<int|string,mixed> $collection
     */
    public function __construct(
        array $collection = []
    ) {
        $this->collection = $collection;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->collection);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }

    public function count(): int
    {
        return count($this->collection);
    }

    public function serialize(): string
    {
        return serialize($this->collection);
    }

    /**
     * @return array<int|string,mixed>
     */
    public function __serialize(): array
    {
        return $this->collection;
    }

    public function unserialize(string $data): void
    {
        $this->collection = unserialize($data);
    }

    /**
     * @param array<int|string,mixed> $data
     * @return void
     */
    public function __unserialize(array $data): void
    {
        $this->collection = $data;
    }

    /**
     * @return \Traversable<int|string,mixed>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->collection);
    }

    public function get(int|string $key): mixed
    {
        return $this->collection[$key] ?? null;
    }

    public function set(int|string $key, $value): Collection
    {
        $this->collection[$key] = $value;

        return $this;
    }

    public function remove(int|string $key): mixed
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
