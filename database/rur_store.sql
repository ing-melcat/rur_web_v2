CREATE DATABASE IF NOT EXISTS rur_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rur_store;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') NOT NULL DEFAULT 'customer',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image_url VARCHAR(255) DEFAULT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cart_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_user_product (user_id, product_id),
    CONSTRAINT fk_cart_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_cart_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    order_number VARCHAR(60) NOT NULL UNIQUE,
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    status ENUM('pending_payment', 'paid', 'declined', 'cancelled') NOT NULL DEFAULT 'pending_payment',
    payment_status VARCHAR(50) NOT NULL DEFAULT 'pending_payment',
    payment_provider VARCHAR(50) DEFAULT 'conekta',
    payment_provider_order_id VARCHAR(120) DEFAULT NULL,
    payment_provider_checkout_id VARCHAR(120) DEFAULT NULL,
    payment_checkout_url VARCHAR(255) DEFAULT NULL,
    stock_discounted TINYINT(1) NOT NULL DEFAULT 0,
    paid_at DATETIME DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS order_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    line_total DECIMAL(10,2) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_items_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS invoice_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    rfc VARCHAR(20) NOT NULL,
    razon_social VARCHAR(180) NOT NULL,
    billing_email VARCHAR(190) NOT NULL,
    uso_cfdi VARCHAR(20) NOT NULL,
    regimen_fiscal VARCHAR(20) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    status ENUM('requested', 'processing', 'completed', 'rejected') NOT NULL DEFAULT 'requested',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_invoice_order_user (order_id, user_id),
    CONSTRAINT fk_invoice_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    CONSTRAINT fk_invoice_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS payment_events (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    provider VARCHAR(50) NOT NULL,
    event_type VARCHAR(100) NOT NULL,
    event_id VARCHAR(120) DEFAULT NULL,
    order_id INT UNSIGNED DEFAULT NULL,
    payload_json LONGTEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_payment_order (order_id),
    CONSTRAINT fk_payment_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT INTO users (name, email, password_hash, role)
SELECT 'Administrador RUR', '[email protected]', '$2y$12$Iu3NyN.T/eJn3nbKkN5f9OSoLQTE40Occ7jwHu.erqZU9bXSm11ye', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = '[email protected]');

INSERT INTO users (name, email, password_hash, role)
SELECT 'Cliente Demo', '[email protected]', '$2y$12$C.2RJ4a6u8U9GE6VzYaYH.p/3T4B7l1wNTPDL.uGDlBO/WvZQa1Ti', 'customer'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = '[email protected]');

INSERT INTO products (name, slug, description, price, stock, image_url, is_active)
SELECT 'Kit de Sensores para Rover', 'kit-sensores-rover', 'Pack inventado para proyectos RUR con sensores ultrasónicos, IMU y cables listos para prototipado.', 1499.00, 12, 'resources/rassor1.jpeg', 1
WHERE NOT EXISTS (SELECT 1 FROM products WHERE slug = 'kit-sensores-rover');

INSERT INTO products (name, slug, description, price, stock, image_url, is_active)
SELECT 'Servicio de Impresión 3D Educativa', 'servicio-impresion-3d', 'Servicio interno de impresión 3D para piezas funcionales, prototipos y carcasas de robótica.', 450.00, 30, 'resources/rur-1.png', 1
WHERE NOT EXISTS (SELECT 1 FROM products WHERE slug = 'servicio-impresion-3d');

INSERT INTO products (name, slug, description, price, stock, image_url, is_active)
SELECT 'Curso Express de Integración ESP32', 'curso-esp32', 'Curso base para integrar ESP32 con sensores, actuadores y panel web.', 899.00, 20, 'resources/projects1.jpeg', 1
WHERE NOT EXISTS (SELECT 1 FROM products WHERE slug = 'curso-esp32');

INSERT INTO products (name, slug, description, price, stock, image_url, is_active)
SELECT 'Mantenimiento Preventivo de Robot', 'mantenimiento-robot', 'Servicio de revisión de cableado, tornillería, firmware y pruebas funcionales.', 1299.00, 10, 'resources/rur-members1.jpeg', 1
WHERE NOT EXISTS (SELECT 1 FROM products WHERE slug = 'mantenimiento-robot');

INSERT INTO products (name, slug, description, price, stock, image_url, is_active)
SELECT 'Mini Plataforma UMO AI', 'mini-plataforma-umo-ai', 'Plataforma demostrativa estilo RUR para prototipos de navegación y visión artificial.', 3999.00, 5, 'resources/fsi.png', 1
WHERE NOT EXISTS (SELECT 1 FROM products WHERE slug = 'mini-plataforma-umo-ai');
