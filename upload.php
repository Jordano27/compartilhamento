<?php
require('verifica_login.php');
require('twig_carregar.php');
require('pdo.inc.php');
require('func/sanitize_filename.php');

if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $title = sanitize_filename($title);
    
    $pname = $title . "-" . $_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = 'arquivo';
    $allowed_ext = array('doc', 'docx', 'pdf');
    $file_ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    
    if (!in_array($file_ext, $allowed_ext)) {
        echo "Only .doc, .docx and .pdf files are allowed";
        exit();
    }

    if (move_uploaded_file($tname, $uploads_dir.'/'.$pname)) {
        $date = date('Y-m-d');
        
        $stmt = $pdo->prepare("SELECT idUsuario FROM usuarios WHERE idUsuario = :user");
        $stmt->bindValue(':user', $_SESSION['user'], PDO::PARAM_INT);
        $stmt->execute();
        $userExists = $stmt->fetch();
        
        if ($userExists) {
            $sql = "INSERT INTO documentos (nome, caminho, propretario, data_upload, idUsurio) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, 'arquivo/'.$pname, $_SESSION['user'], $date, $_SESSION['id']]);
            
            echo "File Successfully uploaded";
        } else {
            echo "User does not exist";
        }
    } else {
        echo "Escolha um arquivo e use somente letras e numeros";
    }
}

echo $twig->render('upload.html');
?>
