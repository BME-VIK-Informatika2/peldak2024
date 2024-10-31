<?php

namespace App;

use App\Exceptions\NotFoundException;
use Exception;

class Router
{
    private array $routes = [];
    private string $prefix = "";

    public function registerRoute($name, $handler): void
    {
        $this->routes[$name] = $handler;
    }

    public function registerPrefix(string $string): void
    {
        $this->prefix = $string;
    }

    /**
     * @throws Exception
     */
    public function route($url): void
    {
        // Prefix eltávolítása
        $url = preg_replace('/^' . preg_quote($this->prefix, '/') . '/', '', $url);

        // Query string eltávolítása
        $url = strtok($url, '?');

        // Hiányzó route kezelése
        if (!isset($this->routes[$url])) {
            throw new NotFoundException("Route nem található!");
        }

        // Route futtatása
        $this->routes[$url]();
    }

    public function redirect($route): void
    {
        header("Location: " . $this->prefix . $route);
        exit;
    }

    public function link($url): string
    {
        return $this->prefix . $url;
    }
}


