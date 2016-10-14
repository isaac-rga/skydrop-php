<?php

namespace Skydrop\Tools;

class ArrayTools implements \IteratorAggregate
{
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function mergeArrayOfObjectsByKey(array $objects, $key)
    {
        $arrayKeys = $this->_getArrayKeys($key);
        $uniqObjects = array_filter(
            $objects,
            function($o) use ($key, $arrayKeys) {
                if (!in_array($o->$key, $arrayKeys)) {
                    return $o;
                }
            }
        );
        $this->array = array_merge($this->array, $uniqObjects);
    }

    private function _getArrayKeys($key)
    {
        return array_map(
            function($a) use ($key) { return $a->$key; },
            $this->array
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->array);
    }
}
