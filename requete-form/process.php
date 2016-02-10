<?php

session_start();
$idUser = $_SESSION['iduser'];
$niveau = $_GET['niveau'];
$techno = $_GET['techno'];

// echo $_SESSION['iduser'];

try
{
    $connect = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
}
catch (Exception $e){
    die('Erreur : '.$e->getMessage());
}

$request = "SELECT * FROM `techno` WHERE `techno`='$techno'";
$results = $connect->query($request);
$data = $results->fetch();
$idt = $data['id'];
echo $idt;
$select = "SELECT * FROM `competences` WHERE `ida`=$idUser AND `idt`=$idt";
$result = $connect->query($select);
$count = $result->rowCount();
if($count < 1){
    // if($niveau > 0){
        $request2 = "INSERT INTO `competences`(`ida`, `idt`, `niveau`) VALUES ($idUser,$idt,$niveau)";
        $results2 = $connect->exec($request2);
    // } else {
    //     $request2 = "DELETE FROM `competences` WHERE `ida`=$idUser AND `idt`=$idt";
    //     $result2 = $connect->exec($request2);
    // }
}else{
    // if($niveau > 0){
        $request2 = "UPDATE `competences` SET `niveau` = $niveau WHERE `idt` =$idt AND `ida`=$idUser";
        echo $request2;
        $result2 = $connect->exec($request2);
    // } else {
    //     $request2 = "DELETE FROM `competences` WHERE `ida`=$idUser AND `idt`=$idt";
    //     $result2 = $connect->exec($request2);
    // }
}
?>
