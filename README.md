# RUR Web + Store (Railway Ready)

Proyecto PHP listo para correr en Railway con:
- sitio institucional
- login / registro
- productos
- carrito
- compras recientes
- ticket / facturas base
- checkout con Conekta
- webhook de Conekta

## Railway

### Variables mínimas del servicio web
Pega esto en **Variables -> Raw Editor** del servicio web:

```env
APP_ENV=production
APP_TIMEZONE=America/Monterrey
APP_URL=https://rurweb-production.up.railway.app
APP_BASE_PATH=

DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_NAME=railway
DB_USER=${{MySQL.MYSQLUSER}}
DB_PASS=${{MySQL.MYSQLPASSWORD}}

CONEKTA_API_BASE=https://api.conekta.io
CONEKTA_PUBLIC_KEY=
CONEKTA_PRIVATE_KEY=
CONEKTA_ALLOWED_PAYMENT_METHODS=card,cash,bank_transfer
CONEKTA_MONTHLY_INSTALLMENTS_ENABLED=false
CONEKTA_VERIFY_WEBHOOK_DIGEST=false
CONEKTA_WEBHOOK_PUBLIC_KEY_PEM=

AUTO_DB_SETUP=false
HEALTHCHECK_DB=false
```

### Notas importantes
- No subas `.env` a GitHub.
- Railway usa las variables del panel; el `.env` es solo para local.
- Si ya importaste la base manualmente en Railway, deja `AUTO_DB_SETUP=false`.
- El webhook de Conekta debe apuntar a:
  `https://rurweb-production.up.railway.app/api/webhooks/conekta.php`

## Local
1. Copia `.env.example` a `.env`
2. Ajusta credenciales locales
3. Importa `database/rur_store.sql`
4. Levanta PHP local

## MySQL Railway
La base usada por la app debe ser `railway`.
