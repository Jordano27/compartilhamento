
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
$sql = $pdo->prepare('SELECT idUsuario, nome FROM usuarios;');
$sql->execute();
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

// Consultar o banco de dados para obter a lista de documentos
$sql = $pdo->prepare('SELECT idDocumento, nome FROM documentos;');
$sql->execute();
$documentos = $sql->fetchAll(PDO::FETCH_ASSOC);

// Obter o ID do usuário logado
$idUsuario = $_GET['id'];

// Verificar se o formulário foi enviado
if (isset($_POST['usuario']) && isset($_POST['idDocumento'])) {
  // Obter o usuário selecionado
  $idUsuarioDestino = $_POST['usuario'];

  // Obter o documento selecionado
  $idDocumento = $_POST['idDocumento'];

  // Verificar se o documento existe
  $documentoExists = false;
  foreach ($documentos as $documento) {
    if ($documento['idDocumento'] == $idDocumento) {
      $documentoExists = true;
      break;
    }
  }

  if ($documentoExists) {
    // Inserir o documento na tabela de compartilhamentos
    $sql = $pdo->prepare('INSERT INTO compartilhamentos (idUsuario, idDocumento) VALUES (?, ?)');
    $sql->execute([$idUsuarioDestino, $idDocumento]);

    // Redirecionar para a página de compartilhamentos
    header('Location: arquivoscompartilhados.php');
    exit();
  } else {
    echo "Documento inválido. Por favor, selecione um documento válido.";
  }
}

// Exibir o formulário
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<label>Selecione um documento:</label>";
echo "<select name='idDocumento'>";
foreach ($documentos as $documento) {
  echo "<option value='" . $documento['idDocumento'] . "'>" . $documento['nome'] . "</option>";
}
echo "</select>";
echo "<br><br>";
echo "<label>Selecione um usuário:</label>";
echo "<select name='usuario' >";
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
