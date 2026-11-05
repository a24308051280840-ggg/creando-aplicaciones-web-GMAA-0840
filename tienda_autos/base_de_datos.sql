-- Ejecutar en phpMyAdmin (pestaña SQL).
-- OJO: borra y vuelve a crear las tablas categorias, autos y pedidos (los usuarios registrados se conservan).
CREATE DATABASE IF NOT EXISTS tienda_autos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tienda_autos;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  correo VARCHAR(100) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS autos;
DROP TABLE IF EXISTS categorias;

CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(40) NOT NULL
);

CREATE TABLE autos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_categoria INT NOT NULL,
  marca VARCHAR(40) NOT NULL,
  modelo VARCHAR(80) NOT NULL,
  anio INT NOT NULL,
  precio DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_auto INT NOT NULL,
  color VARCHAR(30) NOT NULL,
  forma_pago VARCHAR(30) NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
  FOREIGN KEY (id_auto) REFERENCES autos(id)
);

INSERT INTO categorias (id, nombre) VALUES
(1, 'Sedanes'),
(2, 'SUV'),
(3, 'Pickups'),
(4, 'Deportivos');

-- Sedanes (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio) VALUES
(1, 'Toyota',     'Corolla',        2026, 429900.00),
(1, 'Toyota',     'Camry',          2026, 659900.00),
(1, 'Nissan',     'Versa',          2026, 329900.00),
(1, 'Nissan',     'Sentra',         2026, 389900.00),
(1, 'Nissan',     'Altima',         2026, 599900.00),
(1, 'Chevrolet',  'Aveo',           2026, 279900.00),
(1, 'Honda',      'Civic',          2026, 499900.00),
(1, 'Honda',      'Accord',         2026, 749900.00),
(1, 'Volkswagen', 'Jetta',          2026, 449900.00),
(1, 'Mazda',      'Mazda 3 Sedán',  2026, 439900.00);

-- SUV (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio) VALUES
(2, 'Toyota',     'RAV4',     2026, 699900.00),
(2, 'Honda',      'CR-V',     2026, 659900.00),
(2, 'Mazda',      'CX-5',     2026, 619900.00),
(2, 'Nissan',     'Kicks',    2026, 399900.00),
(2, 'Nissan',     'X-Trail',  2026, 599900.00),
(2, 'Chevrolet',  'Tracker',  2026, 369900.00),
(2, 'Ford',       'Escape',   2026, 589900.00),
(2, 'Kia',        'Sportage', 2026, 569900.00),
(2, 'Hyundai',    'Tucson',   2026, 579900.00),
(2, 'Volkswagen', 'Tiguan',   2026, 679900.00);

-- Pickups (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio) VALUES
(3, 'Toyota',     'Hilux',      2026,  689900.00),
(3, 'Toyota',     'Tacoma',     2026,  849900.00),
(3, 'Nissan',     'Frontier',   2026,  649900.00),
(3, 'Ford',       'Ranger',     2026,  689900.00),
(3, 'Ford',       'F-150',      2026,  899900.00),
(3, 'Chevrolet',  'Silverado',  2026,  799900.00),
(3, 'RAM',        '1500',       2026,  929900.00),
(3, 'Mitsubishi', 'L200',       2026,  559900.00),
(3, 'Volkswagen', 'Amarok',     2026,  779900.00),
(3, 'GMC',        'Sierra',     2026, 1099900.00);

-- Deportivos (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio) VALUES
(4, 'Ford',      'Mustang',    2026, 1189900.00),
(4, 'Chevrolet', 'Camaro',     2026,  999900.00),
(4, 'Dodge',     'Challenger', 2026, 1199900.00),
(4, 'Nissan',    'Z',          2026, 1249900.00),
(4, 'Toyota',    'GR86',       2026,  749900.00),
(4, 'Subaru',    'BRZ',        2026,  779900.00),
(4, 'Mazda',     'MX-5',       2026,  649900.00),
(4, 'Chevrolet', 'Corvette',   2026, 1999900.00),
(4, 'BMW',       'M2',         2026, 1649900.00),
(4, 'Mini',      'John Cooper Works', 2026, 779900.00);
