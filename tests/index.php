<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
use OpenGraph\OpenGraph;
try {

    $obj = new OpenGraph('59c287211eb31e457760e00c', 'https://u-rang.com');
    $my_data = OpenGraph::scrapSiteContents();
    $getTitle = OpenGraph::getTitle(json_encode(json_decode($my_data)->response));
    $getDescription = OpenGraph::getDescription(json_encode(json_decode($my_data)->response));
    $getImage = OpenGraph::getImage(json_encode(json_decode($my_data)->response));
    $getTitleArr =  OpenGraph::getTitle(json_decode($my_data)->response, true);
    $getDescriptionArr = OpenGraph::getDescription(json_decode($my_data)->response, true);
    $getImageArr = OpenGraph::getImage(json_decode($my_data)->response, true);
    print_r($getImageArr);
} catch (Exception $e) {
    echo $e->getMessage();
}
//phpinfo();
