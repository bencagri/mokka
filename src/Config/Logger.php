<?php

namespace Mokka\Config;


use Flatbase\Flatbase;
use Flatbase\Query\DeleteQuery;
use Flatbase\Query\InsertQuery;
use Flatbase\Query\ReadQuery;
use Flatbase\Query\UpdateQuery;
use Flatbase\Storage\Filesystem;

class Logger
{

    /** @var  Flatbase $logger */
    private $logger;

    private $dbName;

    public function __construct($directory, $dbName)
    {
        $storage = new Filesystem($directory);
        $this->logger = new Flatbase($storage);
        $this->dbName = $dbName;

    }

    /**
     * @return InsertQuery
     */
    public function insert()
    {
        return $this->logger->insert()->in($this->dbName);
    }


    /**
     * @return ReadQuery
     */
    public function read()
    {
        return $this->logger->read()->in($this->dbName);
    }

    /**
     * @return UpdateQuery
     */
    public function update()
    {
        return $this->logger->update()->in($this->dbName);
    }

    /**
     * @return DeleteQuery
     */
    public function delete()
    {
        return $this->logger->delete()->in($this->dbName);
    }


}