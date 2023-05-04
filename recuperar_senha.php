<?php
    # recuperar_senha.php
    require('twig_carregar.php');
    require('pdo.inc.php');
    require('mailer.inc.php');

    // Mensagem de erro
    $msg = '';

    // Rotina de POST - Recuperar senha
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'] ?? false;

        $sql = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
        $sql->execute([$username]);

        // Se encontrou usuário....
        if ($sql->rowCount()) {
            // Aqui fica rotina de recuperar senha
            // Pega o ID do usuário
            $usuario = $sql->fetch(PDO::FETCH_ASSOC);
            // Gera um token aleatório
            $token = uniqid(null, true) . bin2hex(random_bytes(16));
            
            // Grava o token para o usuário no banco
            $sql = $pdo->prepare('UPDATE usuarios SET recupera_token = :token WHERE id = :id_usr');
          
            $sql->execute([
                ':token' => $token,
                ':id_usr' => $usuario['id'],
            ]);
            $msg = 'Vai lá olhar o teu e-mail';
            
            // Finge que mandou o e-mail
            echo $twig->render('email_recupera_senha.html', [
                'token' => $token
            ]);
            die;

        } else {
            $msg = 'Usuário não encontrado. Tu bebeu?';
        }
    }

    echo $twig->render('recuperar_senha.html', [
        'msg' => $msg,
    ]);