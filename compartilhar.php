<?php

    require('verifica_login.php');
    require('twig_carregar.php');
    
    require('models/Model.php');
    require('models/Usuario.php');

    $usr = new Usuario();
    $usuarios = $usr->get();
    $documentos = $usr->getdocumento();
    echo $twig->render('compartilhar.html', [
        'usuarios' => $usuarios,
       'documentos' => $documentos,
    ]);
    