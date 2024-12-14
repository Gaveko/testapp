<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Gaveko\Framework\Http\Application;
use Gaveko\Framework\Http\Request;

define('CONF_PATH', __DIR__ . '/../conf');
define('VIEWS_PATH', __DIR__ . '/../src/Views');
define('STATIC_PATH', './static');
define('STORAGE_PATH', './storage');

session_start();

$app = new Application();
$req = Request::getRequestFromGlobal();
$res = $app->handle($req);
$res->render();