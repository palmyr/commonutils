<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Iterator;

class IteratorArrayIterator implements \Iterator
{

    /**
     * @var \Traversable[]
     */
    protected array $iteratorCollection;

    protected int $position = 0;

    protected int $key = 0;

    public function __construct(
        array $iteratorCollection
    )
    {
        $this->iteratorCollection = $iteratorCollection;
    }

    public function current()
    {
        return $this->currentIterator()->current();
    }

    public function next()
    {
        $this->currentIterator()->next();
        if ( !$this->currentIterator()->valid() ) {
            $this->position++;
        }
        $this->key++;
    }

    public function valid()
    {
        return $this->currentPositionValid() && $this->currentIterator()->valid();
    }

    public function key()
    {
        return $this->key;
    }

    public function rewind()
    {
        $this->position = 0;
        $this->key = 0;
        foreach ( $this->iteratorCollection as $iterator ) {
            reset($iterator);
        }
    }

    protected function currentIterator(): \Iterator
    {
        if ( $this->currentPositionValid() ) {
            return $this->iteratorCollection[$this->position];
        }

        throw new \RuntimeException('The current position is not valid');
    }

    protected function currentPositionValid(): bool
    {
        return isset($this->iteratorCollection[$this->position]) &&  $this->iteratorCollection[$this->position] instanceof \Iterator;
    }

}