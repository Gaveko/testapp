<?php

use App\Core\Http\Application;
use App\Core\Http\Request;

define('CONF_PATH', __DIR__ . '/conf');
define('VIEWS_PATH', __DIR__ . '/src/Views');
define('STATIC_PATH', __DIR__ . '/static');
define('STORAGE_PATH', __DIR__ . '/storage');

spl_autoload_register(function ($class_name) {
    $class_name = str_replace("\\", "/", $class_name);
    $class_name = substr($class_name, 4);
    require 'src/' . $class_name . '.php';
});

session_start();

$app = new Application;
$req = Request::getRequestFromGlobal();
$res = $app->handle($req);
$res->render();