<?php
/**
 * @maintainer Timur Shagiakhmetov <shagtv@gmail.com>
 */

namespace Shagtv\DBAL;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;

class Client
{
    /** @var Connection */
    protected $Conn;
    /** @var string */
    protected $connection_string;

    public function __construct($connection_string = '')
    {
        $this->connection_string = $connection_string;
    }

    /**
     * @return Connection
     * @throws DBALException
     */
    public function getConnection()
    {
        if (null === $this->Conn) {
            $config = new Configuration();
            $connectionParams = ['url' => $this->connection_string];
            $this->Conn = DriverManager::getConnection($connectionParams, $config);
        }

        return $this->Conn;
    }

    /**
     * @param Connection $Conn
     * @return $this
     */
    public function setConnection(Connection $Conn)
    {
        $this->Conn = $Conn;
        return $this;
    }

    /**
     * @param string $connection_string
     * @return $this
     */
    public function setConnectionString($connection_string)
    {
        $this->connection_string = $connection_string;
        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionString()
    {
        return $this->connection_string;
    }

    /**
     * @throws DBALException
     */
    public function createTable()
    {
        $sql = '
            CREATE TABLE IF NOT EXISTS records (
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              name TEXT DEFAULT NULL
            );
        ';

        $this->getConnection()->exec($sql);
        return true;
    }
}
