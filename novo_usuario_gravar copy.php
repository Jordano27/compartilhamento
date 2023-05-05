<?php
    # novo_usuario_gravar.php
    require('models/Model.php');
    require('models/Usuario.php');

    $user = $_POST['user'] ?? false;
    $pass = $_POST['pass'] ?? false;
   

    if (!$user || !$pass) {
        header('location:novo_usuario.php');
        die;
    }

    $pass = password_hash($pass, PASSWORD_BCRYPT);

    $sql = $pdo->prepare('INSERT INTO usuarios (username, senha, ativo) VALUES (:user, :pass, 1)');

    $sql->bindParam(':user', $user);
    $sql->bindParam(':pass', $pass);
   

    $sql->execute();

    header('location:usuarios.php');



