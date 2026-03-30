<?php
require_once __DIR__ . '/../includes/bootstrap.php';
if (is_logged_in()) {
    redirect_to(base_url('pages/product.php'));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro | RUR Store</title>
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
      <div class="row g-4 align-items-stretch">
        <div class="col-lg-6 order-lg-2">
          <div class="rur-auth-side h-100 d-flex flex-column justify-content-between">
            <div>
              <span class="rur-kicker mb-3">Registro de cliente</span>
              <h1 class="rur-display-title mb-3">Crea tu cuenta y abre la tienda privada.</h1>
              <p class="rur-subtitle mb-4">Después del registro podrás entrar al catálogo, usar carrito, generar compras recientes, ticket y solicitud de factura, todo bajo el mismo flujo protegido.</p>

              <div class="row g-3">
                <div class="col-sm-6">
                  <div class="rur-mini-stat">
                    <span class="rur-stat-value">1 cuenta</span>
                    <span class="rur-stat-label">Acceso a productos y pagos</span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="rur-mini-stat">
                    <span class="rur-stat-value">1 carrito</span>
                    <span class="rur-stat-label">Resumen vivo desde el header</span>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <div class="rur-feature-list mb-3">
                <div class="rur-feature-item">
                  <span class="rur-feature-bullet">✓</span>
                  <p class="rur-feature-text">Contraseña segura desde el inicio.</p>
                </div>
                <div class="rur-feature-item">
                  <span class="rur-feature-bullet">✓</span>
                  <p class="rur-feature-text">Flujo listo para checkout hospedado con Conekta.</p>
                </div>
              </div>
              <img src="<?= e(base_url('resources/projects1.jpeg')) ?>" alt="RUR projects">
            </div>
          </div>
        </div>

        <div class="col-lg-6 order-lg-1">
          <div class="rur-auth-card h-100 d-flex flex-column justify-content-center">
            <div class="mb-4">
              <span class="rur-kicker">Registro</span>
              <h2 class="rur-section-title mt-3 mb-2">Crea una cuenta nueva</h2>
              <p class="rur-help-text mb-0">Solo al autenticarte tendrás acceso a productos, carrito, compras recientes y facturación.</p>
            </div>

            <form id="registerForm" class="d-grid gap-3">
              <div>
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" class="form-control rur-auth-input" name="name" placeholder="Tu nombre" required>
              </div>
              <div>
                <label class="form-label fw-semibold">Correo</label>
                <input type="email" class="form-control rur-auth-input" name="email" placeholder="[email protected]" required>
              </div>
              <div>
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" class="form-control rur-auth-input" name="password" minlength="6" placeholder="Mínimo 6 caracteres" required>
              </div>
              <div class="d-grid d-sm-flex gap-2 pt-2">
                <button class="btn rur-btn-primary flex-fill" type="submit">Crear cuenta</button>
                <a class="btn rur-btn-outline flex-fill" href="<?= e(base_url('pages/login.php')) ?>">Ya tengo cuenta</a>
              </div>
            </form>

            <div id="registerMessage" class="mt-4"></div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script src="<?= e(base_url('assets/js/store-api.js')) ?>"></script>
  <script>
    document.getElementById('registerForm').addEventListener('submit', async (event) => {
      event.preventDefault();
      const form = event.currentTarget;
      const payload = Object.fromEntries(new FormData(form).entries());
      const box = document.getElementById('registerMessage');
      box.innerHTML = '';
      try {
        const data = await StoreApi.post('<?= e(base_url('api/auth/register.php')) ?>', payload);
        box.innerHTML = `<div class="alert alert-success rounded-4">${data.message}</div>`;
        window.location.href = data.redirect;
      } catch (error) {
        box.innerHTML = `<div class="alert alert-danger rounded-4">${error.message}</div>`;
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
