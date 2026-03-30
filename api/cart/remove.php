<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);
if (!is_post()) {
    json_response(['ok' => false, 'message' => 'Método no permitido.'], 405);
}
$data = request_data();
$productId = (int) post_or_get($data, 'product_id', 0);
$summary = remove_cart_item((int) current_user()['id'], $productId);
json_response(['ok' => true, 'message' => 'Producto eliminado del carrito.'] + $summary);
