<?php


namespace Mokka\Exchange;

use Symfony\Component\Debug\Exception\ClassNotFoundException;

/**
 * Class ExchangeFactory
 * @package Botta\Exchange
 */
class ExchangeFactory
{

    /**
     * @var string
     */
    private $class;

    /**
     * ExchangeFactory constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->class = sprintf('\\Mokka\\Exchange\\Market\\%s', ucfirst($class));
    }

    /**
     * @param $args
     * @return ExchangeInterface
     * @throws ClassNotFoundException
     */
    public function make(array $args)
    {
        if( class_exists($this->class)) {
            $instance = new $this->class(...$args);

            return $instance;
        }

        throw new ClassNotFoundException('Market Provider Not Found', new \ErrorException());
    }

}