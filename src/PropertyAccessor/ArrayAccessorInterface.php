<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\PropertyAccessor;

interface ArrayAccessorInterface
{

    public const KEY_SEPARATOR = ".";

    public function getValue(array $item, string $key): mixed;

    public function setValue(array &$item, string $key, mixed $value): ArrayAccessorInterface;

    public function hasValue(array $item, string $key): bool;
}