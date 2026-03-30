<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

function cli_log(string $message): void
{
    fwrite(STDOUT, $message . PHP_EOL);
}

$sqlPath = dirname(__DIR__) . '/database/rur_store.sql';
if (!is_file($sqlPath)) {
    fwrite(STDERR, "No se encontró el archivo SQL: {$sqlPath}" . PHP_EOL);
    exit(1);
}

$shouldRun = filter_var((string) env('AUTO_DB_SETUP', 'true'), FILTER_VALIDATE_BOOL);
if (!$shouldRun) {
    cli_log('AUTO_DB_SETUP=false, se omite la inicialización de la base de datos.');
    exit(0);
}

try {
    $pdo = db();
    $pdo->exec('SET NAMES utf8mb4');

    $sql = file_get_contents($sqlPath);
    if ($sql === false) {
        throw new RuntimeException('No se pudo leer el archivo SQL.');
    }

    $filtered = [];
    foreach (preg_split('/\R/', $sql) as $line) {
        $trimmed = ltrim($line);
        if (preg_match('/^CREATE\s+DATABASE\b/i', $trimmed)) {
            continue;
        }
        if (preg_match('/^USE\s+/i', $trimmed)) {
            continue;
        }
        $filtered[] = $line;
    }

    $statements = preg_split('/;\s*(?:\R|$)/', implode(PHP_EOL, $filtered));
    $count = 0;

    foreach ($statements as $statement) {
        $statement = trim($statement);
        if ($statement === '') {
            continue;
        }
        $pdo->exec($statement);
        $count++;
    }

    cli_log("Base de datos inicializada/verificada correctamente. Sentencias ejecutadas: {$count}");
    exit(0);
} catch (Throwable $e) {
    fwrite(STDERR, 'Error al inicializar la base de datos: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
