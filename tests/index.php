<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
use OpenGraph\OpenGraph;
use Exception;
try {
    $obj = new OpenGraph('59c287211eb31e457760e00c');
    echo OpenGraph::getUrl();
} catch (Exception $e) {
    echo $e->getMessage();
}
