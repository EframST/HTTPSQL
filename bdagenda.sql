CREATE DATABASE IF NOT EXISTS bdagenda;

USE bdagenda;

CREATE TABLE IF NOT EXISTS contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apaterno VARCHAR(30) NOT NULL,
    amaterno VARCHAR(30),
    genero VARCHAR(1),
    fecha_nacimiento DATE,
    telefono VARCHAR(20),
    email VARCHAR(70),
    linkedin VARCHAR(50)
);
