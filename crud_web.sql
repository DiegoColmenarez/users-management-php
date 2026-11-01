CREATE DATABASE IF NOT EXISTS crud_web
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE crud_web;

CREATE TABLE IF NOT EXISTS users (
    id CHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('ADMIN', 'MEMBER', 'REVIEWER') NOT NULL,
    status ENUM('ACTIVE', 'INACTIVE', 'PENDING', 'BLOCKED')
        NOT NULL DEFAULT 'PENDING',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS computers (
    id CHAR(36) NOT NULL PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    category ENUM('DESKTOP', 'LAPTOP', 'ALL-IN-ONE', 'SERVER') NOT NULL,
    cpu_brand VARCHAR(100) NOT NULL,
    cpu_speed DECIMAL(6,2) NOT NULL,
    ram_technology VARCHAR(50) NOT NULL,
    ram_capacity DECIMAL(10,2) NOT NULL,
    storage_technology VARCHAR(50) NOT NULL,
    storage_capacity DECIMAL(10,2) NOT NULL,
    usb_ports INT UNSIGNED NOT NULL DEFAULT 0,
    hdmi_ports INT UNSIGNED NOT NULL DEFAULT 0,
    monitor_brand VARCHAR(100) NOT NULL,
    screen_size_inches DECIMAL(5,2) NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    CONSTRAINT chk_computers_cpu_speed CHECK (cpu_speed > 0),
    CONSTRAINT chk_computers_ram_capacity CHECK (ram_capacity > 0),
    CONSTRAINT chk_computers_storage_capacity CHECK (storage_capacity > 0),
    CONSTRAINT chk_computers_screen_size CHECK (screen_size_inches > 0),
    CONSTRAINT chk_computers_price CHECK (price >= 0)
) ENGINE=InnoDB;

INSERT IGNORE INTO computers (
    id,
    brand,
    category,
    cpu_brand,
    cpu_speed,
    ram_technology,
    ram_capacity,
    storage_technology,
    storage_capacity,
    usb_ports,
    hdmi_ports,
    monitor_brand,
    screen_size_inches,
    price
) VALUES
    ('3123fed6-be27-4c2a-8f13-9dcf5e90ce48', 'Lenovo', 'LAPTOP', 'Intel Core i5', 2.40, 'DDR4', 16.00, 'SSD NVMe', 512.00, 3, 1, 'Lenovo', 15.60, 749.99),
    ('f66c8a91-9c03-4ce1-ae7f-a463da91c209', 'Dell', 'DESKTOP', 'Intel Core i7', 3.20, 'DDR4', 32.00, 'SSD NVMe', 1000.00, 6, 1, 'Dell', 24.00, 1299.00),
    ('08d9b182-47c0-41b0-95d4-2b4314f2e9d4', 'HP', 'ALL-IN-ONE', 'Intel Core i5', 2.80, 'DDR4', 16.00, 'SSD', 512.00, 4, 1, 'HP', 23.80, 999.50),
    ('4f261764-45f7-4e46-b196-27b47432676f', 'Acer', 'LAPTOP', 'AMD Ryzen 5', 3.60, 'DDR5', 16.00, 'SSD NVMe', 512.00, 3, 1, 'Acer', 15.60, 829.99),
    ('fbbf408c-6752-4cd4-be76-7ccf47c454e2', 'Apple', 'LAPTOP', 'Apple M2', 3.49, 'Unified Memory', 16.00, 'SSD', 512.00, 2, 1, 'Apple', 13.60, 1399.00),
    ('b31c684d-ae28-4a7c-b58c-5844f34d3ba5', 'ASUS', 'DESKTOP', 'AMD Ryzen 7', 3.80, 'DDR5', 32.00, 'SSD NVMe', 2000.00, 6, 2, 'ASUS', 27.00, 1599.99),
    ('50581981-53b4-48f8-98cb-3eb72d348fdf', 'MSI', 'LAPTOP', 'Intel Core i7', 2.60, 'DDR5', 32.00, 'SSD NVMe', 1000.00, 4, 1, 'MSI', 17.30, 1799.00),
    ('cf3b8a25-2413-417c-a285-7f7203154d36', 'Samsung', 'LAPTOP', 'Intel Core i5', 2.50, 'LPDDR5', 16.00, 'SSD NVMe', 512.00, 3, 1, 'Samsung', 15.00, 899.00),
    ('38db9e5c-a05f-4e94-943e-e10158a2bfd5', 'Gigabyte', 'DESKTOP', 'AMD Ryzen 9', 4.00, 'DDR5', 64.00, 'SSD NVMe', 2000.00, 8, 2, 'Gigabyte', 32.00, 2499.99),
    ('1bc14900-d44d-4579-b592-de2d3b3a0e57', 'Microsoft', 'LAPTOP', 'Intel Core i7', 3.00, 'LPDDR5', 16.00, 'SSD', 1000.00, 2, 1, 'Microsoft', 13.50, 1499.00),
    ('a0b6db63-d868-4d96-a47e-bc1141e5de61', 'ThinkCentre', 'DESKTOP', 'Intel Core i5', 2.90, 'DDR4', 8.00, 'SSD', 256.00, 6, 1, 'Lenovo', 22.00, 579.00),
    ('3324a920-0485-4ec6-a806-070e52791629', 'HP ProDesk', 'DESKTOP', 'Intel Core i3', 3.00, 'DDR4', 8.00, 'SSD', 512.00, 6, 1, 'HP', 21.50, 499.99),
    ('68406cd5-bf04-43a4-ba08-a98afd4995df', 'Dell PowerEdge', 'SERVER', 'Intel Xeon Silver', 2.40, 'DDR4 ECC', 64.00, 'SSD', 2000.00, 4, 2, 'Dell', 24.00, 3299.00),
    ('1854c7cc-9ef8-4e72-bdb4-9b14949a5a19', 'ASUS VivoBook', 'LAPTOP', 'AMD Ryzen 3', 2.60, 'DDR4', 8.00, 'SSD', 256.00, 3, 1, 'ASUS', 14.00, 549.50),
    ('453acbac-9386-4582-ae57-b0719abddd0f', 'Apple iMac', 'ALL-IN-ONE', 'Apple M3', 4.05, 'Unified Memory', 16.00, 'SSD', 1000.00, 4, 2, 'Apple', 24.00, 1899.00);
