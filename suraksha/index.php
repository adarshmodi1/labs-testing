<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$base = __DIR__.'/../suraksha-app';

// First run on the server: create .env with a fresh secret key, and the demo database.
if (! file_exists($base.'/.env')) {
    $env = file_get_contents($base.'/.env.labs');
    $env = preg_replace('/^APP_KEY=.*$/m', 'APP_KEY=base64:'.base64_encode(random_bytes(32)), $env);
    file_put_contents($base.'/.env', $env);
}
if (! file_exists($base.'/database/database.sqlite')) {
    copy($base.'/database/demo-seed.sqlite', $base.'/database/database.sqlite');
}

if (file_exists($maintenance = $base.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $base.'/vendor/autoload.php';

$app = require_once $base.'/bootstrap/app.php';
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
