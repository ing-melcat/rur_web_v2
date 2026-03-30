<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

if (!is_post()) {
    json_response(['ok' => false, 'message' => 'Método no permitido.'], 405);
}

$data = request_data();
$email = trim((string) post_or_get($data, 'email', ''));
$password = (string) post_or_get($data, 'password', '');

if ($email === '' || $password === '') {
    json_response(['ok' => false, 'message' => 'Correo y contraseña son obligatorios.'], 422);
}

if (!login_with_credentials($email, $password)) {
    json_response(['ok' => false, 'message' => 'Credenciales inválidas.'], 401);
}

json_response([
    'ok' => true,
    'message' => 'Sesión iniciada correctamente.',
    'redirect' => base_url('pages/product.php'),
    'user' => current_user(),
]);
