<?php

namespace Amicus\View;
use Twig\Extra\Html\HtmlExtension;

/**
 * View
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $data  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $data = [])
    {
        extract($data, EXTR_SKIP);

        $file = $config['paths']['Template'] . DS . $view;

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
    
    /**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $data  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $data = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader($data['config']['paths']['Template']);
            if ($data['config']['debug'] === true) {
                $twig = new \Twig\Environment($loader, ['debug' => true]);
            } else {
                $twig = new \Twig\Environment($loader, [
                    'cache' => $data['config']['paths']['Cache'] . DS . 'twig'
                ]);
            }
            $twig->addExtension(new HtmlExtension());
        }
        echo $twig->render($template, $data);
    }
}
