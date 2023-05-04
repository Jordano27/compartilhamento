<?php
# recuperar_senha_escolher.php
require('twig_carregar.php');
require('pdo.inc.php');

$token = $_GET['token'] ?? $_POST['token'] ?? false;

if (!$token) {
    header('location:login.php');
    die;
}

// Rotina de POST - Recuperar senha
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['senha'] ?? false;
    $password_confi = $_POST['senha_confirma'] ?? false;

    $password = trim($password);
    $password_confi = trim($password_confi);
    // Tratamento para o caso de senha falsa
    // ....
    if ($password == $password_confi) {
        $sql = $pdo->prepare('UPDATE usuarios SET senha = :senha, recupera_token = NULL WHERE recupera_token = :token');
        $sql->execute([
            ':senha' => password_hash($password, PASSWORD_BCRYPT),
            ':token' => $token,
        ]);
        header('location:login.php?erro=3');
        die;
    }

    $msg = 'Conseguiu errar a senha, né?';

}

$sql = $pdo->prepare('SELECT * FROM usuarios WHERE recupera_token = ?');
$sql->execute([$token]);

if ($sql->rowCount() == 1) {
    echo $twig->render('recuperar_senha_escolher.html', ['token' => $token, 'msg' => $msg ?? false]);
} else {
    header('location:login.php');
    die;
}