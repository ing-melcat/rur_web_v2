<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);
$user = current_user();
json_response(['ok' => true] + get_cart_summary((int) $user['id']));
