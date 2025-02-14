drop database if exists tareas;
create database tareas;
use tareas;

create table usuarios(
correo varchar(100) primary key,
contrasena varchar(50)
);

create table tarea(
idtarea int primary key auto_increment,
correo varchar (100),
nombretarea varchar (100),
descripcion varchar (500),
estado enum ('completada','en proceso'),
foreign key (correo) references usuarios(correo)
);

insert into usuarios (correo,contrasena) values(
'pepe@gmail.com','campusfp');
select * from usuarios where correo ='pepe@gmail.com' and contrasena='campusfp';