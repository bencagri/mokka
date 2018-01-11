<?php

namespace Mokka\Config;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class Action
 * @package Mokka\Config
 */
class Action
{

    const ACTION_FILE = 'action';
    /**
     * @var
     */
    private $directory;

    /**
     * @var
     */
    private $file = null;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var
     */
    private $finder;

    /**
     * Action constructor.
     * @param $directory
     */
    public function __construct($directory)
    {
        $this->directory = $directory;

        $finder = new Finder();
        $this->fileSystem = new Filesystem();

        if (!is_dir($directory)){
            $this->fileSystem->mkdir($directory);
        }
        $this->finder = $finder;

        $files = $finder->files()->in($directory);

        foreach ($files as $file) {
            /** @var SplFileInfo $file */
            if ($file->getFilename() == self::ACTION_FILE){
                $this->file = $file;
            }
        }
    }

    /**
     * @return bool|mixed
     */
    public function read()
    {
        try {
            $contents = $this->file->getContents();
            if (is_null($contents)) {
                return false;
            }

            return json_decode($contents, TRUE);
        }catch (\RuntimeException $exception) {
            return false;
        }
    }

    /**
     * @param array $content
     * @return bool
     */
    public function write(array $content)
    {
        $fs = new Filesystem();
        $content = json_encode($content);

        return (bool) $fs->dumpFile($this->file, $content);
    }

    public function viceVersa($action)
    {
        return $action === 'buy' ? 'sell' : 'buy';
    }

}