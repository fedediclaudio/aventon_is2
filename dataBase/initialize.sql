INSERT INTO aventon.tipovehiculo (nombreTipo) VALUES ('Auto');
INSERT INTO aventon.tipovehiculo (nombreTipo) VALUES ('Camioneta');
INSERT INTO aventon.tipovehiculo (nombreTipo) VALUES ('Monopatin');
INSERT INTO aventon.tipovehiculo (nombreTipo) VALUES ('Avion');
INSERT INTO aventon.tipovehiculo (nombreTipo) VALUES ('Barco');

INSERT INTO aventon.usuario (nombre, apellido, password, tarjeta, email, nacionalidad, fecha_nacimiento, administrador, descripcion) 
VALUES ('Pedro', 'Dal Bianco', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', 'dalbianco.pedro@gmail.com', 'Argentino', 
str_to_date('1997-10-10', '%Y-%m-%d'), 1, 'Ee');

INSERT INTO aventon.usuario (nombre, apellido, password, tarjeta, email, nacionalidad, fecha_nacimiento, administrador, descripcion) 
VALUES ('Blas', 'Butera', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', 'blasbutera69@gmail.com', 'Argentino', 
str_to_date('1996-09-16', '%Y-%m-%d'), 0, 'Cebo buenos mates');

INSERT INTO aventon.usuario (nombre, apellido, password, tarjeta, email, nacionalidad, fecha_nacimiento, administrador, descripcion) 
VALUES ('Federico', 'Di Claudio', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', 'federicodicla@gmail.com', 'Argentino', 
str_to_date('1996-09-12', '%Y-%m-%d'), 1, '');