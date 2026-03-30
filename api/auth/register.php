<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

if (!is_post()) {
    json_response(['ok' => false, 'message' => 'Método no permitido.'], 405);
}

$data = request_data();
$name = trim((string) post_or_get($data, 'name', ''));
$email = trim(mb_strtolower((string) post_or_get($data, 'email', '')));
$password = (string) post_or_get($data, 'password', '');

if ($name === '' || $email === '' || $password === '') {
    json_response(['ok' => false, 'message' => 'Nombre, correo y contraseña son obligatorios.'], 422);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    json_response(['ok' => false, 'message' => 'Correo inválido.'], 422);
}

if (mb_strlen($password) < 6) {
    json_response(['ok' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres.'], 422);
}

$pdo = db();
$check = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$check->execute([$email]);
if ($check->fetch()) {
    json_response(['ok' => false, 'message' => 'Ese correo ya está registrado.'], 409);
}

$insert = $pdo->prepare('INSERT INTO users (name, email, password_hash, role, created_at) VALUES (?, ?, ?, ?, NOW())');
$insert->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), 'customer']);

login_with_credentials($email, $password);

json_response([
    'ok' => true,
    'message' => 'Cuenta creada correctamente.',
    'redirect' => base_url('pages/product.php'),
    'user' => current_user(),
], 201);
