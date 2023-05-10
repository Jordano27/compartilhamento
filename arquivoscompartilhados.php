<?php
require('verifica_login.php');
require('twig_carregar.php');

echo $twig->render('arquivoscompartilhados.html');