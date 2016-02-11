<?php
session_start();
if(!isset($_SESSION['iduser'])){
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>


  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

  <!-- CSS Reset -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

  <!-- Milligram CSS minified -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.1.0/milligram.min.css">

  <!-- You should properly set the path from the main file. -->
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,400italic,500italic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="siteform.css"/>

  <meta charset="utf-8">
  <title>Changement des informations</title>
</head>
<body>
  <?php

  $iduser = $_SESSION['iduser'];

  try {
    $connexion=new PDO('mysql:host=localhost;dbname=simplonsite;charset=utf8','root','root');
  }
  catch (Exception $e){
    die ('erreur : '.$e->getMessage());
  }

  //requete pour afficher le contenu de la table lien

  $requete="SELECT * FROM `lien` WHERE id='".$iduser."'";
  $reponse = $connexion->query($requete);
  $lien = $reponse->fetch();
  $tel = $lien['tel'];
  $mail = $lien['mail'];
  $git = $lien['git'];
  $codepen = $lien['codepen'];
  $twitter = $lien['twitter'];
  $linkedin = $lien['linked'];
  $siteperso = $lien['siteperso'];
  //  $reponse->closeCursor();

  //requete pour afficher le contenu de la table apprenant

  $requete2="SELECT * FROM `apprenant` WHERE id='".$iduser."'";
  $reponse2 = $connexion->query($requete2);
  $apprenant = $reponse2->fetch();
  $desc = $apprenant['description'];
  ?>

  <header>
    <a id="logout"href="requete-login/logout.php">Logout</a>
  </header>
  <form id="userForm">
    <div class="bloc"><label id="phone" for="tel">Tel</label>
      <div class="contact"><input id="tel" name="titre" type="text" placeholder="Numéro de téléphone" value="<?php echo $tel ?>"/>
      </div>
    </div>

    </br><div class="bloc"><label for="mail">Mail</label>
      <div class="contact">  <input id="mail" name="tache" type="text" placeholder="Adresse mail" value="<?php echo $mail ?>"/>
      </div>
    </div>

    <button id="modif"class="button button-outline" onclick="modifcontact()"  type="button">Modifier contact</button>
    <div class="bloc">
      <div id="description"><label for="desc">Description</label>
      </div>
      <textarea id="desc" ><?php echo $desc ?></textarea>
    </div>
    <button onclick="modifdesc()"  type="button">Modifier description </button>
  </form>





  <p id="rsx">Réseaux</p>
  <ul>
    <li>
      <label for="git">Github</label></br>
      <div class="bloc">
        <div class="un"><span style='display=inline-block'>https://github.com/</span></div>
        <div class="deux"><input id="git" type="text" placeholder="Ecrire ici" value="<?php echo $git ?>"/>
        </div>
      </div>
    </li>
    <li>
      <label for="codepen">Codepen</label> </br>
      <div class="bloc">
        <div class="un"><span style='display=inline-block'>https://codepen.io/</span>
        </div>
        <div class="deux"> <input id="codepen" type="text" placeholder="Ecrire ici" value="<?php echo $codepen ?>" />
        </div>
      </div>
    </li>
    <li><label for="linkedin">LinkedIn</label> </br>
      <div class="bloc">
        <div class="un"><span style='display=inline-block'>https://fr.linkedin.com/</span>
        </div>
        <div class="deux"> <input id="linkedin" type="text" placeholder="Ecrire ici" value="<?php echo $linkedin ?>"/>
        </div>
      </div>
    </li>
    <li><label for="twitter">Twitter</label> </br>
      <div class="bloc">
        <div class="un"><span style='display=inline-block'>https://twitter.com/</span>
        </div>
        <div class="deux"> <input id="twitter" type="text" placeholder="Ecrire ici" value="<?php echo $twitter ?>"/>
        </div>
      </div>
    </li>
    <li>
      <label id="sp"for="sitepers">Site perso</label><input id="sitepers" type="text" placeholder="Ecrire ici" value="<?php echo $siteperso ?>"/>
    </li>

  </ul>
  <button onclick="modiflien()"  type="button">Modifier lien</button>

<!--///////////////////////////david//////////////////////-->

<p>Les technos s'enregistrent automatiquement lorsque vous cliquez sur un input.</p>
<!-- <p><b>Bug actuellement</b></p> -->
<table>
  <tr>
    <th>langage</th><th>0</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th>
  </tr>
  <?php

  // try
  // {
  //   $connect = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
  // }
  // catch (Exception $e){
  //   die('Erreur : '.$e->getMessage());
  // }


  $a = -1;
  $request = "SELECT * FROM `techno`";
  $result = $connexion->query($request);

  while($data = $result->fetch()){
    $idt = $data['id'];
    $req = "SELECT * FROM `competences` WHERE ida=$iduser AND idt=$idt";
    $res = $connexion->query($req);
    $comp = $res->fetch();
    $a++;


    ?>
    <tr>
      <td class='name <?php if($a % 2 !== 0){ echo 'colorRed';} ?>' >
        <?php echo $data['techno'] ?>
      </td>
      <td <?php if($a % 2 !== 0){ echo "class='colorRed'";} ?>>
        <input type="radio" <?php if(($comp['niveau'] == 0)||($comp['niveau']===NULL)){echo 'checked="checked"';}; ?>name="lvl<?php echo $a ?>" onclick='valeur(<?php echo $a ?>, event)' value="0"/>
      </td>
      <td <?php if($a % 2 !== 0){ echo "class='colorRed'";} ?>>
        <input type="radio" <?php if($comp['niveau'] == 1){echo 'checked="checked"';}; ?> name="lvl<?php echo $a ?>" onclick='valeur(<?php echo $a ?>, event)'  value="1"/>
      </td>
      <td <?php if($a % 2 !== 0){ echo "class='colorRed'";} ?>>
        <input type="radio" <?php if($comp['niveau'] == 2){echo 'checked="checked"';}; ?> name="lvl<?php echo $a ?>" onclick='valeur(<?php echo $a ?>, event)'  value="2"/>
      </td>
      <td <?php if($a % 2 !== 0){ echo "class='colorRed'";} ?>>
        <input type="radio" <?php if($comp['niveau'] == 3){echo 'checked="checked"';}; ?> name="lvl<?php echo $a ?>" onclick='valeur(<?php echo $a ?>, event)'  value="3"/>
      </td>
      <td <?php if($a % 2 !== 0){ echo "class='colorRed'";} ?>>
        <input type="radio" <?php if($comp['niveau'] == 4){echo 'checked="checked"';}; ?> name="lvl<?php echo $a ?>" onclick='valeur(<?php echo $a ?>, event)'  value="4"/>
      </td>
      <td <?php if($a % 2 !== 0){ echo "class='colorRed'";} ?>>
        <input type="radio" <?php if($comp['niveau'] == 5){echo 'checked="checked"';}; ?> name="lvl<?php echo $a ?>" onclick='valeur(<?php echo $a ?>, event)'  value="5"/>
      </td>
    </tr>
    <?php } ?>
  </table>


  <div class="bloc">
    <input type="text" id='nom'/><input type="button" onclick='ajouter()' id='add' value="ajouter"/>
    <form action="ok.php" method="post"></form>
  </div>


  <form action="ok.php" method="post">
  <button id="terminer">Terminer!</button>
  </form>

  <script type="text/javascript">

  var requete =new XMLHttpRequest();
  var valide1;

  function modifcontact () {
    var tel =document.getElementById("tel").value;
    var mail= document.getElementById("mail").value;
    var isnan = isNaN(tel);
    console.log(tel.length);
    console.log(isnan);

    if (tel.length != 10 || isNaN(tel)) {
      console.log("numéro de téléphone incorrect");
    }
    else {
      console.log("tel ok ");
    }
    valide1 = false;

    //vérification de l'adresse mail

    for(var j=1;j<(mail.length);j++) {
      if((mail.charAt(j)=='@')&&(j<(mail.length-4))) {
        for(var k=j;k<(mail.length-2);k++) {
          if(mail.charAt(k)=='.') {
            valide1=true;
          }
        }
      }

    }
    if (valide1 === false){
      console.log("Veuillez saisir une adresse email valide.");

    }
    else {
      // requete.onload=ajax;
      requete.open("get","requete-form/modifcontact.php?tel="+tel+"&mail="+mail,true);
      requete.send();
      // function ajax (){
      // var tableau =this.responseText;
      // console.log(tableau);
      // }
    }
    // console.log(tel+mail);

  }

  function modifdesc () {
    var desc =document.getElementById("desc").value;
    // requete.onload=ajax;
    requete.open("get","requete-form/modifdesc.php?desc="+desc,true);
    requete.send();
    function ajax (){
      var tableau =this.responseText;
      console.log(tableau);
    }

  }
  function modiflien () {
    var git =document.getElementById("git").value;
    var codepen =document.getElementById("codepen").value;
    var linkedin =document.getElementById("linkedin").value;
    var twitter =document.getElementById("twitter").value;
    var siteperso =document.getElementById("sitepers").value;
    // requete.onload=ajax;
    requete.open("get","requete-form/modiflien.php?git="+git+"&codepen="+codepen+"&linked="+linkedin+"&twitter="+twitter+"&siteperso="+siteperso,true);
    requete.send();
    function ajax (){
      var tableau =this.responseText;
      console.log(tableau);
    }
  }



  var request = new XMLHttpRequest;

  var i = <?php echo $a; ?>;
  var traiteResultat = function(){
    var data = this.responseText;
    console.log(data);
  }

  function ajouter(){
    i++;
    var tr = document.createElement('tr');
    document.getElementsByTagName('table')[0].appendChild(tr);
    var td = document.createElement('td');
    tr.appendChild(td);
    td.setAttribute('class', 'name');
    td.textContent = document.getElementById('nom').value;
    var newTech = document.getElementById('nom').value;
    request.open('GET', 'requete-form/insert.php?name='+newTech, true);
    request.send();
    //var nom = document.createElement('p');
    //td.appendChild(nom);
    //nom.textContent = document.getElementById('nom').value;
    var fonction = 'valeur('+i+', event)';
    for(j=0; j<6; j++){
      var td2 = document.createElement('td');
      tr.appendChild(td2);
      var radio = document.createElement('input');
      radio.setAttribute('type', 'radio');
      td2.appendChild(radio);
      radio.setAttribute('name', 'lvl'+i);
      radio.setAttribute('value', j);
      radio.setAttribute('onclick', fonction);
      if(i % 2 !== 0){
        td.classList.add("colorRed");
        td2.classList.add("colorRed");
      }
    }
  }

  function valeur(i, ev){
    var nom = document.getElementsByClassName('name')[i].textContent;
    console.log("nom: "+nom);
    console.log("target: "+ev.target.value);
    //request.onload = traiteResultat;
    request.open('GET', 'requete-form/process.php?niveau='+ev.target.value+'&techno='+nom.trim());
    request.send();
  }
  </script>

</body>
</html>
