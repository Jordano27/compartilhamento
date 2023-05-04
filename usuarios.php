<?php
    # /usuarios.php
    require('verifica_login.php');
    require('twig_carregar.php');
    
    require('models/Model.php');
    require('models/Usuario.php');

    $usr = new Usuario();
    $usuarios = $usr->getAll(['ativo' => 1]);

    echo $twig->render('usuarios.html', [
        'usuarios' => $usuarios,
    ]);