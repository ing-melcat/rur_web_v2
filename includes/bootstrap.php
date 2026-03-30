<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', dirname(__DIR__));
}

require_once PROJECT_ROOT . '/includes/env.php';
load_env(PROJECT_ROOT . '/.env');

date_default_timezone_set((string) env('APP_TIMEZONE', 'America/Mexico_City'));

require_once PROJECT_ROOT . '/includes/helpers.php';
require_once PROJECT_ROOT . '/includes/db.php';
require_once PROJECT_ROOT . '/includes/auth.php';
require_once PROJECT_ROOT . '/includes/conekta.php';
require_once PROJECT_ROOT . '/includes/purchases.php';
