<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Iterator;

/**
 * @implements \Iterator<int,mixed>
 */
class IteratorArrayIterator implements \Iterator
{
    /**
     * @var array<\Iterator<mixed>>
     */
    protected array $iteratorCollection;

    protected int $position = 0;

    protected int $key = 0;

    /**
     * @param array<\Iterator<mixed>> $iteratorCollection
     */
    public function __construct(
        array $iteratorCollection
    ) {
        $this->iteratorCollection = $iteratorCollection;
    }

    /**
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->currentIterator()->current();
    }

    public function next(): void
    {
        $this->currentIterator()->next();
        if (!$this->currentIterator()->valid()) {
            $this->position++;
        }
        $this->key++;
    }

    public function valid(): bool
    {
        return $this->currentPositionValid() && $this->currentIterator()->valid();
    }

    public function key(): int
    {
        return $this->key;
    }

    public function rewind(): void
    {
        $this->position = 0;
        $this->key = 0;
        foreach ($this->iteratorCollection as $iterator) {
            reset($iterator);
        }
    }

    /**
     * @return \Iterator<mixed>
     */
    protected function currentIterator(): \Iterator
    {
        if ($this->currentPositionValid()) {
            return $this->iteratorCollection[$this->position];
        }

        throw new \RuntimeException('The current position is not valid');
    }

    protected function currentPositionValid(): bool
    {
        return isset($this->iteratorCollection[$this->position])
            && $this->iteratorCollection[$this->position] instanceof \Iterator;
    }
}
