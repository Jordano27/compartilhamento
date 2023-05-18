<?php

require('verifica_login.php');
require('twig_carregar.php');
require('pdo.inc.php');
require('models/Model.php');
require('models/Usuario.php');

$comp = new Usuario();
$compartilha = $comp->getcompartilha();

echo $twig->render('arquivoscompartilhados.html');

// Verificar a conexão
if (!$pdo) {
  echo "Falha ao conectar ao MySQL";
  exit();
}

// Obter o ID do usuário logado
$idUsuario = $_SESSION['id'];

// Consultar o banco de dados para obter a lista de arquivos compartilhados
$sql = $pdo->prepare('SELECT c.idCompartilhamento, d.caminho as caminhoArquivo, d.nome AS nomeArquivo, u.nome AS nomeUsuario
FROM compartilhamentos c
INNER JOIN documentos d ON c.idDocumento = d.idDocumento
INNER JOIN usuarios u ON d.idUsuario = u.idUsuario
WHERE c.idUsuario = ? AND d.caminho = c.caminhio  
ORDER BY c.idCompartilhamento DESC');
$sql->execute([$idUsuario]);
$compartilhamentos = $sql->fetchAll(PDO::FETCH_ASSOC);
// Exibir a lista de arquivos compartilhados


foreach ($compartilhamentos as $compartilhamento) {
  $caminhoArquivo = $compartilhamento['caminhoArquivo'];
  $nomeArquivo = $compartilhamento['nomeArquivo'];
  $nomeUsuario = $compartilhamento['nomeUsuario'];
  echo "<li><a href='$caminhoArquivo' download>$nomeArquivo</a> (Compartilhado por: $nomeUsuario)</li>";
}


// Fechar a conexão
$pdo = null;
