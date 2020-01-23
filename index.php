<?php

require_once "vendor/autoload.php";

use Endocore\App\Route;
use Endocore\Core\App;

Route::get('servers','ServerController','index');

$app = new App();
$app->run();
