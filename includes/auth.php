<?php
declare(strict_types=1);

function current_user(): ?array
{
    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    static $user = null;
    if ($user !== null && (int) $user['id'] === (int) $_SESSION['user_id']) {
        return $user;
    }

    $stmt = db()->prepare('SELECT id, name, email, role, created_at FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([(int) $_SESSION['user_id']]);
    $result = $stmt->fetch();
    $user = $result ?: null;
    return $user;
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function login_with_credentials(string $email, string $password): bool
{
    $stmt = db()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([trim(mb_strtolower($email))]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, (string) $user['password_hash'])) {
        return false;
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = (int) $user['id'];
    return true;
}

function logout_user(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function require_login(bool $api = false): void
{
    if (is_logged_in()) {
        return;
    }

    if ($api) {
        json_response(['ok' => false, 'message' => 'Debes iniciar sesión para continuar.'], 401);
    }

    flash('warning', 'Inicia sesión para acceder a productos, carrito, compras y facturas.');
    redirect_to(base_url('pages/login.php'));
}
