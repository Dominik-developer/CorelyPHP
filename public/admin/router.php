<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', '0'); // value '0' turns off error display

// === BASE PATH ===
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($scriptDir, '/');

// === REQUEST URI ===
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Usuń base path z początku
if ($basePath && strpos($requestUri, $basePath) === 0) {
    $path = substr($requestUri, strlen($basePath));
} else {
    $path = $requestUri;
}

// Normalizuj ścieżkę
$path = trim($path, '/');

// === ROUTER LOGIKA ===

// Podziel ścieżkę na części
$params = $path !== '' ? explode('/', $path) : [];

// Jeśli nie ma parametrów → ustaw domyślny
if (empty($params)) {
    $params = ['dashboard'];
}

// Pierwszy parametr
$firstParam = $params[0];

if($firstParam === 'index.php') {
    //$params[0] = 'dashboard';
    $params = ['dashboard'];
}

// Ścieżka do folderu z plikami admina
$adminDir = __DIR__ . '/modules/';

// Ścieżka do folderu z zasobami (assets)
$assetsDir = __DIR__ . '/assets/';

// Zabezpieczenie – nie pozwól ładować nic z assets/
if (strpos($firstParam, 'modules') === 0) {
    $firstParam = 'dashboard';
}

// Ustal nazwę pliku do załadowania
$fileToInclude = $adminDir . basename($firstParam) . '.php';

// Jeśli plik nie istnieje lub nazwa nie jest poprawna – fallback do dashboard
/*if (!preg_match('/^[a-zA-Z0-9_-]+$/', $firstParam) || !file_exists($fileToInclude)) {
    $fileToInclude = $adminDir . 'dashboard.php';
}*/

// Zwróć parametry (np. do dalszego wykorzystania)
//$GLOBALS['param'] = $params;

// Załaduj odpowiedni plik
//include $fileToInclude;

return $params;

