<?php
    require('verifica_login.php');
    require('twig_carregar.php');
    require('pdo.inc.php');
    require('models/Model.php');
    require('models/Usuario.php');

    $usr = new Usuario();
    $usuarios = $usr->get();

    // Obtém os valores dos filtros do formulário de busca
    $tipoArquivo = $_GET['tipo_arquivo'] ?? '';
    $dataInicio = $_GET['data_inicio'] ?? '';
    $dataFim = $_GET['data_fim'] ?? '';
    $nomeArquivo = $_GET['nome_arquivo'] ?? '';

    // Constrói a consulta SQL com base nos filtros
    $sql = "SELECT * FROM documentos WHERE propretario = '{$_SESSION['user']}'";


    if (!empty($tipoArquivo)) {
        $sql .= " AND tipo = :tipo";
    }

    if (!empty($dataInicio) && !empty($dataFim)) {
        $sql .= " AND data_upload BETWEEN :data_inicio AND :data_fim";
    }

    if (!empty($nomeArquivo)) {
        $sql .= " AND nome LIKE :nome";
    }

    // Prepara a consulta
    $stmt = $pdo->prepare($sql);

    // Define os valores dos parâmetros
    if (!empty($tipoArquivo)) {
        $stmt->bindValue(':tipo', $tipoArquivo);
    }

    if (!empty($dataInicio) && !empty($dataFim)) {
        $stmt->bindValue(':data_inicio', $dataInicio);
        $stmt->bindValue(':data_fim', $dataFim);
    }

    if (!empty($nomeArquivo)) {
        $stmt->bindValue(':nome', '%' . $nomeArquivo . '%');
    }

    // Executa a consulta
    $stmt->execute();

    // Obtém os resultados da consulta
    $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo $twig->render('usuarios.html', [
        'usuarios' => $usuarios,
        'documentos' => $documentos,
    ]);
?>