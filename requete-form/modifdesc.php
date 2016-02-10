<?php

session_start();
$iduser=$_SESSION["iduser"];
$desc=$_GET["desc"];



try {
  $connexion=new PDO('mysql:host=localhost;dbname=simplonsite;charset=utf8','root','root');
}
  catch (Exception $e){
die ('erreur : '.$e->getMessage());
}

       $requete="UPDATE `apprenant` SET `description`= '$desc' WHERE id=$iduser";
echo $requete;
       $reponses  = $connexion->query($requete);
       $reponses->closeCursor();



?>
