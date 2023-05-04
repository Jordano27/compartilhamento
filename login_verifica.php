<?php
    # login_verifica.php
    require('pdo.inc.php');

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Cria a consulta e aguarda os dados
    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE username = :usr AND ativo = 1');

    // Adiciona os dados na consulta
    $sql->bindParam(':usr', $user);

    // Roda a consulta
    $sql->execute();

    // Se encontrou o usuário
    if ($sql->rowCount()) {
        // Login feito com sucesso
        $user = $sql->fetch(PDO::FETCH_OBJ);

        // Verificar se a senha está correta
        if (!password_verify($pass, $user->senha)) {
            // Falha no login
            header('location:login.php?erro=1');
            die;
        }

        // Cria uma sessão para armazenar o usuário
        session_start();
        $_SESSION['user'] = $user->nome;
        
        // Redireciona o usuário
        header('location:boasvindas.php');
        die;
    } else {
        // Falha no login
        header('location:login.php?erro=1');
        die;
    }