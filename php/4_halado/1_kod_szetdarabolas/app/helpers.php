<?php

const VIEWS_PATH = 'resources/views/';
function view($view, $data = []): void
{
    extract($data);
    extract($_SESSION['flash'] ?? [], EXTR_SKIP);
    $content = VIEWS_PATH . "pages/{$view}.view.php";
    include VIEWS_PATH . 'layouts/layout.view.php';
}

function redirect($route, $flash = []): void
{
    global $router;

    $_SESSION['flash'] = $flash;

    $router->redirect($route);
}

function route($route): string
{
    global $router;
    return $router->link($route);
}

function fail($errorMessage, $errorCode = 500): void
{
    http_response_code($errorCode);
    switch ($errorCode) {
        case 404:
            $errorTitle = 'Nem található';
            break;
        case 500:
            $errorTitle = 'Szerver hiba';
            break;
        default:
            $errorTitle = 'Hiba';
            break;
    }
    view('error', compact('errorCode', 'errorTitle', 'errorMessage'));
    die;
}

