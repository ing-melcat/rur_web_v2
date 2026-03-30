<?php
declare(strict_types=1);

function db_first_non_empty(string ...$values): ?string
{
    foreach ($values as $value) {
        if ($value !== null && trim($value) !== '') {
            return trim($value);
        }
    }
    return null;
}

function db_config_from_url(?string $url): ?array
{
    if ($url === null || trim($url) === '') {
        return null;
    }

    $parts = parse_url($url);
    if ($parts === false) {
        throw new RuntimeException('No se pudo interpretar DATABASE_URL/MYSQL_URL.');
    }

    return [
        'host' => (string) ($parts['host'] ?? ''),
        'port' => (string) ($parts['port'] ?? '3306'),
        'name' => isset($parts['path']) ? ltrim((string) $parts['path'], '/') : '',
        'user' => isset($parts['user']) ? urldecode((string) $parts['user']) : '',
        'pass' => isset($parts['pass']) ? urldecode((string) $parts['pass']) : '',
    ];
}

function db_resolve_config(): array
{
    $url = db_first_non_empty(
        env('DB_URL'),
        env('DATABASE_URL'),
        env('DATABASE_PRIVATE_URL'),
        env('MYSQL_URL'),
        env('MYSQL_PRIVATE_URL')
    );

    if ($url !== null) {
        $parsed = db_config_from_url($url);
        if ($parsed !== null && $parsed['host'] !== '' && $parsed['name'] !== '' && $parsed['user'] !== '') {
            return $parsed;
        }
    }

    $isProductionLike = db_first_non_empty(env('RAILWAY_ENVIRONMENT'), env('RAILWAY_PROJECT_ID'), env('APP_ENV')) !== null
        && strtolower((string) db_first_non_empty(env('APP_ENV'), 'production')) !== 'local';

    $host = db_first_non_empty(env('DB_HOST'), env('MYSQLHOST'));
    $port = db_first_non_empty(env('DB_PORT'), env('MYSQLPORT'), '3306');
    $name = db_first_non_empty(env('DB_NAME'), env('MYSQLDATABASE'));
    $user = db_first_non_empty(env('DB_USER'), env('MYSQLUSER'));
    $pass = db_first_non_empty(env('DB_PASS'), env('MYSQLPASSWORD'), '');

    if ($host === null && !$isProductionLike) {
        $host = '127.0.0.1';
    }
    if ($name === null && !$isProductionLike) {
        $name = 'rur_store';
    }
    if ($user === null && !$isProductionLike) {
        $user = 'root';
    }

    if ($host === null || $name === null || $user === null) {
        throw new RuntimeException(
            'Faltan variables de base de datos. Define DB_HOST/DB_PORT/DB_NAME/DB_USER/DB_PASS ' .
            'o referencia las variables del servicio MySQL de Railway en el servicio web.'
        );
    }

    return [
        'host' => $host,
        'port' => $port ?? '3306',
        'name' => $name,
        'user' => $user,
        'pass' => $pass ?? '',
    ];
}

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $config = db_resolve_config();

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['port'],
        $config['name']
    );

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
    } catch (PDOException $e) {
        $safeDsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $config['host'], $config['port'], $config['name']);
        throw new RuntimeException('No se pudo conectar a MySQL con la configuración actual (' . $safeDsn . '): ' . $e->getMessage(), 0, $e);
    }

    return $pdo;
}
