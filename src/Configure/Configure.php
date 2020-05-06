<?php

namespace Paulus\Configure;

/**
 * Configure class
 * Includes the application config file, which includes an array
 * CONFIG must be defined in index.php
 * 
 */
class Configure
{
    public static function read()
    {
        $return = include CONFIG . DS . 'config.php';
        if (is_array($return)) {
            return $return;
        } else {
            throw new \Exception(CONFIG . DS . 'config.php not found');
        }
    }
}
