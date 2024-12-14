<?php

namespace Gaveko\Framework\Database;

class DBConnection
{
    private static $instance = null;
    private \PDO $pdo;

    private function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    static function getInstance()
    {
        if (!static::$instance) {
            $dbConf = require CONF_PATH . '/db.php';
            $dsn = "mysql:host=%s;port=%d;dbname=%s";
            static::$instance = new static(new \PDO(
                sprintf($dsn, $dbConf['host'], $dbConf['port'], $dbConf['dbname']),
                $dbConf['user'],
                $dbConf['password']
            ));
        }
        return static::$instance;
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}