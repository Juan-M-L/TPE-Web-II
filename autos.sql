-- Creacion de tabla Marca.

CREATE TABLE Marca (
	MarcaId INT PRIMARY KEY AUTO_INCREMENT,
    MarcaNombre VARCHAR(20) NOT NULL UNIQUE
);

-- Creacion de tabla Auto.

CREATE TABLE Auto (
    AutoId INT PRIMARY KEY AUTO_INCREMENT,
    MarcaId INT NOT NULL,
    AutoModelo VARCHAR(50) NOT NULL,
    AutoCombustible VARCHAR(50) NOT NULL,
    AutoKilometraje INT NOT NULL,
    AutoPrecio NUMERIC(10,2) NOT NULL
);

ALTER TABLE Auto
ADD FOREIGN KEY (MarcaId)
REFERENCES Marca(MarcaId);

-- Operaciones de insercion.

INSERT INTO Marca(MarcaNombre)
VALUES 
    ('Mercedez-Benz'),
    ('BMW'),
    ('Audi'),
    ('Lexus');

INSERT INTO Auto (MarcaId, AutoModelo, AutoCombustible, AutoKilometraje, AutoPrecio)
VALUES 
    (1, 'A-Class', 'Nafta', 10000, 999999.99),
    (1, 'C-Class', 'Nafta', 15000, 1200000.00),
    (1, 'E-Class', 'Nafta', 20000, 1500000.00),
    (2, '3 Series', 'Nafta', 5000, 800000.50),
    (2, '5 Series', 'Nafta', 10000, 1000000.00),
    (2, 'X5', 'Nafta', 8000, 1300000.00),
    (3, 'A3', 'Nafta', 12000, 700000.00),
    (3, 'Q5', 'Nafta', 15000, 900000.00),
    (3, 'e-tron', 'Eléctrico', 10000, 999999.99),
    (4, 'ES 350', 'Nafta', 10000, 850000.00),
    (4, 'RX 500h', 'Híbrido', 8000, 1100000.00),
    (4, 'NX 450h+', 'Híbrido', 5000, 1200000.00);