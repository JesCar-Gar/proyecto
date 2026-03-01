CREATE TABLE peticiones (
 id SERIAL PRIMARY KEY,
 oyente VARCHAR(100) NOT NULL,
 artista VARCHAR(100) NOT NULL,
 cancion_artista VARCHAR(150) NOT NULL,
 fecha_peticion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 reproducida BOOLEAN DEFAULT FALSE
);

CREATE TABLE creadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    biografia TEXT,
    habilidades TEXT,
    foto_url VARCHAR(255)
);

INSERT INTO creadores (nombre, apellido, biografia, habilidades, foto_url) VALUES
('Jesus', 'Caraballo', 'Estudiante de Ingeniería en computación', 'PHP, MySQL, Python', ''),
('Raul', '', '', '', ''),
('Adrian', 'Gutierrez', '', '', '');