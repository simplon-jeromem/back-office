<!DOCTYPE html>
<html>
<head>
  <title>Super_Admin's_page</title>
  <meta charset='utf-8'/>
  <style>
  *{
    margin: 0;
    padding: 0;
    /*border: 1px dashed red;*/
  }
  .apprenant{
    display: inline-block;
    cursor: pointer;
  }
  div{
    margin: 5%;
  }
  .div{
    align-items: flex-start;
    border: 1px solid black;
    display: none;
  }
  input{
    border: none;
    color: red;
    background: inherit;
    margin : 0.8%;
    font-size: 1em;
    cursor: pointer;
  }
      .butt {
          display: inline-block;
      }
      .techno {
          display: inline-block;
      }
      .renommage{
          display: none;
      }
      .reTech{
          border: 1px solid black;
          cursor: text;
          display: inline-block;
      }
      .validReq{
          display: inline-block;
      }
  </style>
</head>
<body>

  <h1>Hello Super Admin :  <?php echo $_SESSION['name'] ?></h1>
  <section>
    <h2>Apprenants : </h2>
  <ul>
    <?php
    try
    {
      $connect = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'Simplon69');
    }
    catch (Exception $e){
      die('Erreur : '.$e->getMessage());
    }
    $request = $connect->prepare("SELECT * FROM `apprenant`");
    $request->execute();
    $i = -1;
    while($app = $request->fetch(PDO::FETCH_ASSOC)){
      $appId = $app['id'];
      $request2 = $connect->prepare("SELECT * FROM `lien` WHERE id=:appId");
      $request2->bindParam(':appId', $appId, PDO::PARAM_INT);
      $request2->execute();
      $lien = $request2->fetch();
      $i++;
        if($lien == 0){
            echo 'ERROR';
        }
      ?>
      <li><p class='apprenant' onclick='affiche(<?php echo $i ?>)'><?php echo $app['nom'] ?> <span><?php echo $app['prenom'] ?></span></p>
        <div class='div'>
          <input type='button' onclick='cache(<?php echo $i ?>)' value='x'>
          <div class='infos'>
            <p>Tel : <?php echo $lien['tel'] ?></p>
            <p>Mail : <?php echo $lien['mail'] ?></p>
            <p>Description : <?php echo $app['description'] ?></p>
          </div>
          <div class='reseaux'>
            <p>Git : <?php echo $lien['git'] ?></p>
            <p>Code Pen : <?php echo $lien['codepen'] ?></p>
            <p>Linkedin : <?php echo $lien['linked'] ?></p>
            <p>Twitter : <?php echo $lien['twitter']?></p>
            <p>Site : <?php echo $lien['siteperso']?></p>
          </div>
          <div class='technos'>
            <?php
              $reqTech = "SELECT * FROM `techno`";
              $resTech = $connect->query($reqTech);
              while($tech = $resTech->fetch()){
                $techId = $tech['id'];
              $reqComp = "SELECT * FROM `competences` WHERE idt=$techId AND ida=$appId";
              $resComp = $connect->query($reqComp);
              $comp = $resComp ->fetch();
            ?>
              <ul>
                <li><?php echo $tech['techno'] ?> : <?php echo $comp['niveau'] ?>/5</li>
              </ul>
            <?php } ?>
          </div>
        </div>
      </li>
      <?php } ?>
    </ul>
  </section>
</br>

  <section>
    <h2>Technologies : </h2>
    <ul>
      <?php
      $reqTech = "SELECT * FROM `techno`";
      $resTech = $connect->query($reqTech);
      $i = -1;
      while($tech = $resTech->fetch()){
          $i++;
       ?>
        <li>
            <p class='techno'><?php echo $tech['techno'] ?></p>
            <input class='butt' onclick='supprime(<?php echo $i ?>)' type='button' value='x'>
            <input type='button' class='renom' onclick='afficheInput(<?php echo $i ?>)' value='Renommer'>
            <div class='renommage'>
                <input type='text' class='reTech'/>
                <input type='button' class='validReq' onclick='renomme(<?php echo $i ?>)' value='valider'/>
            </div>
        </li>
      <?php } ?>
    </ul>

  </section>
    <script>

    var request = new XMLHttpRequest;

    var traiteResultat = function(){
        var data = this.responseText;
        console.log(data);
    }

    var div = document.getElementsByClassName('div');

    // Fonction qui gere l'affichage du contenu des listes d'apprenant;
        
    var affiche = function(i){
        
      for(var j = 0; j<div.length; j++){
        div[j].style.display = 'none';
      }
      div[i].style.display = 'flex';
    }

    var cache = function(i){
      div[i].style.display = 'none';
    }
    
    var techno;
        
    //Fonction qui permet de supprimer une techno Affichage/Requete;
        
    var supprime = function(i){
        
        techno = document.getElementsByClassName('techno');
        console.log(techno);
        request.onload = traiteResultat;
        var conf = confirm('Etes vous sur de vouloir supprimer la technologie : '+techno[i].textContent);
        if(conf == true){
        request.open('GET', 'supprime.php?techno='+techno[i].textContent, true);
        request.send();
        techno[i].style.display = 'none';
        document.getElementsByClassName('butt')[i].style.display = 'none';
        document.getElementsByClassName('renom')[i].style.display = 'none';
            
        }else{
            return;
        }
    }
    
    //Fonction qui affiche l'input de renommage de la techno Affichage;
    
    var afficheInput = function(i){
        
        for(var j = 0; j<document.getElementsByClassName('renommage').length; j++){
        document.getElementsByClassName('renommage')[j].style.display = 'none';
        }
        
        document.getElementsByClassName('techno')[i].style.display = 'none';
        document.getElementsByClassName('butt')[i].style.display = 'none';
        document.getElementsByClassName('renommage')[i].style.display = 'inline-block';
        document.getElementsByClassName('renom')[i].style.display = 'none';
        document.getElementsByClassName('reTech')[i].setAttribute('placeholder', document.getElementsByClassName('techno')[i].textContent);
        
    }
    
    //Fonction qui permet de renommer la techno Requete;
    
    var renomme = function(i){
        
        techno = document.getElementsByClassName('techno')[i].textContent;
        var renom = document.getElementsByClassName('reTech')[i].value;
        console.log('techno : '+techno+' renom : '+renom);
        request.onload = traiteResultat;
        request.open('GET', 'renommage.php?renom='+renom+'&techno='+techno, true);
        request.send();
        
    }
    
    </script>
  </body>
  </html>
