<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);
json_response(['ok' => true, 'products' => get_products(true)]);
