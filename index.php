<?php

use proyecto\app\exceptions\AppException;
use proyecto\core\App;
use proyecto\core\Request;

try {
    require_once 'core/Bootstrap.php';
    App::get('router')->direct(Request::uri(), Request::method());
} catch (AppException $appException) {
    $appException->handleError();
} catch (Exception) {
    die($exception->handleError());
}
