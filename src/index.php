<?php

require_once __DIR__ . '/../vendor/autoload.php';

use OpenGraph\OpenGraphClient;
use OpenGraph\OpenGraphException;

define('OG_API_KEY', 'XXXXXXXXXX');

try {
    $og = new OpenGraphClient(OG_API_KEY);
    $ogResponse = $og->fetch('https://opengraph.io');
    echo '<pre>';
    var_dump($ogResponse);
} catch (OpenGraphException $openGraphException) {
    echo $openGraphException->getMessage();
}
