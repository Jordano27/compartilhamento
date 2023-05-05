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
  `data` date NOT NULL,
  `propretario` varchar(200) NOT NULL,
  `caminho` varchar(200) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  CONSTRAINT `fk_documentos_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
);

INSERT INTO `usuarios` (`idUsuario`, `nome`, `email`, `senha`) VALUES
(1, 'Mateus', 'mateus@email.com', 'senha'),
(2, 'Jordano', 'jordano@email.com', 'outrasenha');

INSERT INTO `documentos` (`idDocumento`, `nome`, `data`, `propretario`, `caminho`, `idUsuario`) VALUES
(1, 'arquivo1', '2023-09-12', 'mateus', '...', 1),
(2, 'arquivo2', '2023-09-12', 'jordano', '....', 2);