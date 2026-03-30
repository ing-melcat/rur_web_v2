<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);
json_response(['ok' => true, 'invoices' => get_invoice_requests((int) current_user()['id'])]);
