<?php

class CheckId
{
    public $login;
    public $password;
    public $errorId = "Mauvais login ou password!";

    public function __construct($login,$password)
    {
        $password = crypt($_POST['password'],'$2$a');
        $this->login = $login;
        $this->password = $password;
    }

    public function checkId()
    {
        try {
            $connexion = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
        } catch (Exeption $e) {
            die ('Erreur : ' . $e->getMessage());
        }

        $requete = "SELECT * FROM `apprenant` WHERE `nom`='$this->login' AND `password`='$this->password'";
        $result = $connexion->query($requete);
        $resultFinal = $result->fetch();
        return $resultFinal;
    }
}

?>
