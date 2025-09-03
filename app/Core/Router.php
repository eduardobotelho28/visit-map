<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, callable $handler): void
    {
        $path = $this->normalizePath($path);
        $this->routes[$method][$path] = $handler;
    }

    private function normalizePath(string $path): string
    {
        if ($path === '' || $path === '/') {
            return '/';
        }
        return '/' . trim($path, '/');
    }

    public function dispatch(string $method, string $uri): void
    {
       
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = $this->normalizePath($path);

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        if ($scriptName && $scriptName !== '/') {
           
            if (strpos($path, $scriptName) === 0) {
                $path = substr($path, strlen($scriptName)) ?: '/';
            } else {
                $base = rtrim(dirname($scriptName), '/');
                if ($base !== '' && $base !== '.' && strpos($path, $base) === 0) {
                    $path = substr($path, strlen($base)) ?: '/';
                }
            }
            $path = $this->normalizePath($path);
        }

        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            if ($path !== '/' && substr($path, -1) === '/') {
                $alt = rtrim($path, '/');
                $handler = $this->routes[$method][$alt] ?? null;
            } else {
                $alt = $path . '/';
                $handler = $this->routes[$method][$alt] ?? null;
            }
        }

        if (!$handler) {
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
            echo "<p>Path tentado: " . htmlspecialchars($path) . "</p>";
            echo "<pre>Rotas registradas:\n";
            foreach ($this->routes as $m => $rs) {
                foreach ($rs as $p => $_) {
                    echo "  $m $p\n";
                }
            }
            echo "</pre>";
            return;
        }

        $result = call_user_func($handler);
        if ($result !== null) {
            echo $result;
        }
    }
}
