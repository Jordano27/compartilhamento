<?php
    # novo_usuario_gravar.php
    require('models/Model.php');
    require('models/Usuario.php');

    $nome = $_POST['nome'] ?? false;
    $email = $_POST['email'] ?? false;
    $senha = $_POST['senha'] ?? false;

    
    if (!$nome || !$email || !$senha) {
        header('location:novo_usuario.php');
        die;
    }

    $senha = password_hash($senha, PASSWORD_BCRYPT);

    $usr = new Usuario();
    $usr->create([
        'nome' => $nome,
        'email' => $email,
        'senha' => $senha,
       
    ]);

    header('location:login.php');



