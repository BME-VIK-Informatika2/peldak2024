<?php

require 'app/helpers.php';
require 'app/Router.php';
require 'app/models/Paginator.php';
require 'app/models/User.php';
require 'app/controllers/UserController.php';

use App\Controllers\UserController;
use App\Exceptions\NotFoundException;
use App\Models\User;
use App\Router;

// Session indítása
session_start();

// Kapcsolódás adatbázishoz
$config = require 'config/db.php';
try {
    $db = new PDO("mysql:host={$config["host"]};dbname={$config["dbname"]};charset=utf8", $config["username"], $config["password"]);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    User::$db = $db;
} catch (PDOException $e) {
    http_response_code(500);
    echo $e->getMessage();
    die;
}

// Router létrehozása
$router = new Router();
$router->registerPrefix('/php/4_halado/1_kod_szetdarabolas');
$router->registerRoute('/', fn() => UserController::index());
$router->registerRoute('/user', fn() => UserController::view());
$router->registerRoute('/user/new', fn() => UserController::create());
$router->registerRoute('/user/save', fn() => UserController::store());

// Router futtatása
try {
    $url = $_SERVER['REQUEST_URI'];
    $router->route($url);
} catch (NotFoundException $e) {
    fail($e->getMessage(), 404);
} catch (Throwable $e) {
    fail($e->getMessage());
}

// Session-be mentett flash üzenet törlése
if (isset($_SESSION['flash'])) {
    unset($_SESSION['flash']);
}
