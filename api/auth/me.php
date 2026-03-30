<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
json_response([
    'ok' => true,
    'authenticated' => is_logged_in(),
    'user' => current_user(),
]);
