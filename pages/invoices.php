<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_login(false);
$user = current_user();
$orderId = (int) ($_GET['order_id'] ?? 0);
$order = $orderId ? get_order_by_id($orderId, (int) $user['id']) : null;
$invoiceRequests = get_invoice_requests((int) $user['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facturas | RUR Store</title>
  <link rel="icon" type="image/png" href="<?= e(base_url('resources/RUR_logo_white.png')) ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <?php include __DIR__ . '/components/nav-bar.php'; ?>
  <div class="container py-4">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h2 class="mb-3">Solicitar factura</h2>
            <p class="text-muted">Esta pantalla registra la solicitud y los datos fiscales de la compra pagada.</p>
            <?php if (!$order): ?>
              <div class="alert alert-secondary">Abre esta pantalla desde una compra pagada para precargar la orden.</div>
            <?php elseif ($order['status'] !== 'paid'): ?>
              <div class="alert alert-warning">La orden seleccionada todavía no está pagada.</div>
            <?php else: ?>
              <div class="alert alert-dark small">
                Orden: <strong><?= e($order['order_number']) ?></strong><br>
                Total: <strong><?= e(money_format_mx((float) $order['total_amount'])) ?></strong>
              </div>
              <form id="invoiceForm" class="d-grid gap-3">
                <input type="hidden" name="order_id" value="<?= (int) $order['id'] ?>">
                <div><label class="form-label">RFC</label><input class="form-control" name="rfc" required></div>
                <div><label class="form-label">Razón social</label><input class="form-control" name="razon_social" required></div>
                <div><label class="form-label">Correo de facturación</label><input type="email" class="form-control" name="billing_email" value="<?= e($user['email']) ?>" required></div>
                <div><label class="form-label">Uso CFDI</label><input class="form-control" name="uso_cfdi" placeholder="G03" required></div>
                <div><label class="form-label">Régimen fiscal</label><input class="form-control" name="regimen_fiscal" placeholder="601" required></div>
                <div><label class="form-label">Código postal</label><input class="form-control" name="postal_code" required></div>
                <button class="btn btn-dark" type="submit">Guardar solicitud</button>
              </form>
              <div id="invoiceMessage" class="mt-3"></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h2 class="mb-3">Solicitudes registradas</h2>
            <?php if (empty($invoiceRequests)): ?>
              <p class="text-muted mb-0">No hay solicitudes de factura todavía.</p>
            <?php else: ?>
              <?php foreach ($invoiceRequests as $invoice): ?>
                <div class="border rounded p-3 mb-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-semibold"><?= e($invoice['razon_social']) ?></div>
                    <span class="badge text-bg-secondary"><?= e($invoice['status']) ?></span>
                  </div>
                  <div class="small text-muted">Orden: <?= e($invoice['order_number']) ?> · <?= e(money_format_mx((float) $invoice['total_amount'])) ?></div>
                  <div class="small">RFC: <?= e($invoice['rfc']) ?> · Uso CFDI: <?= e($invoice['uso_cfdi']) ?></div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= e(base_url('assets/js/store-api.js')) ?>"></script>
  <script>
    const invoiceForm = document.getElementById('invoiceForm');
    if (invoiceForm) {
      invoiceForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const payload = Object.fromEntries(new FormData(invoiceForm).entries());
        const box = document.getElementById('invoiceMessage');
        box.innerHTML = '';
        try {
          const data = await StoreApi.post('<?= e(base_url('api/invoices/request.php')) ?>', payload);
          box.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
          window.location.reload();
        } catch (error) {
          box.innerHTML = `<div class="alert alert-danger">${error.message}</div>`;
        }
      });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
