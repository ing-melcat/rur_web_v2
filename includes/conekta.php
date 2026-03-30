<?php
declare(strict_types=1);

function conekta_enabled(): bool
{
    return (string) env('CONEKTA_PRIVATE_KEY', '') !== '';
}

function conekta_headers(): array
{
    $key = env('CONEKTA_PRIVATE_KEY', '');
    return [
        'Accept: application/vnd.conekta-v2.2.0+json',
        'Content-Type: application/json',
        'Authorization: Bearer ' . $key,
    ];
}

function conekta_request(string $method, string $endpoint, ?array $payload = null): array
{
    if (!conekta_enabled()) {
        throw new RuntimeException('Conekta no está configurado. Revisa tu .env');
    }

    $base = rtrim((string) env('CONEKTA_API_BASE', 'https://api.conekta.io'), '/');
    $url = $base . '/' . ltrim($endpoint, '/');

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => strtoupper($method),
        CURLOPT_HTTPHEADER => conekta_headers(),
        CURLOPT_TIMEOUT => 45,
    ]);

    if ($payload !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    $body = curl_exec($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($body === false) {
        throw new RuntimeException('No se pudo conectar con Conekta: ' . $curlError);
    }

    $decoded = json_decode($body, true);
    if ($httpCode < 200 || $httpCode >= 300) {
        $message = 'Conekta devolvió un error.';
        if (is_array($decoded)) {
            if (!empty($decoded['details'][0]['message'])) {
                $message .= ' ' . $decoded['details'][0]['message'];
            } elseif (!empty($decoded['message'])) {
                $message .= ' ' . $decoded['message'];
            }
        }
        $message .= ' (HTTP ' . $httpCode . ')';
        throw new RuntimeException($message);
    }

    if (!is_array($decoded)) {
        throw new RuntimeException('La respuesta de Conekta no pudo interpretarse.');
    }

    return $decoded;
}

function conekta_create_hosted_order(array $payload): array
{
    return conekta_request('POST', '/orders', $payload);
}

function conekta_get_order(string $providerOrderId): array
{
    return conekta_request('GET', '/orders/' . rawurlencode($providerOrderId));
}

function conekta_verify_digest(string $payload, ?string $digestHeader, ?string $publicKeyPem): bool
{
    if ($digestHeader === null || trim($digestHeader) === '' || $publicKeyPem === null || trim($publicKeyPem) === '') {
        return false;
    }

    $signature = base64_decode(trim($digestHeader), true);
    if ($signature === false) {
        return false;
    }

    $publicKey = openssl_pkey_get_public($publicKeyPem);
    if ($publicKey === false) {
        return false;
    }

    $verified = openssl_verify($payload, $signature, $publicKey, OPENSSL_ALGO_SHA256) === 1;
    openssl_free_key($publicKey);
    return $verified;
}
