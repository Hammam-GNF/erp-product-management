CREATE DATABASE IF NOT EXISTS erp_product_management;
USE erp_product_management;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_category VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name_product VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    CONSTRAINT chk_stock CHECK (stock >= 0),
    CONSTRAINT fk_category
        FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO categories (name_category) VALUES
('Elektronik'),
('Pakaian Pria'),
('Pakaian Wanita');

INSERT INTO products (category_id, name_product, price, stock) VALUES
(1, 'Smartphone', 5000000, 10),
(1, 'Laptop', 8000000, 5),
(2, 'Baju Pria', 200000, 5),
(3, 'Baju Wanita', 150000, 8);