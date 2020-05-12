<?php

namespace Showus\View;
use Twig\Extra\Html\HtmlExtension;

/**
 * View
 */
class View
{

    /**
     * Render a PHP template
     *
     * @param string $template The template file path
     * @param array<mixed> $data config and data to display in the view
     * @return void
     */
    public static function render(string $template, array $data = [])
    {
        $config = null;
        extract($data, EXTR_SKIP);

        if ( !empty($config) ) {
            $file = $config['paths']['Template'] . DS . $template;
        } else {
            throw new \Exception("config not found");
        }

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
     * @param array<mixed> $data  config and data to display in the view
     *
     * @return void
     */
    public static function renderTemplate(string $template, array $data = [])
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
