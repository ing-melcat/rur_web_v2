<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_login(false);
$products = get_products(true);
$methods = array_values(array_filter(array_map('trim', explode(',', (string) env('CONEKTA_ALLOWED_PAYMENT_METHODS', 'card,cash,bank_transfer')))));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos | RUR Store</title>
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
      <div class="rur-hero rur-hero-dark">
        <div class="row g-4 align-items-center">
          <div class="col-xl-7">
            <span class="rur-kicker mb-3">Catálogo privado RUR</span>
            <h1 class="rur-display-title mb-3">Productos y servicios listos para carrito y checkout.</h1>
            <p class="rur-subtitle mb-4">Este módulo vive detrás del login. Desde aquí puedes agregar al carrito, revisar tu resumen y saltar al pago usando el checkout hospedado de Conekta sin meter datos bancarios en tu servidor.</p>
            <div class="rur-hero-actions">
              <a class="btn rur-btn-primary" href="<?= e(base_url('pages/cart.php')) ?>">Abrir carrito</a>
              <a class="btn rur-btn-outline text-white border-white" href="<?= e(base_url('pages/purchases.php')) ?>">Ver compras recientes</a>
            </div>
          </div>
          <div class="col-xl-5">
            <div class="row g-3">
              <div class="col-sm-6">
                <div class="rur-mini-stat">
                  <span class="rur-stat-value"><?= count($products) ?></span>
                  <span class="rur-stat-label">productos activos</span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="rur-mini-stat">
                  <span class="rur-stat-value">Stock vivo</span>
                  <span class="rur-stat-label">se descuenta al pagar</span>
                </div>
              </div>
              <div class="col-12">
                <div class="rur-mini-stat">
                  <span class="d-block fw-bold mb-2">Métodos habilitados para Conekta</span>
                  <div class="rur-methods">
                    <?php foreach ($methods as $method): ?>
                      <span class="rur-chip"><?= e($method) ?></span>
                    <?php endforeach; ?>
                    <?php if (empty($methods)): ?>
                      <span class="rur-chip">Sin definir en .env</span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="rur-page-section">
      <div class="row g-4 align-items-stretch">
        <div class="col-lg-8">
          <div class="rur-panel h-100">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
              <div>
                <span class="rur-kicker">Tienda</span>
                <h2 class="rur-section-title mt-3 mb-2">Explora el catálogo</h2>
                <p class="rur-help-text mb-0">Productos inventados para que el flujo quede completo y funcional.</p>
              </div>
              <div class="rur-methods">
                <span class="rur-chip">Login requerido</span>
                <span class="rur-chip">Carrito activo</span>
                <span class="rur-chip">Ticket y factura</span>
              </div>
            </div>

            <div id="storeMessage"></div>

            <div class="row rur-grid-gap">
              <?php foreach ($products as $product): ?>
                <div class="col-md-6 col-xl-6">
                  <div class="card rur-product-card border-0">
                    <img src="<?= e(base_url($product['image_url'] ?: 'resources/rur-1.png')) ?>" alt="<?= e($product['name']) ?>">
                    <div class="card-body d-flex flex-column">
                      <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-2">
                        <h3 class="h5 fw-bold mb-0"><?= e($product['name']) ?></h3>
                        <span class="rur-price-pill"><?= e(money_format_mx((float) $product['price'])) ?></span>
                      </div>
                      <p class="text-muted mb-3 flex-grow-1"><?= e($product['description']) ?></p>
                      <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <span class="rur-stock-pill">Stock: <?= (int) $product['stock'] ?></span>
                        <button class="btn rur-btn-dark add-to-cart" data-product-id="<?= (int) $product['id'] ?>">Agregar al carrito</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="rur-info-card h-100">
            <span class="rur-kicker">Flujo de compra</span>
            <h2 class="h3 fw-bold mt-3 mb-3">Cómo queda funcionando</h2>
            <div class="rur-feature-list mb-4">
              <div class="rur-feature-item">
                <span class="rur-feature-bullet">1</span>
                <p class="rur-feature-text">Agregas productos desde esta vista protegida.</p>
              </div>
              <div class="rur-feature-item">
                <span class="rur-feature-bullet">2</span>
                <p class="rur-feature-text">El header actualiza el carrito y también puedes revisar el detalle completo.</p>
              </div>
              <div class="rur-feature-item">
                <span class="rur-feature-bullet">3</span>
                <p class="rur-feature-text">Desde carrito se crea la orden local y se redirige al checkout hospedado de Conekta.</p>
              </div>
              <div class="rur-feature-item">
                <span class="rur-feature-bullet">4</span>
                <p class="rur-feature-text">Cuando el pago queda confirmado, la orden se marca pagada y el stock se descuenta.</p>
              </div>
            </div>
            <div class="rur-login-note mb-3">
              <strong>Estado Conekta:</strong>
              <?= conekta_enabled() ? 'configurado desde .env y listo para generar checkout.' : 'no configurado todavía; agrega la llave privada en .env.' ?>
            </div>
            <div class="d-grid gap-2">
              <a class="btn rur-btn-primary" href="<?= e(base_url('pages/cart.php')) ?>">Ir a pagar</a>
              <a class="btn rur-btn-outline" href="<?= e(base_url('pages/invoices.php')) ?>">Facturas y tickets</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script src="<?= e(base_url('assets/js/store-api.js')) ?>"></script>
  <script>
    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', async () => {
        const box = document.getElementById('storeMessage');
        box.innerHTML = '';
        button.disabled = true;
        try {
          const data = await StoreApi.post('<?= e(base_url('api/cart/add.php')) ?>', {
            product_id: Number(button.dataset.productId),
            quantity: 1,
          });
          if (typeof refreshMiniCart === 'function') refreshMiniCart();
          box.innerHTML = `<div class="alert alert-success rounded-4">${data.message}</div>`;
        } catch (error) {
          box.innerHTML = `<div class="alert alert-danger rounded-4">${error.message}</div>`;
        } finally {
          button.disabled = false;
        }
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
