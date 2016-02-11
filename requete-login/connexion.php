<?php

require "../classes/classCheckId.php";
require "../classes/redirection.php";

$login = $_POST['nom'];
$password = $_POST['password'];

if(isset($login) && isset($password)) {

        $connexionUser = new CheckId($login, $password);
        if ($connexionUser->checkId() === false) {
            echo $connexionUser->errorId;
        } else {
            session_start();
            $_SESSION['iduser'] = $connexionUser->checkId()['id'];
            if($connexionUser->checkId()['autorisation'] === "1"){
                $redirectionSadmin = new Redirection('../Admin/admin.php');
                $redirectionSadmin->redirect();
            }
            else{
                if ($connexionUser->checkId()['init'] === "1") {

                    $redirectionHome = new Redirection("../siteform.php");
                    $redirectionHome->redirect();

                } else {

                    $redirectionChangePW = new Redirection("../premiereConnexion.php");
                    $redirectionChangePW->redirect();

                }
            }
        }
    }
?>