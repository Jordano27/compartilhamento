DROP DATABASE IF EXISTS usuario;
CREATE DATABASE usuario;
USE usuario;

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `recuperar_token` varchar(255) DEFAULT NULL
);

CREATE TABLE `documentos` (
  `idDocumento` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `data_upload` date NOT NULL, 
  `caminho` varchar(200) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
);

CREATE TABLE `compartilhamentos` (
  `idCompartilhamento` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idDocumento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  FOREIGN KEY (idDocumento) REFERENCES documentos(idDocumento),
  FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
);


/*banco velho caso precise, senâo exclui*/


/*DROP database IF EXISTS usuario;
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
 `data_upload` date('d/m/Y') NOT NULL, 
  `propretario` varchar(200) NOT NULL,
  `caminho` varchar(200) NOT NULL,
  `idUsuario` int not null 
  
);

 create table compartilhamentos( 
  idCompartilhamento int not null PRIMARY KEY AUTO_INCREMENT, 
  idDocumento int not null, 
  idUsuario int not null);

ALTER TABLE compartilhamentos ADD FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario);
ALTER TABLE compartilhamentos ADD FOREIGN KEY (idDocumento) REFERENCES documentos(idDocumento);
ALTER TABLE documentos ADD FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario);*/