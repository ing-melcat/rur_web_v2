<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);
json_response(['ok' => true, 'orders' => get_user_orders((int) current_user()['id'])]);
