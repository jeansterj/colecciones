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
nombre VARCHAR(50) NOT NULL UNIQUE,
descripcion VARCHAR (255) NOT NULL, 
ataque INT NOT NULL,
defensa INT DEFAULT 0,
atributo INT NOT NULL ,
nivel INT,
img VARCHAR (255) NOT NULL,

FOREIGN KEY (atributo) REFERENCES atributo(idAtributo)

);

CREATE TABLE mounstro_Tipo(

idMounstro int,
idTipo int,

FOREIGN KEY (idMounstro) REFERENCES Mounstro (idMounstro),
FOREIGN KEY (idTipo) REFERENCES Tipo (idTipo)

);


INSERT INTO atributo (nombreAtributo)  VALUES ('Luz'), ('Oscuridad'), ('Fuego'), ('Agua'), ('Tierra'), ('Viento');
INSERT INTO tipo (nombreTipo)  VALUES ('LANZADOR DE CONJUROS'), ('BESTIA'), ('CIBERSO'), ('GUERRERO'), ('DEMONIO'), ('DRAGON'), ('ILUSION'), ('MAQUINA') ;
INSERT INTO mounstro (nombre,descripcion,ataque,defensa,atributo,nivel,img)  VALUES ('MAGO OSCURO','El mas grande de los magos en relación con el ataque y la defensa',2500,2000,2,7,'img/mounstros/dark_Magician.png');
INSERT INTO mounstro_Tipo VALUES ('1','2');
INSERT INTO mounstro_Tipo VALUES ('1','3');



