<?php

require "../classes/updateRequest.php";

session_start();
$_SESSION['iduser'];
$id= $_SESSION['iduser'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if($password1 !== $password2){
    ?>
    <!doctype html>
    <html lang="fr">
    <head>

        <!-- CSS Reset -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

        <!-- Milligram CSS minified -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.1.0/milligram.min.css">

        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="2, URL=premiereConnexion.php">
        <title>Cangement mot de passe.</title>
    </head>
    <body>

        <p>Les passwords sont differents!</p>

    </body>
    </html>
<?php
}
else {
        $password1 = crypt($_POST['password1'],'$2$a');
        $updatePassword = new UpdateRequest("apprenant", "password", $_SESSION['iduser'], $password1);
        $updatePassword->update();

        $updateInit = new UpdateRequest("apprenant", "init", $_SESSION['iduser'], 1);
        $updateInit->update();
        ?>
        <!doctype html>
        <html lang="fr">
        <head>
            <!-- CSS Reset -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

            <!-- Milligram CSS minified -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.1.0/milligram.min.css">

            <meta http-equiv="refresh" content="1, URL=../siteform.php">
            <meta charset="UTF-8">
            <title>Changement</title>
        </head>
        <body>

        <p>Votre changement a bien été pris en compte!</p>

        </body>
        </html>

        <?php
    }
?>