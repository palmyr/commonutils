<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Collection;

interface Collection extends \Countable, \ArrayAccess, \IteratorAggregate, \Serializable
{

    public function toArray(): array;

    public function get($key);

    public function set($key, $value): Collection;

    public function remove($key);

    public function add(array $values): Collection;
}