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
        $return = include CONFIG . DS . 'config.php';
        if (is_array($return)) {
            return $return;
        } else {
            $message = 'The config file ' . CONFIG . DS . 'config.php was not read. ';
            $message .= 'Either the content of the file is not an array, or this file does not exist.';
            throw new \Exception($message);
        }
    }
}
