<?php 
 try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=simplonsite;charset=utf8', 'root', 'passe');

    } catch ( Exception $e ){
        die('Erreur : '.$e->getMessage() );
    }
$eleves=[];
$requete="SELECT * FROM  `lien` INNER JOIN apprenant ON apprenant.id = lien.id";
$resultats = $bdd->query($requete);
 while( $users = $resultats->fetch()){
     $tableau=[
         "nom"=>$users["nom"],
         "prenom"=>$users["prenom"],
         "gif"=>$users["gif"],
         "gif2"=>$users["photo"],
         "photoMin"=>$users["photoMin"],
         "presentation"=>$users["description"],
         "twitter"=>$users["twitter"],
         "linkedin"=>$users["linked"],
         "codepen"=>$users["codepen"],
         "portefolio"=>$users["siteperso"],
         "email"=>$users["mail"],
         "cv"=>$users["cv"],
        "competences"=>[]
     ];
     $id=$users["id"];
     $id=$bdd->quote($id);
     $requete2="SELECT*FROM  `techno` INNER JOIN competences ON techno.id = competences.idt WHERE ida=$id ORDER BY niveau";
     $resultats2 = $bdd->query($requete2);
     while($profil = $resultats2->fetch()){
        $competences=[
        "nom"=>$profil["techno"],
        "niveau"=>$profil["niveau"]
        ];
        array_push($tableau["competences"],$competences);
     
     };
     
     
     array_push($eleves,$tableau);
 }; 
echo json_encode($eleves);
?>


