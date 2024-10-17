# apiRestConPhp
ApiRest simple con Php, consumo y api junto con su bd en MySql.


BD --> 

CREATE DATABASE tienda;

USE tienda;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL
);

INSERT INTO productos (nombre, precio) VALUES 
('Producto A', 100.00),
('Producto B', 150.50);
