<?php
require 'verifica_login.php';
require 'twig_carregar.php';
require 'pdo.inc.php';
require 'func/sanitize_filename.php';

if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $title = sanitize_filename($title);

    $pname = $title . "-" . $_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = 'arquivo';
    $allowed_ext = array('doc', 'docx', 'pdf');
    $file_ext = strtolower(pathinfo($pname, PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_ext)) {
        echo "Only .doc, .docx, and .pdf files are allowed";
        exit();
    }

    if (move_uploaded_file($tname, $uploads_dir . '/' . $pname)) {
        $date = date('Y-m-d');

        if (isset($_SESSION['idUsuario'])) {
            $stmt = $pdo->prepare("SELECT idUsuario FROM usuarios WHERE idUsuario = :user");
            $stmt->bindValue(':user', $_SESSION['idUsuario'], PDO::PARAM_INT);
            $stmt->execute();
            $userExists = $stmt->fetch();

            if ($userExists && $userExists['idUsuario']) {
                $sql = "INSERT INTO documentos (nome, caminho, data_upload, idUsuario) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, 'arquivo/' . $pname, $date, $_SESSION['idUsuario']]);

                echo "File successfully uploaded";
            } else {
                echo "User does not exist";
            }
        } else {
            echo "User session not found";
        }
    } else {
        echo "Escolha um arquivo e use somente letras e números";
    }
}

echo $twig->render('upload.html');
?>
