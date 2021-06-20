<?php

namespace App\Lib;


/** 
 * Basic static class for templating
 * @package App\Lib 
 */
class Templates
{

    private static string $viewDir = __DIR__ . '/../View/';

    /**
     * Very basic template rendering function
     * expects $args to be associative array
     * @param string $viewName 
     * @param array $args 
     * @return string 
     */
    public static function render(string $viewName, array $args): string
    {

        $file = static::$viewDir . $viewName . ".php";

        if (!file_exists($file)) {
            return '';
        }

        if (is_array($args)) {
            extract($args);
        }
        ob_start();
        include $file;
        return ob_get_clean();
    }
}
