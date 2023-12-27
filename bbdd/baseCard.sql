drop database coleccions;
CREATE DATABASE IF NOT EXISTS coleccions;
USE coleccions;


CREATE TABLE tipo (

idTipo INT auto_increment PRIMARY KEY,
nombreTipo VARCHAR(25) NOT NULL UNIQUE

);

CREATE TABLE atributo (

idAtributo INT auto_increment PRIMARY KEY,
nombreAtributo VARCHAR(25) NOT NULL UNIQUE

);

CREATE TABLE mounstro (

idMounstro INT auto_increment PRIMARY KEY,
nombre VARCHAR(25),
descripcion VARCHAR (255) NOT NULL, 
ataque INT NOT NULL,
defensa INT,
atributo INT NOT NULL ,
nivel INT,

FOREIGN KEY (atributo) REFERENCES atributo(idAtributo)

);

CREATE TABLE mounstro_Tipo(

idMounstro int,
idTipo int,

FOREIGN KEY (idMounstro) REFERENCES Mounstro (idMounstro),
FOREIGN KEY (idTipo) REFERENCES Tipo (idTipo)

);


INSERT INTO atributo (nombreAtributo)  VALUES ('Luz'), ('Oscuridad'), ('Fuego'), ('Agua'), ('Tierra'), ('Viento');
INSERT INTO tipo (nombreTipo)  VALUES ('Bestia'), ('Lanzador de conjuros'), ('ciberso'), ('Guerrero'), ('Demonio'), ('Bestia Divina'), ('Dragon'), ('Bestia Alada'), ('Ilusion'), ('Maquina'), ('Planta'), ('Trueno');
INSERT INTO mounstro (nombre,descripcion,ataque,defensa,atributo,nivel)  VALUES ('Mago Oscuro','El mas grande de los magos en relación con el ataque y la defensa',2500,2000,2,7)



