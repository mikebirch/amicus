<?php

namespace Amicus\Model;

use Medoo\Medoo;
use Amicus\Configure\Configure;

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
    protected static function getDB()
    {
        static $db = null;
        $configure = new Configure();
        $config = $configure->read();
        $db_config = $config['Datasources'][$config['environment']];
        $db = new Medoo($db_config);

        return $db;
    }

    /**
     * Get config
     *
     * @return void
     */
    protected static function getConfig()
    {
        $configure = new Configure();
        return $configure->read();
    }
}
