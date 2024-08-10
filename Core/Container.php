<?php

namespace Core;

class Container
{
    public $bindings = [];
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {
        if (! array_key_exists($key, $this->bindings)) {
            throw new \Exception("Nothing bound to {$key}");
        }

        $resolver = $this->bindings[$key];
        return $resolver();
    }
}