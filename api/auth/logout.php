<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
logout_user();
json_response(['ok' => true, 'redirect' => base_url('pages/login.php')]);
