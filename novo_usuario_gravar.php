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

    $usr = new Usuario();
    $usr->create([
        'username' => $user,
        'senha' => $pass,
        'admin' => $admin,
        'ativo' => 1,
    ]);

    header('location:usuarios.php');



