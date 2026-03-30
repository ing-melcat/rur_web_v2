<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$payload = file_get_contents('php://input') ?: '';
$data = json_decode($payload, true);
if (!is_array($data)) {
    http_response_code(400);
    echo 'invalid_json';
    exit;
}

$digestHeader = $_SERVER['HTTP_DIGEST'] ?? null;
$publicKey = env('CONEKTA_WEBHOOK_PUBLIC_KEY_PEM', '');
$verifyEnabled = filter_var(env('CONEKTA_VERIFY_WEBHOOK_DIGEST', 'false'), FILTER_VALIDATE_BOOLEAN);
$verified = !$verifyEnabled || conekta_verify_digest($payload, $digestHeader, $publicKey);

if (!$verified) {
    http_response_code(401);
    echo 'invalid_signature';
    exit;
}

$eventType = (string) ($data['type'] ?? 'unknown');
$eventId = (string) ($data['id'] ?? '');
$providerOrder = $data['data']['object'] ?? [];
$providerOrderId = (string) ($providerOrder['id'] ?? '');
$localOrderId = null;

if (!empty($providerOrder['metadata']['local_order_id'])) {
    $localOrderId = (int) $providerOrder['metadata']['local_order_id'];
} elseif ($providerOrderId !== '') {
    $existing = find_local_order_by_provider_order_id($providerOrderId);
    $localOrderId = $existing ? (int) $existing['id'] : null;
}

save_payment_event($localOrderId, 'conekta', $eventType, $eventId, $data);

try {
    if ($localOrderId !== null) {
        switch ($eventType) {
            case 'order.paid':
                finalize_paid_order($localOrderId, $providerOrder);
                break;
            case 'order.pending_payment':
                mark_order_status($localOrderId, 'pending_payment', 'pending_payment', $providerOrder);
                break;
            case 'order.declined':
                mark_order_status($localOrderId, 'declined', 'declined', $providerOrder);
                break;
            case 'order.canceled':
            case 'order.voided':
            case 'order.expired':
                mark_order_status($localOrderId, 'cancelled', $providerOrder['payment_status'] ?? 'cancelled', $providerOrder);
                break;
        }
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo 'error:' . $e->getMessage();
    exit;
}

http_response_code(200);
echo 'ok';
