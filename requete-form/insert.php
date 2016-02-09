<?php
$newTech = $_GET['name'];

try
{
    $connect = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
}
catch (Exception $e){
    die('Erreur : '.$e->getMessage());
}
$request = "INSERT INTO `techno`(`id`, `techno`) VALUES ('', '$newTech')";
$result = $connect->exec($request);

?>
