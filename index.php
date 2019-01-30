<?php

require_once "vendor/autoload.php";

use Endocore\App\Route;
use Endocore\Core\App;



Route::post('person/?', 'Person', 'post');
Route::get('person/?', 'Person', 'index');
Route::put('person/?', 'Person', 'put');
Route::delete('person/?', 'Person', 'delete');


$app = new App();
$app->run();
