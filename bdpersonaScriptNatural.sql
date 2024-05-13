#Validamos - Ing. Willian Zamalloa Paro
drop database  if  exists bdpersona1 ;
#Creamos la BD
create database bdpersona1;
#Usamos la BD Adecuada
use bdpersona1;
#Validamos
drop table if  exists tpersona;
#Creamos la tabla
CREATE TABLE tpersona (
  codpersona varchar(4) NOT NULL default '',
  nombres varchar(50) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  PRIMARY KEY  (codpersona)
) ENGINE=InnoDB;
#Insertamos la data
INSERT INTO  tpersona values('P001','WILLIAN ZAMALLOA PARO', 'willian@isc.com'),
('P002','MARIO ZAMALLOA VELASCO', 'mario@isc.com'),
('P003','MARGOT MENDOZA PARO', 'margot@isc.com');

#CONSULTAMOS
select * from tpersona;


