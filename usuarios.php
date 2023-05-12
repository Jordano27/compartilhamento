<?php
    # /usuarios.php
    require('verifica_login.php');
    require('twig_carregar.php');
    
    require('models/Model.php');
    require('models/Usuario.php');

    if (isset($_POST["submit"])) {
        $str = $_POST["search"];
        $sth = $con->prepare("SELECT * FROM `usuario` WHERE name = '$str' and idcomuento session id");
    
        $sth->setFetchMode(PDO:: FETCH_OBJ);
        $sth -> execute();
    
        if($row = $sth->fetch())
        {
            ?>
            <br><br><br>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <td><?php echo $row->Name; ?></td>
                    <td><?php echo $row->Description;?></td>
                </tr>
    
            </table>
    <?php 

    $usr = new Usuario();
    $usuarios = $usr->get();
    $documentos = $usr->getdocumento();
    echo $twig->render('usuarios.html', [
        'usuarios' => $usuarios,
       'documentos' => $documentos,
    ]);
    