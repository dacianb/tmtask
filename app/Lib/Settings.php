<?php

namespace App\Lib;

use Exception;

/**
 * Static class used for reading and parsing the settings.ini file
 * @package App\Lib 
 */
class Settings
{

    private static $settingsFile = __DIR__."/../../settings.ini";


    /**
     * Return the value set in settings.ini
     * @param string $settingName 
     * @return string 
     * @throws Exception 
     */
    public static function get(string $settingName): string
    {

        try {
            $ini_array = static::parse();
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage() . "\n";
            die();
        }
        if (!isset($ini_array[$settingName])) {
            throw new Exception('Setting not found in settings.ini');
            die();
        }
        return $ini_array[$settingName];
        
    }

    /**
     * Parse the .ini file
     * @return array 
     * @throws Exception 
     */
    private static function parse(): array
    {

        if (!file_exists(static::$settingsFile)) {
            throw new Exception('Settings file not found!');
        }
        return parse_ini_file(static::$settingsFile);
    }
}
