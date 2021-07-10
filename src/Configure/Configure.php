<?php

namespace Anticus\Configure;

/**
 * Configure class
 * Includes the application config file, which includes an array
 * CONFIG must be defined in index.php
 * 
 */
class Configure
{
    /**
     * Read the config file which is an array
     *
     * @return array<mixed>
     */
    public static function read()
    {
        if (file_exists(CONFIG . DS . 'config.php')) {
            $config = include CONFIG . DS . 'config.php';
            $local_config = file_exists(CONFIG . DS . 'config_local.php');
            if ($local_config) {
                require CONFIG . DS . 'config_local.php';
            }
        }
        if (is_array($config)) {
            return $config;
        } else {
            $message = 'The config file ' . CONFIG . DS . 'config.php ';
            if ($local_config) {
                $message .= 'or the file ' . CONFIG . DS . 'config_local.php ';
            }
            $message .= 'could not be read.';
            throw new \Exception($message);
        }
    }
}
