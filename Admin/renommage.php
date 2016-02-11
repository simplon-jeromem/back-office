<?php

if(isset($_GET['techno'])&&isset($_GET['renom'])){
    
    $techno = htmlentities(trim($_GET['techno']));
    $renom = htmlentities(trim($_GET['renom']));
    
            try
        {
            $connect = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
        }
            catch (Exception $e){
            die('Erreur : '.$e->getMessage());
        }        
            $request = $connect->prepare("UPDATE  `simplonsite`.`techno` SET `techno` =  :renom WHERE  `techno`.`techno`=:techno");
            $request->bindParam(':renom', $renom, PDO::PARAM_STR);
            $request->bindParam(':techno', $techno, PDO::PARAM_STR);
            $result = $request->execute();
            error_log($request);
            echo 'Result : '.$result;
        }else{
            echo 'Result : '.$result;
        }
?>