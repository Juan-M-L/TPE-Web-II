-- Tabla Usuario
CREATE TABLE Usuario (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) UNIQUE NOT NULL,
    Contrasenia CHAR(60) NOT NULL
);

-- Inserción de datos en la tabla Usuario
INSERT INTO Usuario (Nombre, Contrasenia) VALUES
("webadmin", "$2y$10$jdxoVOfYq4YCF0T5vZzMA.pNvZR740p2Gh7vHuKRPBtfEPsWRPESy"),
("lautaro", "$2y$10$G.gksJ1/efgFSCfFtkqdT.AcApAKlT.ZqfVvp/lk4TXGQ5BqncCaa"),
("maria", "$2y$10$o4djgrVe5jZUYtp4dGDJ5ORnpU/NZ3AazVCX9ZuVjjiBnAoZyoaie"),
("lucas", "$2y$10$GHq10SylWH0r6GgVCmL/besES7bkBV9Ip0xbrfRfHG1BTNY9EaA2y");
--Contraseñas:
--webadmin -> admin
--lautaro -> 1234
--maria -> 1234
--lucas -> 1234