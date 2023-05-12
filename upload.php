
<?php
require('verifica_login.php');
require('twig_carregar.php');
require('pdo.inc.php');
require('func/sanitize_filename.php');

$localhost = "localhost"; #localhost
$dbusername = "root"; #username of phpmyadmin
$dbpassword = "";  #password of phpmyadmin
$dbname = "usuario";  #database name

#connection string
$pdo = mysqli_connect($localhost,$dbusername,$dbpassword,$dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (isset($_POST["submit"])) {
    #retrieve file title
    
    $title = $_POST["title"];
    $title = sanitize_filename($title);
    
    #file name with a random number so that similar dont get replaced
    $pname = $title . "-" . $_FILES["file"]["name"];
    
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
   
    #upload directory path
    $uploads_dir = 'arquivo';
    
    # check file extension
    $allowed_ext = array('doc', 'docx', 'pdf');
    $file_ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    
    if (!in_array($file_ext, $allowed_ext)) {
        echo "Only .doc, .docx and .pdf files are allowed";
        exit();
    }

    #TO move the uploaded file to specific location
    if (move_uploaded_file($tname, $uploads_dir.'/'.$pname)) {
        #sql query to insert into database
        $date = date('Y-m-d');
        $sql = "INSERT INTO documentos (nome, caminho, propretario, data_upload) VALUES ('$title', 'arquivo/$pname', '{$_SESSION['user']}', '$date')";
        
        if(mysqli_query($pdo,$sql)){
            sanitize_filename($title);
            echo "File Successfully uploaded";
        } else {
            echo "Error inserting data: " . mysqli_error($pdo);
        }
    } else {
        echo "Escolha um arquivo e use somente letras e numeros";
    }
}

echo $twig->render('upload.html');
?>

