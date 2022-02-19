<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Collection;

use Palmyr\CommonUtils\String\StringInterface;

interface Collection extends \Countable, \ArrayAccess, \IteratorAggregate, \Serializable
{
    /**
     * @return array<int|string,mixed>
     */
    public function toArray(): array;

    public function get(int|string $key): mixed;

    /**
     * @param int|string $key
     * @param mixed $value
     * @return Collection<int|string,mixed>
     */
    public function set(int|string $key, mixed $value): Collection;

    public function remove(int|string $key): void;

    /**
     * @param array<int|string,mixed> $values
     * @return Collection<int|string,mixed>
     */
    public function add(array $values): Collection;

    public function implode(string $separator): string;
}
