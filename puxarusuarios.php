<?php

require('twig_carregar.php');

require('models/Model.php');
require('models/Usuario.php');
echo $twig->render('compartilhar.html');
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

// Consultar o banco de dados
$sql = $pdo->prepare('SELECT idUsuario, nome FROM usuarios');
$sql->execute();
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

// Executar a consulta e armazenar os dados em um array
$dados = array();
$sql->execute();
while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
  $dados[] = $linha;
}

// Exibir os dados em uma lista de opções
echo "<select name='usuario'>";
foreach ($dados as $dado) {
  echo "<option value='" . $dado['idUsuario'] . "'>" . $dado['nome'] . "</option>";
}
echo "</select>";

// Fechar a conexão
$pdo = null;

        //formulario
/*
<form method="POST" enctype="multipart/form-data">
	<label for="arquivo">Selecione um arquivo:</label>
	<input type="file" name="arquivo" id="arquivo" required>
	<input type="submit" value="Enviar">
</form>
*/

// Verificar se o formulário foi enviado
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK && $_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obter o ID do usuário selecionado e o arquivo enviado
  $idUsuario = filter_input(INPUT_POST, 'usuario', FILTER_VALIDATE_INT);
  $arquivo = $_FILES['arquivo'];

  // Verificar se um usuário foi selecionado e um arquivo foi enviado
  if (!empty($idUsuario) && !empty($arquivo)) {
    // Verificar se o usuário selecionado existe no banco de dados
    $usuario = Usuario::getById($idUsuario);
    if (!$usuario) {
      echo "Usuário não encontrado.";
      exit();
    }

    // Verificar se o arquivo pode ser enviado para o usuário
    if (podeEnviarArquivoParaUsuario($arquivo, $usuario)) {
      $caminhoDestino = "pasta_do_usuario/{$usuario['idUsuario']}/";
      if (!file_exists($caminhoDestino)) {
        mkdir($caminhoDestino, 0777, true);
      }
      $caminhoArquivo = $caminhoDestino . basename($arquivo['name']);
      move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo);
      echo "Arquivo enviado com sucesso para o usuário {$usuario['nome']}.";
    } else {
      echo "Não é possível enviar o arquivo para esse usuário.";
      exit();
    }
  }
}


   // Verificar se o arquivo pode ser enviado para o usuário
if (podeEnviarArquivoParaUsuario($arquivo, $usuario)) {
  $extensaoPermitida = array('docx', 'doc', 'pdf');
  $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
  return in_array($extensao, $extensaoPermitida);
} else {
  echo "Não é possível enviar o arquivo para esse usuário.";
  exit();
}

   
    $caminhoDestino = "pasta_do_usuario/{$usuario['idUsuario']}/";
    if (!file_exists($caminhoDestino)) {
      mkdir($caminhoDestino, 0777, true);
    }
    $caminhoArquivo = $caminhoDestino . basename($arquivo['name']);
    move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo);
    echo "Arquivo enviado com sucesso para o usuário {$usuario['nome']}.";
  




?>
