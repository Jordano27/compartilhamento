<?php
    # usuario_atualizar.php
    require('models/Model.php');
    require('models/Usuario.php');

    $id = $_POST['id'] ?? false;
    $nome = $_POST['nome'] ?? false;
    $preco = $_POST['preco'] ?? false;
    

    if (!$id || !$nome || !$preco ) {
        // Não mostra erro na tela
        // O usuário que aprenda a preencher os campos
        die;
    }

    $prod = new Produto();
    $prod->update([
        'nome' => $nome,
        'preco' => $preco,
        
    ], $id);
    header('location:produtos.php');
    die;