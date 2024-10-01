-- Tabla Modelo.
CREATE TABLE Modelo (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL UNIQUE,
    Anio INT NOT NULL,
    Capacidad INT NOT NULL,
    Combustible VARCHAR(50) NOT NULL
);

-- Tabla Auto.
CREATE TABLE Auto (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Marca VARCHAR(50) NOT NULL,
    ModeloId INT NOT NULL,
    Kilometraje INT NOT NULL,
    Precio NUMERIC(10,2) NOT NULL
);

ALTER TABLE Auto
ADD FOREIGN KEY (ModeloId)
REFERENCES Modelo(Id);

-- Inserción de datos en Modelo
INSERT INTO Modelo (Nombre, Anio, Capacidad, Combustible) VALUES
('Ferrari 488 GTB', 2020, 2, 'Gasolina'),
('Ferrari Portofino', 2021, 4, 'Gasolina'),
('Lamborghini Huracan', 2020, 2, 'Gasolina'),
('Lamborghini Aventador', 2021, 2, 'Gasolina'),
('Porsche Panamera', 2022, 4, 'Híbrido'),
('Porsche Taycan', 2023, 4, 'Eléctrico'),
('Bentley Continental GT', 2020, 4, 'Gasolina'),
('Bentley Flying Spur', 2022, 4, 'Gasolina'),


-- Inserción de datos en Auto
INSERT INTO Auto (Marca, ModeloId, Kilometraje, Precio) VALUES
('Ferrari', 1, 5000, 250000.00),
('Ferrari', 2, 3000, 220000.00),
('Ferrari', 1, 1000, 230000.00),
('Ferrari', 2, 200, 500000.00),
('Ferrari', 1, 1500, 270000.00),
('Lamborghini', 3, 4000, 200000.00),
('Lamborghini', 4, 2500, 400000.00),
('Lamborghini', 3, 10000, 220000.00),
('Lamborghini', 4, 500, 350000.00),
('Lamborghini', 3, 8000, 180000.00),
('Porsche', 5, 6000, 150000.00),
('Porsche', 6, 12000, 80000.00),
('Porsche', 5, 3000, 120000.00),
('Porsche', 6, 500, 130000.00),
('Porsche', 5, 7000, 90000.00),
('Bentley', 7, 4000, 220000.00),
('Bentley', 8, 8000, 180000.00),
('Bentley', 7, 3000, 250000.00),
('Bentley', 8, 10000, 300000.00),
('Bentley', 7, 200, 400000.00);
