<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
define("ROOT", dirname(__DIR__, 1));
define("CONFIG", ROOT . DS . 'config');
define("CACHE", ROOT . DS . 'cache');
define("LOGS", ROOT . DS . 'logs');
define("WEBROOT", ROOT . DS . 'public');
define("APP", ROOT . DS . 'src');

require ROOT. DS . 'vendor' . DS . 'autoload.php';

set_error_handler('Anticus\Error\Error::errorHandler');
set_exception_handler('Anticus\Error\Error::exceptionHandler');
