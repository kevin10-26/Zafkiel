<?php declare(strict_types=1);

require 'vendor/autoload.php';

use Kevin1026\Controller;

// __DIR__ for config files
// $_SERVER['SERVER_NAME'] for pictures
// $dirs = [
//     'src'    => __DIR__ . '/src/',
//     'public' => $_SERVER['SERVER_NAME'] . '/public/'
// ];

// 2nd config file that contains paths ?

$controller = new Controller('admin1');

echo $controller->show();