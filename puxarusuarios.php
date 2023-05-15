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

// Consultar o banco de dados para obter a lista de usuários
$sql = $pdo->prepare('SELECT idUsuario, nome from usuarios;');
$sql->execute();
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

// Obter o ID do usuário logado
$idUsuario = $_GET['id'];

// Verificar se o formulário foi enviado
if (isset($_POST['usuario']) && isset($_POST['idDocumento'])) {
  // Obter o usuário selecionado
  $idUsuarioDestino = $_POST['usuario'];

  // Obter o arquivo enviado
  $idDocumento = $_POST['idDocumento'];

  // Inserir o arquivo na tabela de compartilhamentos
  $sql = $pdo->prepare('INSERT INTO compartilhamentos (idUsuario, idDocumento) VALUES (?, ?)');
  $sql->execute([ $idUsuarioDestino, $idDocumento]);

  // Redirecionar para a página de compartilhamentos
  header('Location: arquivoscompartilhados.php');
  exit();
}

// Exibir o formulário
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<input type='hidden' name='idDocumento' value='1'>";
echo "<label>Selecione um usuário:</label>";
echo "<select name='usuario'>";
foreach ($usuarios as $usuario) {
  if ($usuario['idUsuario'] != $idUsuario) {
    echo "<option value='" . $usuario['idUsuario'] . "'>" . $usuario['nome'] . "</option>";
  }
}
echo "</select>";
echo "<br><br>";
echo "<input type='submit' value='Compartilhar'>";
echo "</form>";

// Fechar a conexão
$pdo = null;

?>
