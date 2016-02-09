<?php

session_start();
$iduser=$_SESSION["iduser"];
$git=$_GET["git"];
$linked=$_GET["linked"];
$codepen=$_GET["codepen"];
$twitter=$_GET["twitter"];
$siteperso=$_GET["siteperso"];


try {
  $connexion=new PDO('mysql:host=localhost;dbname=simplonsite;charset=utf8','root','root');
}
  catch (Exception $e){
die ('erreur : '.$e->getMessage());
}

       $requete="UPDATE `lien` SET `git`= '$git',`linked`= '$linked',`codepen`= '$codepen',
`twitter`= '$twitter',`siteperso`='$siteperso' WHERE id=$iduser";
echo $requete;
       $reponses  = $connexion->query($requete);
       $reponses->closeCursor();



?>
