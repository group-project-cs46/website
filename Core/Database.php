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
        $dsn = 'pgsql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['dbname'];
        try {
            $this->connection = new PDO($dsn, $config['user'], $config['password'], [
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
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

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
