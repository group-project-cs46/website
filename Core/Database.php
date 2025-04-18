<?php

namespace Core;

use PDO;
use PDOException;

class Database
{

    public $connection;
    public $statement;

    private $config;

    public function __construct($config)
    {
        $this->config = $config;

        $this->connect();
    }

    private function connect()
    {
        $config = $this->config;
        $dsn = 'pgsql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['dbname'];

        try {
            $this->connection = new PDO($dsn, $config['user'], $config['password'], [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_EMULATE_PREPARES => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }


    public function query($query, $params)
    {
        $start = microtime(true);

        try {
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'server closed the connection') !== false) {
                dd('reconnect');
                $this->connect(); // reconnect
                $this->statement = $this->connection->prepare($query);
                $this->statement->execute($params);
            } else {
                throw $e;
            }
        }

        $end = microtime(true);
        log_to_file("Query time: " . round(($end - $start) * 1000, 2) . "ms");

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function getLastInsertedId()
    {
        return $this->connection->lastInsertId();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();
        if (!$result) {
            abort();
        }
        return $result;
    }
}
