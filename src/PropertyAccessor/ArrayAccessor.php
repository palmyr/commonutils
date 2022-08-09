<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\PropertyAccessor;

class ArrayAccessor implements ArrayAccessorInterface
{

    public function hasValue(array $item, string $key): bool
    {
        return $this->hasNestedValue($item, $key);
    }

    public function getValue(array $item, string $key): mixed
    {
        return $this->getNestedValue($item, $key);
    }

    public function setValue(array &$item, string $key, mixed $value): ArrayAccessorInterface
    {
        $item = $this->setNestedValue($item, $key, $value);

        return $this;
    }

    protected function hasNestedValue(array $item, string $key): bool
    {

        list($currentKey, $nextKey) = $this->extractKey($key);

        if ( !$this->has($item, $currentKey) ) {
            return false;
        }

        if ( is_null($nextKey) ) {
            return true;
        }

        $value = $this->get($item, $currentKey);

        if ( !is_array($value) ) {
            return false;
        }

        return $this->hasNestedValue($value, $nextKey);
    }

    protected function getNestedValue(array $item, string $key): mixed
    {

        list($currentKey, $nextKey) = $this->extractKey($key);

        if ( !$this->has($item, $currentKey) ) {
            return null;
        }

        $value = $this->get($item, $currentKey);

        if( is_null($nextKey) ) {
            return $value;
        }

        if ( !is_array($value) ) {
            return null;
        }

        return $this->getNestedValue($item[$currentKey], $nextKey);
    }

    protected function has(array $item, string $key): bool
    {
        return array_key_exists($key, $item);
    }

    protected function get(array $item, string $key): mixed
    {
        return $this->has($item, $key) ? $item[$key]: null;
    }

    protected function setNestedValue(array $item, string $key, mixed $value): array
    {
        list($currentKey, $nextKey) = $this->extractKey($key);

        if ( is_null($nextKey) ) {
            $item[$currentKey] = $value;
            return $item;
        }

        if ( !$this->has($item, $currentKey) ) {
            $item[$currentKey] = [];
        }

        if ( !is_array($item[$currentKey]) ) {
            $item[$currentKey] = [];
        }

        $item[$currentKey] = $this->setNestedValue($item[$currentKey], $nextKey, $value);

        return $item;
    }

    protected function extractKey(string $key): array
    {
        $pieces = explode(self::KEY_SEPARATOR, $key);

        $firstKey = array_shift($pieces);

        $nextKey = null;

        if (count($pieces) > 0 ) {
            $nextKey = implode(self::KEY_SEPARATOR, $pieces);
        }

        return [
            $firstKey,
            $nextKey
        ];
    }
}