<?php
use proyecto\app\exceptions\NotFoundException;
use proyecto\core\App;
use proyecto\core\Request;

try {
    require_once 'core/Bootstrap.php';
    App::get('router')->direct(Request::uri(), Request::method());
} catch (NotFoundException $notFoundException) {
    die($notFoundException->getMessage());
}
