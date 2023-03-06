/*  Mysql */
CREATE DATABASE vuelos;

USE vuelos;

SET SESSION FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS pasaje CASCADE ;
DROP TABLE IF EXISTS vuelo CASCADE ;
DROP TABLE IF EXISTS pasajero CASCADE ;
DROP TABLE IF EXISTS aeropuerto CASCADE ;


/* Create Tables */

CREATE TABLE aeropuerto
(
	codaeropuerto varchar(10) NOT NULL,
	nombre varchar(20),
	ciudad varchar(20),
	pais varchar(20),
	tasa int,
	CONSTRAINT PKaeropuerto PRIMARY KEY (codaeropuerto)
) ENGINE=InnoDB ;

CREATE TABLE pasaje
(
	idpasaje int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	pasajerocod int NOT NULL,
	identificador varchar(10) NOT NULL,
	numasiento int,
	clase varchar(10) ,
	pvp float,
	CONSTRAINT pasajeidentificador UNIQUE (pasajerocod, identificador)
) ENGINE=InnoDB ;


CREATE TABLE pasajero
(
	pasajerocod int NOT NULL,
	nombre varchar(30),
	tlf varchar(10),
	direccion varchar(40),
	pais varchar(15),
	CONSTRAINT pkpasajero PRIMARY KEY (pasajerocod)
) ENGINE=InnoDB ;


CREATE TABLE vuelo
(
	identificador varchar(10) NOT NULL,
	aeropuertoorigen varchar(10),
	aeropuertodestino varchar(10),
	tipovuelo varchar(15),
	fechavuelo date,
	descuento int,
	CONSTRAINT pkvuelo PRIMARY KEY (identificador)
) ENGINE=InnoDB ;



/* Create Foreign Keys */

ALTER TABLE vuelo
	ADD CONSTRAINT esorigen FOREIGN KEY (aeropuertoorigen)
	REFERENCES aeropuerto (codaeropuerto)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
;


ALTER TABLE vuelo
	ADD CONSTRAINT esdestino FOREIGN KEY (aeropuertodestino)
	REFERENCES aeropuerto (codaeropuerto)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
;



ALTER TABLE pasaje
	ADD CONSTRAINT fkpasajepasajero FOREIGN KEY (pasajerocod)
	REFERENCES pasajero(pasajerocod)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
;


ALTER TABLE pasaje
	ADD CONSTRAINT fkpasajevuelo FOREIGN KEY (identificador)
	REFERENCES vuelo (identificador)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
;


/* -- Inserta en tablas */
/* -- INSERTAR EN aeropuerto
-- codaeropuerto VARCHAR2 (10),  nombre VARCHAR2 (20) ciudad VARCHAR2 (20) , pais VARCHAR2 (20) */
insert into aeropuerto values ('BRU EBBR', 'Bruselas-Zaventem', 'Bruselas', 'B�lgica', 20);
insert into aeropuerto values ('RL  EBCI', 'Bruselas-Charleroi', 'Bruselas', 'B�lgica', 20);
insert into aeropuerto values ('PRG LKPR', 'aeropuerto de Praga', 'Praga', 'Rep�blica Checa',50);
insert into aeropuerto values ('CPH EKCH', 'Copenhague-Kastrup', 'Copenhague', 'Dinamarca',150);

insert into aeropuerto values ('MAD LEMD', 'Madrid-Barajas', 'Madrid', 'Espa�a', 30);
insert into aeropuerto values ('PMI LEPA', 'Son San Juan', 'Palma de Mallorca', 'Espa�a',30);
insert into aeropuerto values ('HEL EFHK', 'Helsinki-Vantaa', 'Helsinki', 'Finlandia',170);
insert into aeropuerto values ('GWY EICM', 'aeropuerto de Galway', 'Galway', 'Irlanda',30);

insert into aeropuerto values ('OSL ENGM', 'Oslo-Gardermoen', 'Olso', 'Noruega',170);

	


/*----pasajero,  cod NUMBER (5)     nombre VARCHAR2 (30) ,   tlf VARCHAR2 (10) ,  direccion VARCHAR2 (40)  */
INSERT INTO pasajero VALUES (1,'ATONIO MART�NEZ', '123456','AVDA MADRID 2, 2�A, TALAVERA', 'ESPA�A');
INSERT INTO pasajero VALUES (2,'MARIA DUE�AS', '444456','AVDA ALFARES 4, 8�A, MADRID','ESPA�A');
INSERT INTO pasajero VALUES (3,'CARLOS GIL', '568956','C/ALAMEDA 20, MADRID','ESPA�A');
INSERT INTO pasajero VALUES (4,'MARIA JIMENEZ', '990456','C/LA MONTERA 50, TALAVERA','ESPA�A');
INSERT INTO pasajero VALUES (5,'ROSARIO FORES', '123888','C/LA RIADA 3, ALCORC�N','ESPA�A');
INSERT INTO pasajero VALUES (6,'ALICIA RAMOS', '66688','C/LOS PINTORES 10, TALAVERA','ESPA�A');
INSERT INTO pasajero VALUES (7,'ANA FUENTES', '8903456','C/LA REINA 34, MADRID','FRANCIA');

INSERT INTO pasajero VALUES (8,'PETRA ALONSO', '222456','AVDA MADRID 32, 2�A, TALAVERA','FRANCIA');
INSERT INTO pasajero VALUES (9,'ANGEL GIL', '444026','AVDA ALFARES 14, 8�A, MADRID','FRANCIA');
INSERT INTO pasajero VALUES (10,'MARTIN PESACADOR', '238956','C/ALAMEDA 21, MADRID','FRANCIA');
INSERT INTO pasajero VALUES (11,'LUIS CABRERO', '130456','C/LA CAPA 50, TALAVERA','FRANCIA');
INSERT INTO pasajero VALUES (12,'JES�S GINER FORES', '23888','C/LA REJA 4, ALCORC�N','FRANCIA');
INSERT INTO pasajero VALUES (13,'CARMEN RAMI', '6668809','C/LOS SAUCES 10, TALAVERA','PORTUGAL');
INSERT INTO pasajero VALUES (14,'FELIME PRIMERO', '89803456','C/LA ROSA 3, MADRID','PORTUGAL');


INSERT INTO pasajero VALUES (15,'JUANJO P�REZ', '92522245','AVDA CACERES 32, 2�A, TALAVERA','PORTUGAL');
INSERT INTO pasajero VALUES (16,'PEDRO AL�A', '949944026','AVDA DANZANTES 14, 8�A, MADRID','PORTUGAL');
INSERT INTO pasajero VALUES (17,'SERGIO GRAC�A', '912238956','C/GINER DE LOS RIOS 21, LEGAN�S','PORTUGAL');
INSERT INTO pasajero VALUES (18,'MR�A CABRERO', '925130456','C/LA HERRADURA 30, TORRIJOS','PORTUGAL');
INSERT INTO pasajero VALUES (19,'OSCAR ALONSO', '918823888','C/LOS MOLINOS 3, ALCAL� DE HENARES','ALEMANIA');
INSERT INTO pasajero VALUES (20,'PILAR MART�N', '925666880','C/ALVARADO 30, TOLEDO','ESPA�A');
INSERT INTO pasajero VALUES (21,'ANG�LICA SEGUNDO', '918980345','C/LA ROSA 3, ALCAL� DE HENARES','ESPA�A');


INSERT INTO pasajero VALUES (22,'MIRIAM CAMACHO', '92544245','AVDA MADRID 32, 2�A, TALAVERA','ESPA�A');
INSERT INTO pasajero VALUES (23,'ROSA AL�A', '949870026','AVDA SANZ VAZQUEZ 2, 8�A, MADRID','ESPA�A');
INSERT INTO pasajero VALUES (24,'ALICIA GARC�A', '916738956','C/LIBREROS 23, LEGAN�S','ESPA�A');
INSERT INTO pasajero VALUES (25,'MARY CASTUERA', '925220400','C/LA MINA 5, TORRIJOS','ALEMANIA');
INSERT INTO pasajero VALUES (26,'SERGIO ALONSO', '91673888','C/LOS ALCORES 41, ALCAL� DE HENARES','ALEMANIA');
INSERT INTO pasajero VALUES (27,'RAQUEL RINC�N', '925316882','C/�VILA 13, TOLEDO','ALEMANIA');
INSERT INTO pasajero VALUES (28,'TITO VALVERDE', '916675544','C/LA FRUTA 33, ALCAL� DE HENARES','ALEMANIA');

/* - TABLA vuelo
--  identificador VARCHAR2 (10) ,    aeropuerto_origen ,  aeropuerto_destino ,  tipo_vuelo VARCHAR2 (15) 
-- identificador IBE- Iberia, BRU- bruselas airlines, RYA -Ryanair, 
-- VUE vueling, QAT qatar, DEL delta, KLM KLM, AVI Avianca

-- tipo_vuelo IN ('CHARTER', 'DIRECTO', 'DOM�STICO', 'LARGO RECORRIDO', 'LOW COST', 'REGULAR')

-- origen 'BRU	EBBR', 'Bruselas-Zaventem'
-- destinoS ('CPH	EKCH', 'Copenhague-Kastrup', 'Copenhague', 'Dinamarca');
-- ('MAD LEMD', 'Madrid-Barajas', 'Madrid', 'Espa�a')
-- ('PMI	LEPA', 'Son San Juan', 'Palma de Mallorca', 'Espa�a'); */

INSERT INTO vuelo VALUES ('BRU-1234','BRU EBBR','CPH EKCH','CHARTER',DATE_ADD(curdate(),interval 30 day), 5);
INSERT INTO vuelo VALUES ('BRU-2222','BRU EBBR','MAD LEMD','DIRECTO',DATE_ADD(curdate(),interval 6 day), 5);
INSERT INTO vuelo VALUES ('KLM-2343','BRU EBBR','PMI LEPA','DIRECTO',DATE_ADD(curdate(),interval 5 day), 10);


/*  origen ('MAD	LEMD', 'Madrid-Barajas', 'Madrid', 'Espa�a');
-- destinoS ('HEL EFHK', 'Helsinki-Vantaa', 'Helsinki', 'Finlandia');
-- ('GWY EICM', 'aeropuerto de Galway', 'Galway', 'Irlanda');
-- ('OSL ENGM', 'Oslo-Gardermoen', 'Olso', 'Noruega'); 'PRG	LKPR' PRAGA   */
INSERT INTO vuelo VALUES ('IBE-762','MAD LEMD','HEL EFHK','DOM�STICO',DATE_ADD(curdate(),interval 30 day),5);
INSERT INTO vuelo VALUES ('IBE-789','MAD LEMD','GWY EICM','DIRECTO',DATE_ADD(curdate(),interval 63 day), 10);
INSERT INTO vuelo VALUES ('AVI-ASD','MAD LEMD','OSL ENGM','LARGO RECORRIDO',DATE_ADD(curdate(),interval 31 day), 10);
INSERT INTO vuelo VALUES ('AVI-345','MAD LEMD','BRU EBBR','LARGO RECORRIDO',DATE_ADD(curdate(),interval 15 day), 5);
INSERT INTO vuelo VALUES ('DEL-456','MAD LEMD','PRG LKPR','LARGO RECORRIDO',DATE_ADD(curdate(),interval 70 day), 20);

/*  origen ('CPH	EKCH', 'Copenhague-Kastrup', 'Copenhague', 'Dinamarca');
-- destinoS  ('BRU	EBBR', 'Bruselas-Zaventem', 'Bruselas', 'B�lgica');
-- ('RL	EBCI', 'Bruselas-Charleroi', 'Bruselas', 'B�lgica');
-- ('PRG	LKPR', 'aeropuerto de Praga', 'Praga', 'Rep�blica Checa');
-- ('MAD	LEMD', 'Madrid-Barajas', 'Madrid', 'Espa�a');   */

INSERT INTO vuelo VALUES ('DEL-34', 'CPH EKCH', 'BRU EBBR','DOM�STICO',DATE_ADD(curdate(),interval 80 day), 10);
INSERT INTO vuelo VALUES ('KLM-332','CPH EKCH', 'HEL EFHK','DIRECTO',DATE_ADD(curdate(),interval 77 day), 5);
INSERT INTO vuelo VALUES ('IBE-212','CPH EKCH', 'RL  EBCI','CHARTER',DATE_ADD(curdate(),interval 32 day), 10);
INSERT INTO vuelo VALUES ('QAT-224','CPH EKCH', 'PRG LKPR','CHARTER',DATE_ADD(curdate(),interval 20 day), 20);
INSERT INTO vuelo VALUES ('KLM-78', 'CPH EKCH', 'MAD LEMD','DOM�STICO',DATE_ADD(curdate(),interval 66 day), 10);

/*  origen ('PMI	LEPA', 'Son San Juan', 'Palma de Mallorca', 'Espa�a');
-- destinoS  ('HEL	EFHK', 'Helsinki-Vantaa', 'Helsinki', 'Finlandia');
-- ('GWY	EICM', 'aeropuerto de Galway', 'Galway', 'Irlanda');
-- ('OSL	ENGM', 'Oslo-Gardermoen', 'Olso', 'Noruega');
--  ('MAD	LEMD', 'Madrid-Barajas', 'Madrid', 'Espa�a');   */
INSERT INTO vuelo VALUES ('IBE-234', 'PMI LEPA','HEL EFHK','DOM�STICO',DATE_ADD(curdate(),interval 40 day),5);
INSERT INTO vuelo VALUES ('RYA-22',  'PMI LEPA','GWY EICM','CHARTER',DATE_ADD(curdate(),interval 8 day), 5);
INSERT INTO vuelo VALUES ('RYA-230', 'PMI LEPA','OSL ENGM','CHARTER',DATE_ADD(curdate(),interval 25 day), 8);
INSERT INTO vuelo VALUES ('QAT-900', 'PMI LEPA','MAD LEMD','REGULAR',DATE_ADD(curdate(),interval 67 day),10);




/*  TABLA pasaje   pasajero_cod,    identificador VARCHAR2 (10) , numasiento NUMBER (5) ,
--  clase VARCHAR2 (10) ,  pvp NUMBER (6,2) , clase IN ('BUSINESS', 'PRIMERA', 'TURISTA')) 
-- HASTA 28 VIAJEROS
-- vuelo 'IBE-762'   */
	
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (1, 'IBE-762', 10, 'PRIMERA', 200);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (2, 'IBE-762', 11, 'PRIMERA', 200);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (3, 'IBE-762', 13, 'PRIMERA', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (4, 'IBE-762', 14, 'TURISTA', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (5, 'IBE-762', 16, 'TURISTA', 250);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (6, 'IBE-762', 25, 'TURISTA', 260);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (7, 'IBE-762', 27, 'BUSINESS', 280);

/*  vuelo 'BRU-1234' */
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (1, 'BRU-1234', 20, 'TURISTA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (2, 'BRU-1234', 21, 'PRIMERA', 190);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (3, 'BRU-1234', 23, 'PRIMERA', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (4, 'BRU-1234', 24, 'TURISTA', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (5, 'BRU-1234', 16, 'TURISTA', 250);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (6, 'BRU-1234', 25, 'TURISTA', 260);

/*  vuelo 'KLM-2343' */

INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (8, 'KLM-2343', 12, 'TURISTA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (9, 'KLM-2343', 13, 'PRIMERA', 190);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (10, 'KLM-2343', 14, 'PRIMERA', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (11, 'KLM-2343', 15,'TURISTA', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (12, 'KLM-2343', 36, 'TURISTA', 250);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (13, 'KLM-2343', 37, 'TURISTA', 260);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (14, 'KLM-2343', 38, 'BUSINESS', 250);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (15, 'KLM-2343', 39, 'BUSINESS', 260);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (16, 'KLM-2343', 40, 'BUSINESS', 270);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (17, 'KLM-2343', 41, 'BUSINESS', 260);

/*  vuelo 'IBE-789' */
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (18, 'IBE-789', 10, 'TURISTA', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (19, 'IBE-789', 13, 'PRIMERA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (20, 'IBE-789', 14, 'PRIMERA', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (21, 'IBE-789', 15,'TURISTA', 240);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (22, 'IBE-789', 46, 'TURISTA', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (23, 'IBE-789', 47, 'TURISTA', 270);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (24, 'IBE-789', 48, 'BUSINESS', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (25, 'IBE-789', 49, 'BUSINESS', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (26, 'IBE-789', 50, 'TURISTA', 220);

/*  vuelo 'AVI-ASD', */
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (15, 'AVI-ASD', 30, 'TURISTA', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (16, 'AVI-ASD', 33, 'PRIMERA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (17, 'AVI-ASD', 34, 'PRIMERA', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (18, 'AVI-ASD', 35,'TURISTA', 160);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (19, 'AVI-ASD', 36, 'TURISTA', 150);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (20, 'AVI-ASD', 37, 'TURISTA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (21, 'AVI-ASD', 58, 'BUSINESS', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (22, 'AVI-ASD', 59, 'BUSINESS', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (23, 'AVI-ASD', 40, 'TURISTA', 120);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (24, 'AVI-ASD', 68, 'BUSINESS', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (25, 'AVI-ASD', 69, 'BUSINESS', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (26, 'AVI-ASD', 41, 'TURISTA', 120);

/*  vuelo 'KLM-332', */
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (1, 'KLM-332', 20, 'PRIMERA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (2, 'KLM-332', 30, 'TURISTA', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (3, 'KLM-332', 33, 'PRIMERA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (10, 'KLM-332', 34, 'PRIMERA', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (11, 'KLM-332', 35,'TURISTA', 160);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (12, 'KLM-332', 36, 'TURISTA', 150);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (20, 'KLM-332', 37, 'TURISTA', 180);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (21, 'KLM-332', 58, 'BUSINESS', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (22, 'KLM-332', 59, 'BUSINESS', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (23, 'KLM-332', 40, 'TURISTA', 120);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (24, 'KLM-332', 68, 'BUSINESS', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (25, 'KLM-332', 69, 'BUSINESS', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (26, 'KLM-332', 41, 'TURISTA', 120);

/*  vuelo 'QAT-900' */
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )   VALUES (20, 'QAT-900', 10, 'TURISTA', 100);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (21, 'QAT-900', 20, 'BUSINESS', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (22,'QAT-900', 25, 'BUSINESS', 170);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (23, 'QAT-900', 40, 'TURISTA', 100);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (24, 'QAT-900', 30, 'BUSINESS', 220);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (25, 'QAT-900', 35, 'BUSINESS', 230);
INSERT INTO pasaje (pasajerocod, identificador, numasiento,clase , pvp )  VALUES (26, 'QAT-900', 41, 'PRIMERA', 120);

commit;

