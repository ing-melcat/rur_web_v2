<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);

if (!is_post()) {
    json_response(['ok' => false, 'message' => 'Método no permitido.'], 405);
}

$data = request_data();
$orderId = (int) post_or_get($data, 'order_id', 0);
$order = get_order_by_id($orderId, (int) current_user()['id'], false);
if (!$order) {
    json_response(['ok' => false, 'message' => 'Orden no encontrada.'], 404);
}
if (($order['status'] ?? '') !== 'paid') {
    json_response(['ok' => false, 'message' => 'Solo puedes solicitar factura para compras pagadas.'], 422);
}

create_or_update_invoice_request((int) current_user()['id'], $orderId, $data);
json_response(['ok' => true, 'message' => 'Solicitud de factura registrada.']);
