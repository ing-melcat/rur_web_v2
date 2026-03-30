<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);
if (!is_post()) {
    json_response(['ok' => false, 'message' => 'Método no permitido.'], 405);
}
$data = request_data();
$productId = (int) post_or_get($data, 'product_id', 0);
$quantity = (int) post_or_get($data, 'quantity', 1);

try {
    $summary = update_cart_quantity((int) current_user()['id'], $productId, $quantity);
    json_response(['ok' => true, 'message' => 'Carrito actualizado.'] + $summary);
} catch (Throwable $e) {
    json_response(['ok' => false, 'message' => $e->getMessage()], 422);
}
