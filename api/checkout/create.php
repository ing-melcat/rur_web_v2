<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_login(true);

if (!is_post()) {
    json_response(['ok' => false, 'message' => 'Método no permitido.'], 405);
}

if (!conekta_enabled()) {
    json_response(['ok' => false, 'message' => 'Conekta no está configurado en el .env.'], 500);
}

$user = current_user();
$localOrder = null;

try {
    $localOrder = create_pending_order_from_cart((int) $user['id']);
    $orderItems = $localOrder['items'] ?? [];

    $lineItems = array_map(static function (array $item): array {
        return [
            'name' => $item['product_name'],
            'description' => $item['product_name'],
            'unit_price' => (int) round(((float) $item['unit_price']) * 100),
            'quantity' => (int) $item['quantity'],
        ];
    }, $orderItems);

    $payload = [
        'currency' => 'MXN',
        'customer_info' => [
            'name' => $user['name'],
            'email' => $user['email'],
            'phone' => env('DEFAULT_CUSTOMER_PHONE', '6180000000'),
        ],
        'line_items' => $lineItems,
        'metadata' => [
            'local_order_id' => (string) $localOrder['id'],
            'order_number' => (string) $localOrder['order_number'],
        ],
        'checkout' => [
            'allowed_payment_methods' => array_map('trim', explode(',', (string) env('CONEKTA_ALLOWED_PAYMENT_METHODS', 'card,cash,bank_transfer'))),
            'type' => 'HostedPayment',
            'success_url' => absolute_url('pages/checkout_return.php?status=success&local_order_id=' . (int) $localOrder['id']),
            'failure_url' => absolute_url('pages/checkout_return.php?status=failure&local_order_id=' . (int) $localOrder['id']),
            'monthly_installments_enabled' => filter_var(env('CONEKTA_MONTHLY_INSTALLMENTS_ENABLED', 'false'), FILTER_VALIDATE_BOOLEAN),
            'monthly_installments_options' => [3, 6, 9, 12],
            'redirection_time' => 4,
        ],
    ];

    $providerOrder = conekta_create_hosted_order($payload);
    mark_order_status((int) $localOrder['id'], 'pending_payment', (string) ($providerOrder['payment_status'] ?? 'pending_payment'), $providerOrder);

    json_response([
        'ok' => true,
        'message' => 'Orden creada. Redirigiendo a Conekta.',
        'local_order_id' => (int) $localOrder['id'],
        'provider_order_id' => $providerOrder['id'] ?? null,
        'checkout_url' => $providerOrder['checkout']['url'] ?? null,
        'provider' => $providerOrder,
    ]);
} catch (Throwable $e) {
    if (is_array($localOrder) && !empty($localOrder['id'])) {
        try {
            mark_order_status((int) $localOrder['id'], 'cancelled', 'cancelled');
        } catch (Throwable $ignored) {
        }
    }
    json_response(['ok' => false, 'message' => $e->getMessage()], 422);
}
