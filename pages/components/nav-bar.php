<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
$user = current_user();
$cartSummary = $user ? get_cart_summary((int) $user['id']) : ['count' => 0, 'items' => [], 'subtotal' => 0];
?>
<header class="site-header sticky-top py-1 mb-4">
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #0f1424;">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="<?= e(base_url('index.php')) ?>" style="font-family: 'Roboto', sans-serif;">
        <img src="<?= e(base_url('resources/RUR_logo_white.png')) ?>" alt="Logo" width="40" height="40" class="me-2">
        Research Unit of Robotics
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMain" aria-controls="navbarNavMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavMain">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link <?= e(active_link('/index.php')) ?>" href="<?= e(base_url('index.php')) ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= e(active_link('/pages/members.php')) ?>" href="<?= e(base_url('pages/members.php')) ?>">Team Members</a></li>
          <li class="nav-item"><a class="nav-link <?= e(active_link('/pages/projects.php')) ?>" href="<?= e(base_url('pages/projects.php')) ?>">Projects</a></li>
          <li class="nav-item"><a class="nav-link <?= e(active_link('/pages/gallery.php')) ?>" href="<?= e(base_url('pages/gallery.php')) ?>">Gallery</a></li>
          <li class="nav-item"><a class="nav-link <?= e(active_link('/pages/product.php')) ?>" href="<?= e(base_url('pages/product.php')) ?>">Productos</a></li>
          <li class="nav-item"><a class="nav-link <?= e(active_link('/pages/cart.php')) ?>" href="<?= e(base_url('pages/cart.php')) ?>">Carrito</a></li>
          <li class="nav-item"><a class="nav-link <?= e(active_link('/pages/purchases.php')) ?>" href="<?= e(base_url('pages/purchases.php')) ?>">Compras recientes</a></li>
          <li class="nav-item"><a class="nav-link <?= e(active_link('/pages/invoices.php')) ?>" href="<?= e(base_url('pages/invoices.php')) ?>">Facturas</a></li>
        </ul>

        <div class="d-flex align-items-center gap-2">
          <?php if ($user): ?>
            <button class="btn btn-outline-light position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#miniCartCanvas" aria-controls="miniCartCanvas">
              Carrito rápido
              <span id="navCartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark"><?= (int) $cartSummary['count'] ?></span>
            </button>
            <span class="text-light small">Hola, <?= e($user['name']) ?></span>
            <button id="logoutButton" class="btn btn-warning text-dark fw-semibold">Salir</button>
          <?php else: ?>
            <span class="text-light small d-none d-lg-inline">Inicia sesión para entrar a tienda, carrito y compras.</span>
            <a class="btn btn-outline-light" href="<?= e(base_url('pages/login.php')) ?>">Login</a>
            <a class="btn btn-warning text-dark fw-semibold" href="<?= e(base_url('pages/register.php')) ?>">Registro</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>

<?php if ($user): ?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="miniCartCanvas" aria-labelledby="miniCartCanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="miniCartCanvasLabel">Tu carrito</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="miniCartItems">
      <?php if (!empty($cartSummary['items'])): ?>
        <?php foreach ($cartSummary['items'] as $item): ?>
          <div class="border rounded p-2 mb-2">
            <div class="fw-semibold"><?= e($item['name']) ?></div>
            <div class="small text-muted">Cantidad: <?= (int) $item['quantity'] ?></div>
            <div class="small"><?= e(money_format_mx((float) $item['price'])) ?></div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted mb-0">Tu carrito está vacío.</p>
      <?php endif; ?>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span class="fw-semibold">Subtotal</span>
      <span id="miniCartSubtotal"><?= e(money_format_mx((float) $cartSummary['subtotal'])) ?></span>
    </div>
    <div class="d-grid gap-2">
      <a class="btn btn-dark" href="<?= e(base_url('pages/cart.php')) ?>">Ver carrito</a>
      <a class="btn btn-outline-secondary" href="<?= e(base_url('pages/product.php')) ?>">Seguir comprando</a>
    </div>
  </div>
</div>
<script src="<?= e(base_url('assets/js/store-api.js')) ?>"></script>
<script>
  async function refreshMiniCart() {
    try {
      const data = await StoreApi.get('<?= e(base_url('api/cart/get.php')) ?>');
      const badge = document.getElementById('navCartCount');
      const items = document.getElementById('miniCartItems');
      const subtotal = document.getElementById('miniCartSubtotal');
      if (badge) badge.textContent = data.count ?? 0;
      if (subtotal) subtotal.textContent = StoreApi.mxn(data.subtotal ?? 0);
      if (items) {
        if (!data.items || !data.items.length) {
          items.innerHTML = '<p class="text-muted mb-0">Tu carrito está vacío.</p>';
          return;
        }
        items.innerHTML = data.items.map(item => `
          <div class="border rounded p-2 mb-2">
            <div class="fw-semibold">${item.name}</div>
            <div class="small text-muted">Cantidad: ${item.quantity}</div>
            <div class="small">${StoreApi.mxn(item.price)}</div>
          </div>
        `).join('');
      }
    } catch (error) {
      console.error(error);
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    refreshMiniCart();
    const logoutButton = document.getElementById('logoutButton');
    if (logoutButton) {
      logoutButton.addEventListener('click', async () => {
        try {
          const data = await StoreApi.post('<?= e(base_url('api/auth/logout.php')) ?>');
          window.location.href = data.redirect;
        } catch (error) {
          alert(error.message);
        }
      });
    }
  });
</script>
<?php endif; ?>
