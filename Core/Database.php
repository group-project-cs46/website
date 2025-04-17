<?php

namespace Core;

use PDO;
use PDOException;

class Database
{

    public $connection;
    public $statement;

    public function __construct($config)
    {
        console_log('Connecting to database...');
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

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

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
