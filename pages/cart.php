<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_login(false);
$summary = get_cart_summary((int) current_user()['id']);
$methods = array_values(array_filter(array_map('trim', explode(',', (string) env('CONEKTA_ALLOWED_PAYMENT_METHODS', 'card,cash,bank_transfer')))));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carrito | RUR Store</title>
  <link rel="icon" type="image/png" href="<?= e(base_url('resources/RUR_logo_white.png')) ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <link href="<?= e(base_url('styles/bootstrap.min.css')) ?>" rel="stylesheet">
  <link href="<?= e(base_url('styles/style.css')) ?>" rel="stylesheet">
</head>
<body class="store-page">
  <?php include __DIR__ . '/components/nav-bar.php'; ?>

  <main class="store-main container py-4 py-lg-5">
    <section class="rur-page-section">
      <div class="rur-hero">
        <div class="row g-4 align-items-center">
          <div class="col-lg-8">
            <span class="rur-kicker mb-3">Checkout interno</span>
            <h1 class="rur-section-title mb-2">Tu carrito y el paso a Conekta</h1>
            <p class="rur-subtitle mb-0">Aquí ajustas cantidades, revisas subtotal y disparas la creación de la orden local antes de redirigir al checkout hospedado.</p>
          </div>
          <div class="col-lg-4 text-lg-end">
            <a class="btn rur-btn-outline" href="<?= e(base_url('pages/product.php')) ?>">Seguir comprando</a>
          </div>
        </div>
      </div>
    </section>

    <section class="rur-page-section">
      <div id="cartMessage"></div>
      <div class="row g-4 align-items-start">
        <div class="col-lg-8">
          <div class="rur-cart-card">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
              <div>
                <span class="rur-kicker">Detalle</span>
                <h2 class="h3 fw-bold mt-3 mb-1">Productos seleccionados</h2>
              </div>
              <span class="rur-chip"><?= (int) $summary['count'] ?> artículo(s)</span>
            </div>

            <?php if (empty($summary['items'])): ?>
              <div class="rur-empty-state">
                <h3 class="h5 fw-bold mb-2">Tu carrito está vacío</h3>
                <p class="mb-3">Agrega productos desde el catálogo para habilitar el pago.</p>
                <a class="btn rur-btn-primary" href="<?= e(base_url('pages/product.php')) ?>">Ir a productos</a>
              </div>
            <?php else: ?>
              <div class="table-responsive">
                <table class="table rur-table align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Precio</th>
                      <th style="width: 170px;">Cantidad</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="cartTableBody">
                    <?php foreach ($summary['items'] as $item): ?>
                      <tr data-product-id="<?= (int) $item['product_id'] ?>">
                        <td>
                          <div class="fw-bold"><?= e($item['name']) ?></div>
                          <div class="text-muted small"><?= e($item['description']) ?></div>
                          <div class="small mt-1">Stock disponible: <strong><?= (int) $item['stock'] ?></strong></div>
                        </td>
                        <td><?= e(money_format_mx((float) $item['price'])) ?></td>
                        <td>
                          <input type="number" class="form-control rur-qty-input item-qty" min="1" max="<?= (int) $item['stock'] ?>" value="<?= (int) $item['quantity'] ?>">
                        </td>
                        <td class="fw-bold line-total"><?= e(money_format_mx((float) $item['line_total'])) ?></td>
                        <td><button class="btn rur-btn-outline py-2 px-3 remove-item">Quitar</button></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="rur-status-card mb-4">
            <span class="rur-kicker">Resumen</span>
            <h2 class="h3 fw-bold mt-3 mb-3">Antes de pagar</h2>
            <div class="d-flex justify-content-between mb-2"><span>Productos</span><strong id="summaryCount"><?= (int) $summary['count'] ?></strong></div>
            <div class="d-flex justify-content-between mb-3"><span>Subtotal</span><strong id="summarySubtotal"><?= e(money_format_mx((float) $summary['subtotal'])) ?></strong></div>
            <div class="rur-divider"></div>
            <div class="mb-3">
              <div class="fw-semibold mb-2">Métodos disponibles en Conekta</div>
              <div class="rur-methods">
                <?php foreach ($methods as $method): ?>
                  <span class="rur-chip"><?= e($method) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="rur-login-note mb-3">
              <strong>Importante:</strong> el stock se descuenta cuando la orden queda pagada o cuando el webhook confirme el pago.
            </div>
            <div class="d-grid gap-2">
              <button id="payButton" class="btn rur-btn-primary" <?= empty($summary['items']) || !conekta_enabled() ? 'disabled' : '' ?>>Pagar con Conekta</button>
              <a class="btn rur-btn-outline" href="<?= e(base_url('pages/purchases.php')) ?>">Ver compras recientes</a>
            </div>
            <?php if (!conekta_enabled()): ?>
              <div class="alert alert-warning rounded-4 mt-3 mb-0">Falta configurar <code>CONEKTA_PRIVATE_KEY</code> en tu <code>.env</code>.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script src="<?= e(base_url('assets/js/store-api.js')) ?>"></script>
  <script>
    function showCartMessage(type, message) {
      document.getElementById('cartMessage').innerHTML = `<div class="alert alert-${type} rounded-4">${message}</div>`;
    }

    async function refreshCartPage() {
      try {
        const data = await StoreApi.get('<?= e(base_url('api/cart/get.php')) ?>');
        if (typeof refreshMiniCart === 'function') refreshMiniCart();
        document.getElementById('summaryCount').textContent = data.count ?? 0;
        document.getElementById('summarySubtotal').textContent = StoreApi.mxn(data.subtotal ?? 0);
      } catch (error) {
        console.error(error);
      }
    }

    document.querySelectorAll('.item-qty').forEach(input => {
      input.addEventListener('change', async () => {
        const row = input.closest('tr');
        try {
          await StoreApi.post('<?= e(base_url('api/cart/update.php')) ?>', {
            product_id: Number(row.dataset.productId),
            quantity: Number(input.value),
          });
          showCartMessage('success', 'Carrito actualizado.');
          await refreshCartPage();
          window.location.reload();
        } catch (error) {
          showCartMessage('danger', error.message);
        }
      });
    });

    document.querySelectorAll('.remove-item').forEach(button => {
      button.addEventListener('click', async () => {
        const row = button.closest('tr');
        try {
          await StoreApi.post('<?= e(base_url('api/cart/remove.php')) ?>', {
            product_id: Number(row.dataset.productId),
          });
          showCartMessage('success', 'Producto eliminado del carrito.');
          await refreshCartPage();
          window.location.reload();
        } catch (error) {
          showCartMessage('danger', error.message);
        }
      });
    });

    const payButton = document.getElementById('payButton');
    if (payButton) {
      payButton.addEventListener('click', async () => {
        payButton.disabled = true;
        payButton.textContent = 'Generando checkout...';
        try {
          const data = await StoreApi.post('<?= e(base_url('api/checkout/create.php')) ?>');
          if (!data.checkout_url) throw new Error('Conekta no devolvió URL de checkout.');
          window.location.href = data.checkout_url;
        } catch (error) {
          payButton.disabled = false;
          payButton.textContent = 'Pagar con Conekta';
          showCartMessage('danger', error.message);
        }
      });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
