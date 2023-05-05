DROP database IF EXISTS usuario;
create database usuario;
use usuario;

CREATE TABLE `documentos` (
  `idDocumento` int(11) NOT NULL PRIMARY key AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `data` date NOT NULL,
  `propretario` varchar(200) NOT NULL,
  `caminho` varchar(200) NOT NULL
);

INSERT INTO `documentos` (`idDocumento`, `nome`,`data`, `propretario`,`caminho`) VALUES
(1, 'arquivo1', '2023-09-12', 'mateus','...'),
(2, 'arquivo2', '2023-09-12', 'jordano','....');

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `idDocumento` int(11) NOT NULL,
  CONSTRAINT `fk_usuarios_documentos` FOREIGN KEY (`idDocumento`) REFERENCES `documentos` (`idDocumento`)
);

INSERT INTO `usuarios` (`idUsuario`, `nome`,`email`, `senha`, `idDocumento`) VALUES
(1, 'Mateus', 'mateus@email.com', 'senha', 1),
(2, 'Jordano', 'jordano@email.com', 'outrasenha', 3)