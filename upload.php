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
        $title =   sanitize_filename($title);
        #file name with a random number so that similar dont get replaced
        $pname =  $title."-".$_FILES["file"]["name"];
     
        #temporary file name to store file
        $tname = $_FILES["file"]["tmp_name"];
       
        #upload directory path
        $uploads_dir = 'arquivo';

        #TO move the uploaded file to specific location
        if (move_uploaded_file($tname, $uploads_dir.'/'.$pname)) {
            #sql query to insert into database
            $sql = "INSERT into documentos(nome,caminho,propretario,idusuario) VALUES('$title','arquivo/$pname', '{$_SESSION['user']}', '{$_SESSION['id']}')";
     
            if(mysqli_query($pdo,$sql)){
                sanitize_filename($title);
                echo "File Successfully uploaded";
            }
            else{
                echo "Error inserting data: " . mysqli_error($pdo);
            }
        } else {
            echo "Escolha um arquivo e use somente letras e numeros";
        }
    }
    echo $twig->render('upload.html')
    ;

    /* {% include "inc/head.html" %}

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
 


<div class="col-md-6 offset-md-3 mt-5">
    <a target="_blank" >
       <img src=''>
     </a>
     <br>
    

     <form accept-charset="UTF-8"  method="POST" enctype="multipart/form-data" >
       <div class="form-group">
         <label for="exampleInputName">Nome</label>
         <input type="text" name="title" class="form-control" placeholder="nome do arquivo" required="required">
       </div>
       
       <div class="form-group mt-3">
         <label class="mr-2">upload seu arquivo</label>
         <input type="file" name="file">
       </div>
       <hr>
       <button type="submit" class="btn btn-primary">Submit</button>
     </form>
 </div> 
</form>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
 
<form method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title">
    <label>File Upload</label>
    <input type="File" name="file">
    <input type="submit" name="submit">
 
 
</form>
<a href="usuarios.php" class="btn btn-outline-info"> ➕ documentos</a>
</body>
</html>
*/
?>

