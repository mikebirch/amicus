<?php

namespace Anticus\Log;

use Anticus\Configure\Configure;
use Anticus\View\View;

/**
 * Error and exception handler
 */
class Log
{

    public static function logException($exception, $whoops)
    {
        $config = Configure::read();
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        $whoops->sendHttpCode($code);
        
        $logs = $config['paths']['Logs'] . DS . date('Y-m-d') . '.log';
        ini_set('error_log', $logs);

        $message = "Uncaught exception: '" . get_class($exception) . "'";
        $message .= " with message '" . $exception->getMessage() . "'";
        $message .= "\nStack trace: " . $exception->getTraceAsString();
        $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

        // log error
        error_log($message);
        \Whoops\Handler\Handler::DONE;
        
        
        $data['config'] = $config;
        $data['here'] = $_SERVER['REQUEST_URI'];
        View::renderTemplate("$code.html", $data);
    }
    
}
