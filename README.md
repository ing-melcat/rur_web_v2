# Research Unit of Robotics Web Page + Store + Conekta

Este proyecto ya está preparado para:

- ejecutarse en local con PHP/MySQL,
- subirse a GitHub,
- desplegarse en Railway con Docker,
- conectarse a un servicio MySQL de Railway,
- procesar checkout hospedado y webhook de Conekta.

## Qué incluye

- Login y registro.
- Productos protegidos por sesión.
- Carrito y compras recientes.
- Ticket y solicitud de factura.
- Checkout hospedado con Conekta.
- Webhook para confirmar el pago.
- `Dockerfile` para Railway.
- `railway.json` con healthcheck y predeploy.
- `scripts/init-db.php` para crear tablas y sembrar datos demo.
- `health.php` para healthcheck.

## Estructura importante

- `Dockerfile`
- `railway.json`
- `health.php`
- `scripts/init-db.php`
- `database/rur_store.sql`
- `.env.example`
- `api/webhooks/conekta.php`
- `api/checkout/create.php`

## Despliegue en Railway

### 1) Sube el repo a GitHub

```bash
git init
git add .
git commit -m "feat: railway-ready RUR web store"
git branch -M main
git remote add origin TU_REPO_GITHUB
git push -u origin main
```

### 2) En Railway crea el proyecto

- `New Project`
- `Deploy from GitHub repo`
- selecciona este repositorio

### 3) Agrega MySQL al mismo proyecto

Crea un servicio MySQL desde el canvas del proyecto.

### 4) En el servicio web agrega estas variables

#### Variables normales

```env
APP_ENV=production
APP_TIMEZONE=America/Monterrey
APP_URL=https://rurweb-production.up.railway.app
APP_BASE_PATH=
CONEKTA_API_BASE=https://api.conekta.io
CONEKTA_PUBLIC_KEY=
CONEKTA_PRIVATE_KEY=
CONEKTA_ALLOWED_PAYMENT_METHODS=card,cash,bank_transfer
CONEKTA_VERIFY_WEBHOOK_DIGEST=false
CONEKTA_WEBHOOK_PUBLIC_KEY_PEM=
AUTO_DB_SETUP=true
HEALTHCHECK_DB=false
```

#### Variables de base de datos usando referencias de Railway

> Cambia `MySQL` por el nombre real de tu servicio MySQL si lo nombraste distinto.

```env
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_NAME=${{MySQL.MYSQLDATABASE}}
DB_USER=${{MySQL.MYSQLUSER}}
DB_PASS=${{MySQL.MYSQLPASSWORD}}
```

### 5) Networking

Activa `Public Networking` en tu servicio web y usa este dominio:

```text
https://rurweb-production.up.railway.app
```

### 6) Webhook de Conekta

En el panel de Conekta configura este webhook:

```text
https://rurweb-production.up.railway.app/api/webhooks/conekta.php
```

Eventos recomendados:

- `order.paid`
- `order.pending_payment`
- `order.declined`
- `order.expired`
- `order.canceled`
- `order.voided`

### 7) Primer deploy

El archivo `railway.json` ejecuta esto antes de levantar el servicio:

```bash
php scripts/init-db.php
```

Ese script:

- crea/verifica tablas,
- inserta usuarios demo,
- inserta productos demo,
- no destruye la información existente.

## Healthcheck

Railway usa:

```text
/health.php
```

Si quieres que el healthcheck también verifique la conexión a MySQL:

```env
HEALTHCHECK_DB=true
```

## Usuarios demo

- Admin: `[email protected]` / `admin123`
- Cliente: `[email protected]` / `cliente123`

## Importante sobre seguridad

- No subas `.env` a GitHub.
- Rota y reemplaza cualquier llave de Conekta que ya hayas expuesto.
- En producción conviene activar `CONEKTA_VERIFY_WEBHOOK_DIGEST=true` y cargar la llave pública del webhook.

## Facturas

- Ticket: funcional.
- Factura: guarda la solicitud fiscal dentro del sistema.
- CFDI timbrado automático: no incluido todavía.

## Flujo de compra

1. Usuario inicia sesión.
2. Agrega productos al carrito.
3. Se crea orden local pendiente.
4. Se crea orden en Conekta.
5. Usuario paga en checkout hospedado.
6. Conekta redirige al retorno.
7. El webhook confirma pago.
8. Se descuenta stock una sola vez.
9. La compra aparece en compras recientes.
