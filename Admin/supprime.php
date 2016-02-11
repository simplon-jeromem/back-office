<?php

if(isset($_GET['techno'])){
    
    $techno = htmlentities(trim($_GET['techno']));
    
        try
        {
            $connect = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
        }
            catch (Exception $e){
            die('Erreur : '.$e->getMessage());
        }  
            $request = $connect->prepare("DELETE FROM `techno` WHERE `techno`=:techno");
            $request->bindParam(":techno", $techno, PDO::PARAM_STR);
            $result = $request->execute();
            error_log($request);
            echo 'Result : '.$result;
        }else{
            echo 'Result : '.$result;
        }

?>