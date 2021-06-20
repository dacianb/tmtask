<?php

use App\Model\Book;
use App\Lib\Settings;
use App\Model\Author;
use App\Lib\FileFinder;

require './vendor/autoload.php';

if(php_sapi_name() !== 'cli'){
    echo 'This can only be run from command line!';
    die();
}

$xmlDir = Settings::get('xmldir');

$xmlDirPath = __DIR__.'/'.$xmlDir;

$filesPaths = [];

try{
    $filesPaths = FileFinder::getAllFilesPaths("xml", $xmlDir);
}catch(Exception $e){
    echo $e->getMessage()."\n";
}


foreach($filesPaths as $path){
    
    $content = simplexml_load_file($path);
    if($content){
        $author = new Author();
        $book = new Book();

        $author->findOrCreate($content->author);
        $book->findOrCreate($author->id, $content->name);
    }

}
