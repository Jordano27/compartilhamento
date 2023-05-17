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
  `propretario` varchar(200) NOT NULL,
  `data_upload` date NOT NULL, 
  `caminho` varchar(200) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
);

CREATE TABLE `compartilhamentos` (
  `idCompartilhamento` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idDocumento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  FOREIGN KEY (idDocumento) REFERENCES documentos(idDocumento),
  FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
);




/*banco velho caso precise, senâo exclui
<?php
require('verifica_login.php');
require('twig_carregar.php');
require('pdo.inc.php');
require('func/sanitize_filename.php');

if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $title = sanitize_filename($title);
    
    $pname = $title . "-" . $_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = 'arquivo';
    $allowed_ext = array('doc', 'docx', 'pdf');
    $file_ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    
    if (!in_array($file_ext, $allowed_ext)) {
        echo "Only .doc, .docx and .pdf files are allowed";
        exit();
    }

    if (move_uploaded_file($tname, $uploads_dir.'/'.$pname)) {
        $date = date('Y-m-d');
        
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idUsuario = '{$_SESSION['id']}'");
        
        $stmt->execute();
        $userExists = $stmt->fetch();
        
        if ($userExists) {
            $sql = "INSERT INTO documentos (nome, caminho, propretario, data_upload, idUsurio) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, 'arquivo/'.$pname, $_SESSION['user'], $date, $_SESSION['id']]);
            
            echo "File Successfully uploaded";
        } else {
            echo "User does not exist";
        }
    } else {
        echo "Escolha um arquivo e use somente letras e numeros";
    }
}
echo($_SESSION['user']);
echo $twig->render('upload.html');
?>

*/


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