-- Ejecutar en phpMyAdmin (pestaña SQL).
-- OJO: borra y vuelve a crear categorias, autos, carrito y ventas (los usuarios registrados se conservan).
CREATE DATABASE IF NOT EXISTS tienda_autos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tienda_autos;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  correo VARCHAR(100) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS venta_detalle;
DROP TABLE IF EXISTS ventas;
DROP TABLE IF EXISTS carrito;
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
  imagen VARCHAR(100) NOT NULL DEFAULT '',
  imagen_url VARCHAR(500) NOT NULL DEFAULT '',
  enlace VARCHAR(300) NOT NULL DEFAULT '',
  FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

-- Carrito: lo que cada usuario va agregando antes de comprar
CREATE TABLE carrito (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_auto INT NOT NULL,
  color VARCHAR(30) NOT NULL,
  cantidad INT NOT NULL DEFAULT 1,
  UNIQUE KEY un_item (id_usuario, id_auto, color),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
  FOREIGN KEY (id_auto) REFERENCES autos(id)
);

-- Ventas: una fila por cada compra finalizada
CREATE TABLE ventas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  total DECIMAL(14,2) NOT NULL,
  forma_pago VARCHAR(30) NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Detalle de cada venta: los autos que se compraron
CREATE TABLE venta_detalle (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_venta INT NOT NULL,
  id_auto INT NOT NULL,
  color VARCHAR(30) NOT NULL,
  cantidad INT NOT NULL,
  precio_unitario DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (id_venta) REFERENCES ventas(id),
  FOREIGN KEY (id_auto) REFERENCES autos(id)
);

INSERT INTO categorias (id, nombre) VALUES
(1, 'Sedanes'),
(2, 'SUV'),
(3, 'Pickups'),
(4, 'Deportivos');

-- Sedanes (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio, imagen, enlace) VALUES
(1, 'Toyota', 'Corolla', 2026, 429900.00, 'toyota-corolla', 'https://www.toyota.mx/modelos/gr/gr-corolla/'),
(1, 'Toyota', 'Camry', 2026, 659900.00, 'toyota-camry', 'https://www.toyota.mx/'),
(1, 'Nissan', 'Versa', 2026, 329900.00, 'nissan-versa', 'https://www.nissan.com.mx/'),
(1, 'Nissan', 'Sentra', 2026, 389900.00, 'nissan-sentra', 'https://www.nissan.com.mx/'),
(1, 'Nissan', 'Altima', 2026, 599900.00, 'nissan-altima', 'https://www.nissan.com.mx/'),
(1, 'Chevrolet', 'Aveo', 2026, 279900.00, 'chevrolet-aveo', 'https://www.chevrolet.com.mx/'),
(1, 'Honda', 'Civic', 2026, 499900.00, 'honda-civic', 'https://www.honda.mx/'),
(1, 'Honda', 'Accord', 2026, 749900.00, 'honda-accord', 'https://www.honda.mx/'),
(1, 'Volkswagen', 'Jetta', 2026, 449900.00, 'volkswagen-jetta', 'https://www.vw.com.mx/'),
(1, 'Mazda', 'Mazda 3 Sedán', 2026, 439900.00, 'mazda-mazda-3-sedan', 'https://www.mazda.com.mx/');

-- SUV (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio, imagen, enlace) VALUES
(2, 'Toyota', 'RAV4', 2026, 699900.00, 'toyota-rav4', 'https://www.toyotauniversidad.mx/toyota-rav4.html'),
(2, 'Honda', 'CR-V', 2026, 659900.00, 'honda-cr-v', 'https://www.honda.mx/'),
(2, 'Mazda', 'CX-5', 2026, 619900.00, 'mazda-cx-5', 'https://www.mazda.com.mx/'),
(2, 'Nissan', 'Kicks', 2026, 399900.00, 'nissan-kicks', 'https://www.nissan.com.mx/'),
(2, 'Nissan', 'X-Trail', 2026, 599900.00, 'nissan-x-trail', 'https://www.nissan.com.mx/'),
(2, 'Chevrolet', 'Tracker', 2026, 369900.00, 'chevrolet-tracker', 'https://www.chevrolet.com.mx/'),
(2, 'Ford', 'Escape', 2026, 589900.00, 'ford-escape', 'https://www.ford.mx/'),
(2, 'Kia', 'Sportage', 2026, 569900.00, 'kia-sportage', 'https://www.kia.com/mx/'),
(2, 'Hyundai', 'Tucson', 2026, 579900.00, 'hyundai-tucson', 'https://www.hyundai.com.mx/'),
(2, 'Volkswagen', 'Tiguan', 2026, 679900.00, 'volkswagen-tiguan', 'https://www.vw.com.mx/');

-- Pickups (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio, imagen, enlace) VALUES
(3, 'Toyota', 'Hilux', 2026, 689900.00, 'toyota-hilux', 'https://my-car.mx/auto/toyota-hilux-2026'),
(3, 'Toyota', 'Tacoma', 2026, 849900.00, 'toyota-tacoma', 'https://www.toyota.mx/'),
(3, 'Nissan', 'Frontier', 2026, 649900.00, 'nissan-frontier', 'https://www.nissan.com.mx/'),
(3, 'Ford', 'Ranger', 2026, 689900.00, 'ford-ranger', 'https://www.ford.mx/'),
(3, 'Ford', 'F-150', 2026, 899900.00, 'ford-f-150', 'https://www.ford.mx/'),
(3, 'Chevrolet', 'Silverado', 2026, 799900.00, 'chevrolet-silverado', 'https://www.chevrolet.com.mx/'),
(3, 'RAM', '1500', 2026, 929900.00, 'ram-1500', 'https://www.ram.com.mx/'),
(3, 'Mitsubishi', 'L200', 2026, 559900.00, 'mitsubishi-l200', 'https://www.mitsubishi-motors.com.mx/'),
(3, 'Volkswagen', 'Amarok', 2026, 779900.00, 'volkswagen-amarok', 'https://www.vw.com.mx/'),
(3, 'GMC', 'Sierra', 2026, 1099900.00, 'gmc-sierra', 'https://www.gmc.com.mx/');

-- Deportivos (10)
INSERT INTO autos (id_categoria, marca, modelo, anio, precio, imagen, enlace) VALUES
(4, 'Ford', 'Mustang', 2026, 1189900.00, 'ford-mustang', 'https://www.ford.mx/autos/mustang/2026/'),
(4, 'Chevrolet', 'Camaro', 2026, 999900.00, 'chevrolet-camaro', 'https://www.chevrolet.com.mx/'),
(4, 'Dodge', 'Challenger', 2026, 1199900.00, 'dodge-challenger', 'https://www.dodge.com.mx/'),
(4, 'Nissan', 'Z', 2026, 1249900.00, 'nissan-z', 'https://www.nissan.com.mx/'),
(4, 'Toyota', 'GR86', 2026, 749900.00, 'toyota-gr86', 'https://www.toyota.mx/'),
(4, 'Subaru', 'BRZ', 2026, 779900.00, 'subaru-brz', 'https://www.subaru.com.mx/'),
(4, 'Mazda', 'MX-5', 2026, 649900.00, 'mazda-mx-5', 'https://www.mazda.com.mx/'),
(4, 'Chevrolet', 'Corvette', 2026, 1999900.00, 'chevrolet-corvette', 'https://www.chevrolet.com.mx/'),
(4, 'BMW', 'M2', 2026, 1649900.00, 'bmw-m2', 'https://www.bmw.com.mx/'),
(4, 'Mini', 'John Cooper Works', 2026, 779900.00, 'mini-john-cooper-works', 'https://www.mini.com.mx/');
