<?php
require_once __DIR__ . '/includes/bootstrap.php';

$status = [
    'ok' => true,
    'app' => 'rurweb',
    'time' => gmdate('c'),
    'db' => 'skipped',
];

$checkDb = filter_var((string) env('HEALTHCHECK_DB', 'false'), FILTER_VALIDATE_BOOL);
if ($checkDb) {
    try {
        db()->query('SELECT 1');
        $status['db'] = 'ok';
    } catch (Throwable $e) {
        http_response_code(503);
        $status['ok'] = false;
        $status['db'] = 'error';
        $status['message'] = $e->getMessage();
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($status, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
