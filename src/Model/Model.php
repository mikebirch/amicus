<?php

namespace Showus\Model;

use PDO;
use Showus\Configure\Configure;

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
        $config = self::getConfig();
        $db_config = $config['Datasources'][$config['environment']];

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
     * Get config
     *
     * @return array
     */
    protected static function getConfig()
    {
        static $config = null;
        return Configure::read();
    }
}
