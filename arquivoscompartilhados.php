<?php

session_start();

$localhost = "localhost";
$dbname = "usuario";
$dbusername = "root";
$dbpassword = "";

// Conectar ao banco de dados
$pdo = new PDO("mysql:host=$localhost;dbname=$dbname", $dbusername, $dbpassword);

// Verificar a conexão
if (!$pdo) {
  echo "Falha ao conectar ao MySQL";
  exit();
}

// Obter o ID do usuário logado
$idUsuario = $_SESSION['idUsuario'];

// Consultar o banco de dados para obter a lista de arquivos compartilhados
$sql = $pdo->prepare('SELECT c.idCompartilhamento, d.nome AS nomeArquivo, u.nome AS nomeUsuario
FROM compartilhamentos c
INNER JOIN usuarios u
ON c.idUsuario = u.idUsuario
INNER JOIN documentos d
ON c.idDocumento = d.idDocumento
WHERE c.idUsuario = ?
ORDER BY c.idCompartilhamento DESC');
$sql->execute([$idUsuario]);
$compartilhamentos = $sql->fetchAll(PDO::FETCH_ASSOC);

// Exibir a lista de arquivos compartilhados
echo "<h1>Arquivos compartilhados comigo:</h1>";
echo "<ul>";
foreach ($compartilhamentos as $compartilhamento) {
echo "<li><a href='arquivos/" . $compartilhamento['nomeArquivo'] . "' download>" . $compartilhamento['nomeArquivo'] . "</a> (Compartilhado por: " . $compartilhamento['nomeUsuario'] . ")</li>";
}
echo "</ul>";

// Fechar a conexão
$pdo = null;

?>
