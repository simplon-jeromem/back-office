<?php

require "../classes/updateRequest.php";
require "../classes/checkInsert.php";

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
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="2, URL=premiereConnexion.php">
        <title>Cangement mot de passe.</title>
    </head>
    <body>

        <h2>Les passwords sont differents!</h2>

    </body>
    </html>
<?php
}
else {
    $changePasswordCheck = new CheckInsert($password1);
    if ($changePasswordCheck->check() ===  0) {
        ?>
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="2, URL=../premiereConnexion.php">
            <title>Cangement mot de passe.</title>
        </head>
        <body>

        <h2>Veuillez entrer un password valide!</h2>

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
            <meta http-equiv="refresh" content="2, URL=../siteform.php">
            <meta charset="UTF-8">
            <title>Changement</title>
        </head>
        <body>

        <h2>Votre changement a bien été pris en compte!</h2>

        </body>
        </html>

        <?php

    }
}
?>