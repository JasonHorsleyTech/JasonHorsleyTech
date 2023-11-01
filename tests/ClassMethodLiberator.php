<?php

namespace Tests;

/**
 * Need to unit test a private method on a class, but you don't want to make the private method public and you don't want to feature test the whole thing?
 *
 * class Base {
 *   private function here() {}
 * }
 *
 * $liberated = new ClassMethodLiberator(new Base());
 * $liberated->here();
 *
 * !! Back pats all around !!
 */
class ClassMethodLiberator
{
    private $object;
    private $reflection;

    public function __construct($object)
    {
        $this->object = $object;
        $this->reflection = new \ReflectionClass($object);
    }

    public function __call($name, $args)
    {
        $method = $this->reflection->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($this->object, $args);
    }
}
