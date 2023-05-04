<?php
    # senha/gerar_senha.php
    $pass = $_POST['pass'] ?? false;

    if ($pass) {
        /**
         * Nunca faça isso
         */
        // echo md5($pass);
        // echo sha1($pass);

        /**
         * Faça isso
         */
        echo password_hash($pass, PASSWORD_BCRYPT, [
            'cost' => 12,
        ]);
    }
?>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">

    <input type="password" name="pass">
    <br>
    <input type="submit" value="Criptografar">

</form>