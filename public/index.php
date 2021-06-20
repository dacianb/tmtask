<?php

require '../vendor/autoload.php';

use App\Db\Migrations;
use App\Lib\Templates;
use App\Model\Author;

//TODO: Move this function to a separate file!!
$db = new Migrations();
$db->migrate();

$author = new Author();

$payload = [];
$result = [];

if (isset($_GET["search"]) && !empty(trim($_GET["search"]))) {
    $query = $_GET['search'];
    $payload["query"] = $query;

    if($author->find($query)){
        $result = $author->getAuthorBooks();
    };
    
} else {
    $result = $author->getAllBooks();
}

$payload["result"] = $result;

$template = Templates::render("index", $payload);

echo $template;
