<?php

namespace App\Lib;

use Exception;
use RegexIterator;
use RecursiveRegexIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

/** 
 * Static class used for recursive file finding
 * @package App\Lib 
 */
class FileFinder
{

    /**
     * @param string $extension 
     * @param string $startDir 
     * @return array 
     * @throws Exception 
     */
    public static function getAllFilesPaths(string $extension, string $startDir): array
    {
        $filesPaths = [];
        $regex = '/^.+\.'.$extension.'$/i';

        $directory = static::getDirIterator($startDir);

        $iterator = new RecursiveIteratorIterator($directory);

        $filtered = new RegexIterator($iterator, $regex, RecursiveRegexIterator::GET_MATCH);
        

        foreach($filtered as $value){
            $filesPaths[] = $value[0];
        }

        return $filesPaths;
    }

    private static function getDirIterator(string $startDir): RecursiveDirectoryIterator{
        if(!file_exists($startDir)){
            throw new Exception('Directory: '.$startDir.' does not exist or has the wrong path!');
        }

        return new RecursiveDirectoryIterator($startDir);
    
    }

}
