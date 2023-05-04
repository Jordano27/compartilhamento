<?php
    # produtos.php
    require('vendor/autoload.php');
    
     require('verifica_login.php');
     require('twig_carregar.php');
     
     require('models/Model_produto.php');
     require('models/Produto.php');
 
     $prod = new Produto();
     $produtos = $prod->getAll(['ativo' => 1]);
 
     echo $twig->render('produtos.html', [
         'produtos' => $produtos,
     ]);
