<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_login(false);
$orders = get_user_orders((int) current_user()['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Compras recientes | RUR Store</title>
  <link rel="icon" type="image/png" href="<?= e(base_url('resources/RUR_logo_white.png')) ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <?php include __DIR__ . '/components/nav-bar.php'; ?>
  <div class="container py-4">
    <h1 class="mb-3">Compras recientes</h1>
    <p class="text-muted">Consulta tu historial, revisa el estado del pago y abre tu ticket.</p>

    <div class="card shadow-sm border-0">
      <div class="card-body">
        <?php if (empty($orders)): ?>
          <p class="text-muted mb-0">Todavía no hay compras registradas.</p>
        <?php else: ?>
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th>Orden</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($orders as $order): ?>
                  <tr>
                    <td><?= e($order['order_number']) ?></td>
                    <td><?= e($order['created_at']) ?></td>
                    <td><?= e(money_format_mx((float) $order['total_amount'])) ?></td>
                    <td>
                      <span class="badge <?= $order['status'] === 'paid' ? 'text-bg-success' : ($order['status'] === 'declined' ? 'text-bg-danger' : 'text-bg-secondary') ?>">
                        <?= e($order['status']) ?>
                      </span>
                    </td>
                    <td class="d-flex gap-2 flex-wrap">
                      <a class="btn btn-sm btn-dark" href="<?= e(base_url('pages/ticket.php?order_id=' . (int) $order['id'])) ?>">Ticket</a>
                      <a class="btn btn-sm btn-outline-secondary" href="<?= e(base_url('pages/invoices.php?order_id=' . (int) $order['id'])) ?>">Factura</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
