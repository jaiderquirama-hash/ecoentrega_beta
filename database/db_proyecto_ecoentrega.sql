-- ============================================================
-- SCRIPT SQL PARA PHP MY ADMIN - PROYECTO ECOENTREGA
-- Base de Datos: db_proyecto_ecoentrega
-- ============================================================

CREATE DATABASE IF NOT EXISTS `db_proyecto_ecoentrega` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_proyecto_ecoentrega`;

-- --------------------------------------------------------
-- 1. Tabla: users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) NOT NULL DEFAULT 'user',
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 2. Tabla: password_reset_tokens
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL PRIMARY KEY,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 3. Tabla: sessions
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 4. Tabla: cache
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` BIGINT NOT NULL,
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 5. Tabla: cache_locks
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` BIGINT NOT NULL,
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 6. Tabla: jobs
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` SMALLINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 7. Tabla: job_batches
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT NULL DEFAULT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 8. Tabla: failed_jobs
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `uuid` VARCHAR(255) NOT NULL UNIQUE,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 9. Tabla: categories
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `category_name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 10. Tabla: products
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `product_name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `size` VARCHAR(255) NOT NULL,
  `garment_condition` VARCHAR(255) NOT NULL,
  `color` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NULL DEFAULT NULL,
  `publication_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_category` BIGINT UNSIGNED NOT NULL,
  `id_user` BIGINT UNSIGNED NOT NULL,
  CONSTRAINT `fk_products_categories` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `fk_products_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 11. Tabla: shopping_carts
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `shopping_carts` (
  `id_cart` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `creation_date` DATETIME NOT NULL,
  `id_user` BIGINT UNSIGNED NOT NULL UNIQUE,
  CONSTRAINT `fk_shopping_carts_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 12. Tabla: cart_details
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cart_details` (
  `id_cart_detail` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_cart` BIGINT UNSIGNED NOT NULL,
  `id_product` BIGINT UNSIGNED NOT NULL,
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
  `subtotal` DECIMAL(10,2) NOT NULL,
  UNIQUE KEY `unique_cart_product` (`id_cart`, `id_product`),
  CONSTRAINT `fk_cart_details_carts` FOREIGN KEY (`id_cart`) REFERENCES `shopping_carts` (`id_cart`) ON DELETE CASCADE,
  CONSTRAINT `fk_cart_details_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 13. Tabla: requests
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `requests` (
  `id_request` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `size` VARCHAR(255) NOT NULL,
  `color` VARCHAR(255) NOT NULL,
  `max_price` DECIMAL(10,2) NULL DEFAULT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `request_date` DATETIME NOT NULL,
  `id_user` BIGINT UNSIGNED NOT NULL,
  CONSTRAINT `fk_requests_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 14. Tabla: payments
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `payments` (
  `id_payment` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `payment_method` VARCHAR(255) NOT NULL,
  `payment_status` VARCHAR(255) NOT NULL,
  `payment_date` DATETIME NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 15. Tabla: request_details
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `request_details` (
  `id_request_detail` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_request` BIGINT UNSIGNED NOT NULL,
  `id_product` BIGINT UNSIGNED NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `message` TEXT NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_request_details_requests` FOREIGN KEY (`id_request`) REFERENCES `requests` (`id_request`) ON DELETE CASCADE,
  CONSTRAINT `fk_request_details_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 16. Tabla: sends
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sends` (
  `id_send` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_user` BIGINT UNSIGNED NOT NULL,
  `id_request` BIGINT UNSIGNED NOT NULL,
  `send_status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `notes` TEXT NULL DEFAULT NULL,
  `send_date` DATETIME NOT NULL,
  CONSTRAINT `fk_sends_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_sends_requests` FOREIGN KEY (`id_request`) REFERENCES `requests` (`id_request`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 17. Tabla: clients
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_user` BIGINT UNSIGNED NOT NULL UNIQUE,
  `document_number` VARCHAR(255) NULL DEFAULT NULL UNIQUE,
  `phone` VARCHAR(30) NULL DEFAULT NULL,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `fk_clients_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 18. Tabla: orders
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_user` BIGINT UNSIGNED NOT NULL,
  `id_client` BIGINT UNSIGNED NULL DEFAULT NULL,
  `id_payment` BIGINT UNSIGNED NULL DEFAULT NULL UNIQUE,
  `total` DECIMAL(10,2) NOT NULL,
  `order_status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_orders_clients` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE SET NULL,
  CONSTRAINT `fk_orders_payments` FOREIGN KEY (`id_payment`) REFERENCES `payments` (`id_payment`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 19. Tabla: order_details
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `order_details` (
  `id_order_detail` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_order` BIGINT UNSIGNED NOT NULL,
  `id_product` BIGINT UNSIGNED NOT NULL,
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
  `unit_price` DECIMAL(10,2) NOT NULL,
  `subtotal` DECIMAL(10,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  UNIQUE KEY `unique_order_product` (`id_order`, `id_product`),
  CONSTRAINT `fk_order_details_orders` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_details_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 20. Tabla: reviews
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `reviews` (
  `id_review` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `id_user` BIGINT UNSIGNED NOT NULL,
  `id_product` BIGINT UNSIGNED NOT NULL,
  `rating` TINYINT UNSIGNED NOT NULL,
  `comment` TEXT NULL DEFAULT NULL,
  `review_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_user_product_review` (`id_user`, `id_product`),
  CONSTRAINT `fk_reviews_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reviews_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
