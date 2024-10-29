<?php 
require __DIR__ . '/../vendor/autoload.php';

$logger = MyLog::load('logs/curso.log');
App::bind('logger',$logger);