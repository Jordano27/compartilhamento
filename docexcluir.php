<?php
require('pdo.inc.php');
require('twig_carregar.php');

$id = $_GET['id'] ?? false;
if ($id) {
    $sql = $pdo->prepare('DELETE FROM documentos WHERE idDocumento = ?');
    $sql->execute([$id]);
    // Check if the deletion was successful, display an error message if necessary
    header('location:usuarios.php');
}

echo $twig->render('docexcluir.html', ['idDocumento' => $id]);