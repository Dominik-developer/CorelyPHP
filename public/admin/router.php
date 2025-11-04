<?php

error_reporting(E_ALL);
ini_set('display_errors', '0');

// === BASE PATH ===
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($scriptDir, '/');

// === REQUEST URI ===
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// IGNORUJ STATYCZNE ZASOBY
if (preg_match('/\.(js|css|png|jpg|jpeg|gif|svg|ico|webp)$/i', $requestUri)) {
    return;
}

// Usuń base path
if ($basePath && strpos($requestUri, $basePath) === 0) {
    $path = substr($requestUri, strlen($basePath));
} else {
    $path = $requestUri;
}

$path = trim($path, '/');

// === ROUTER LOGIKA ===
$params = $path !== '' ? explode('/', $path) : ['dashboard'];

// Ograniczenie do maksymalnie 5 parametrów
if (count($params) > 5) {
    http_response_code(400);
    redirect('/admin/errors/400.php');
    exit('Bad request: too many parameters');
}

// Dozwolone ścieżki (definicje)
$allowedRoutes = [
    ['dashboard'],
    ['modules', 'content', 'edit', '*'],   // np. /modules/content/edit/123
    ['modules', 'content', 'add'],
    ['modules', 'users', 'edit', '*'],
    ['modules', 'users', 'delete', '*'],
    ['settings'],
    ['error', '*'],                        // np. /error/404
];

// === Walidacja ścieżki ===
$isAllowed = false;
foreach ($allowedRoutes as $route) {
    $matches = true;
    foreach ($route as $i => $part) {
        if (!isset($params[$i])) {
            $matches = false;
            break;
        }
        if ($part !== '*' && $params[$i] !== $part) {
            $matches = false;
            break;
        }
    }

    // Jeśli długość się zgadza (żeby /modules/content/edit/id/test nie przeszło)
    if ($matches && count($params) === count($route)) {
        $isAllowed = true;
        break;
    }
}

if (!$isAllowed) {
    http_response_code(404);
    redirect('/admin/errors/404.php');
    exit();
}

return $params;
