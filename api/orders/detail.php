<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);
$orderId = (int) ($_GET['id'] ?? 0);
$order = get_order_by_id($orderId, (int) current_user()['id']);
if (!$order) {
    json_response(['ok' => false, 'message' => 'Orden no encontrada.'], 404);
}
json_response(['ok' => true, 'order' => $order]);
