<?php
    # novo_usuario_gravar.php
    require('models/Model.php');
    require('models/Usuario.php');

    $user = $_POST['user'] ?? false;
    $pass = $_POST['pass'] ?? false;
    $admin = isset($_POST['admin']);

    if (!$user || !$pass) {
        header('location:novo_usuario.php');
        die;
    }

    $pass = password_hash($pass, PASSWORD_BCRYPT);

    $sql = $pdo->prepare('INSERT INTO usuarios (username, senha, admin, ativo) VALUES (:user, :pass, :admin, 1)');

    $sql->bindParam(':user', $user);
    $sql->bindParam(':pass', $pass);
    $sql->bindParam(':admin', $admin);

    $sql->execute();

    header('location:usuarios.php');



