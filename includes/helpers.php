<?php
declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function json_response(array $payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function request_data(): array
{
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (str_contains($contentType, 'application/json')) {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw ?: '{}', true);
        return is_array($data) ? $data : [];
    }
    return $_POST ?: $_GET ?: [];
}

function is_post(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return is_array($flash) ? $flash : null;
}

function project_root(): string
{
    return defined('PROJECT_ROOT') ? PROJECT_ROOT : dirname(__DIR__);
}

function app_base_path(): string
{
    static $basePath = null;
    if ($basePath !== null) {
        return $basePath;
    }

    $configured = env('APP_BASE_PATH');
    if ($configured !== null && $configured !== '') {
        $basePath = '/' . trim($configured, '/');
        if ($basePath === '/') {
            $basePath = '';
        }
        return $basePath;
    }

    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    $projectRoot = realpath(project_root()) ?: project_root();
    $docRootReal = $docRoot ? (realpath($docRoot) ?: $docRoot) : '';

    if ($docRootReal && str_starts_with(str_replace('\\', '/', $projectRoot), str_replace('\\', '/', $docRootReal))) {
        $relative = substr(str_replace('\\', '/', $projectRoot), strlen(str_replace('\\', '/', $docRootReal)));
        $relative = '/' . trim($relative, '/');
        $basePath = $relative === '/' ? '' : $relative;
        return $basePath;
    }

    $basePath = '';
    return $basePath;
}

function app_origin(): string
{
    $scheme = 'http';
    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        $scheme = strtolower(trim(explode(',', (string) $_SERVER['HTTP_X_FORWARDED_PROTO'])[0]));
    } elseif (!empty($_SERVER['REQUEST_SCHEME'])) {
        $scheme = strtolower((string) $_SERVER['REQUEST_SCHEME']);
    } elseif (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        $scheme = 'https';
    }

    $host = (string) ($_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost');
    if ($host === '') {
        $host = 'localhost';
    }

    return $scheme . '://' . $host;
}

function base_url(string $path = ''): string
{
    $path = ltrim($path, '/');
    $appUrl = rtrim((string) env('APP_URL', ''), '/');
    if ($appUrl !== '') {
        return $appUrl . ($path !== '' ? '/' . $path : '');
    }

    $basePath = app_base_path();
    if ($path === '') {
        return $basePath !== '' ? $basePath : '/';
    }
    return ($basePath !== '' ? $basePath : '') . '/' . $path;
}

function absolute_url(string $path = ''): string
{
    $path = ltrim($path, '/');
    $appUrl = rtrim((string) env('APP_URL', ''), '/');
    if ($appUrl !== '') {
        return $appUrl . ($path !== '' ? '/' . $path : '');
    }

    $basePath = app_base_path();
    $fullPath = $basePath;
    if ($path !== '') {
        $fullPath .= '/' . $path;
    }
    $fullPath = '/' . ltrim($fullPath, '/');

    return app_origin() . $fullPath;
}

function current_path(): string
{
    return parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
}

function redirect_to(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function post_or_get(array $data, string $key, mixed $default = null): mixed
{
    return $data[$key] ?? $default;
}

function money_format_mx(float $value): string
{
    return '$' . number_format($value, 2);
}

function active_link(string $needle): string
{
    return str_contains(current_path(), $needle) ? 'active' : '';
}
