DROP database IF EXISTS usuario;
create database usuario;
use usuario;

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `recuperar_token` varchar(255) DEFAULT NULL
);

CREATE TABLE `documentos` (
 `idDocumento` int(11) NOT NULL PRIMARY key AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
 
  `propretario` varchar(200) NOT NULL,
  `caminho` varchar(200) NOT NULL 
  
);

 create table compartilhamentos( 
  idCompartilhamento int not null PRIMARY KEY AUTO_INCREMENT, 
  idDocumento int not null, 
  idUsuario int not null );


