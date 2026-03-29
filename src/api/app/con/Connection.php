<?php
declare(strict_types=1);

namespace App\Con;

use \PDO;
use \PDOException;

class Connection
{
    private PDO $connection;
    private string $host = '127.0.0.1';
    private string $database = 'scandiwebTestDb';
    private string $user = 'root';
    private string $password = 'root';
    /*
    private PDO $connection;
    private string $host = 'sql209.epizy.com';
    private string $database = 'epiz_32092812_scandiwebjrtest';
    private string $user = 'epiz_32092812';
    private string $password = 'H8LddOeojlhh2';
    */
    public function con(): ?object
    {
        $mysql = 'mysql:host='.$this->host.';dbname='.$this->database;
        try {
            $this->connection = new PDO($mysql, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->connection->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            return $this->connection;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
};