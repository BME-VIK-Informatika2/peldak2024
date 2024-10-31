<?php

/*
 * Csomagkezelés Demo
 *
 * Ha nincs telepítve a composer, telepítsük a leírás alapján
 * https://getcomposer.org/doc/00-intro.md
 *
 * Futtatás előtt telepíteni kell a függőségeket:
 * > composer install
 *
 * Tesztek futtatásához használjuk a test parancsot:
 * > composer test
 *
 */

use Info2\ComposerDemo\Application;
use Info2\ComposerDemo\Log\PrintLineLogger;

// Autoload
require 'vendor/autoload.php';

// Új application példány
$app = new Application();

// Logger beállítása
$logger = new PrintLineLogger();
$app->setLogger($logger);

// Inicializálás
$app->init();

// Indítás
$app->start();
