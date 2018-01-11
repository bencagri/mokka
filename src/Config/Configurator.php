<?php

namespace Mokka\Config;


use Noodlehaus\Config;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * Class Configurator
 * @package Botta\Config
 */
class Configurator
{

    /**
     * @var string
     */
    private $directory;

    /**
     * Configurator constructor.
     * @param $directory
     */
    public function __construct($directory)
    {

        $this->directory = $directory;
    }

    /**
     * @return Config
     */
    public function make()
    {
        if (is_dir($this->directory)) {
            return new Config($this->directory);
        }

        throw new InvalidConfigurationException();
    }

}