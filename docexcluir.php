<?php
require('pdo.inc.php');
require('twig_carregar.php');

$id = $_GET['id'] ?? false;
if ($id) {
    // Delete the related rows in the "compartilhamentos" table
    $deleteCompartilhamentos = $pdo->prepare('DELETE FROM compartilhamentos WHERE idDocumento = ?');
    $deleteCompartilhamentos->execute([$id]);

    // Delete the row from the "documentos" table
    $deleteDocumentos = $pdo->prepare('DELETE FROM documentos WHERE idDocumento = ?');
    $deleteDocumentos->execute([$id]);

    // Check if the deletion was successful, display an error message if necessary
    header('location:usuarios.php');
}

echo $twig->render('docexcluir.html', ['idDocumento' => $id]);