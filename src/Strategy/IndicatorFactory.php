<?php

namespace Mokka\Strategy;


use Symfony\Component\Debug\Exception\ClassNotFoundException;

class IndicatorFactory
{


    public $class;


    public function __construct($class)
    {
        $this->class = sprintf('\\Mokka\\Strategy\\Indicator\\%s', ucfirst($class));
    }


    public function make($args)
    {
        if (class_exists($this->class)) {
            $instance = new $this->class(...$args);

            return $instance;
        }

        throw new ClassNotFoundException('Indicator Not Found', new \ErrorException());
    }
}