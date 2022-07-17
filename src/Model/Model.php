<?php

namespace Anticus\Model;

use PDO;
use Anticus\Configure\Configure;

/**
 * Base model
 */
abstract class Model
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getPDO()
    {
        static $pdo = null;
        $config = Configure::read();
        $db_config = $config['database'];

        if ($pdo === null) {

            $dsn = 'mysql:host=' . 
            $db_config['host'] . 
            ';dbname=' . 
            $db_config['name'] . 
            ';charset=' . 
            $db_config['charset'];
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $pdo = new PDO(
                    $dsn,
                    $db_config['username'],
                    $db_config['password'],
                    $options
                );
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return $pdo;
    }

    /**
     * Get an instance of PDO (or null) without throwing an error
     *
     * @return object|null
     */
    protected static function testPDO()
    {
        static $pdo = null;
        $config = Configure::read();
        $db_config = $config['database'];
        if ($pdo === null) {
            $dsn = 'mysql:host=' . 
            $db_config['host'] . 
            ';dbname=' . 
            $db_config['name'] . 
            ';charset=' . 
            $db_config['charset'];
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
   
            try {
                $pdo = new PDO(
                    $dsn,
                    $db_config['username'],
                    $db_config['password'],
                    $options
                );
            } catch (\PDOException $e) {
                return $pdo;
            }
        }
        return $pdo;
    }
}
