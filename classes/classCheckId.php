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

        $stmt = $connexion->prepare("SELECT * FROM `apprenant`  LEFT JOIN `lien` ON apprenant.id = lien.id WHERE lien.`mail`=:login AND apprenant.`password`=:password");
        $stmt->bindParam(':login',$this->login, PDO::PARAM_STR);
        $stmt->bindParam(':password',$this->password, PDO::PARAM_STR);
        $stmt->execute();
        $resultFinal = $stmt->fetch();
        return $resultFinal;

    }
}

?>
