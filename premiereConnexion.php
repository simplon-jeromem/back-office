<?php
session_start();
$_SESSION['iduser'];

if(!isset($_SESSION['iduser'])){
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau password</title>
</head>
<body>
<a href="requete-login/logout.php">Logout</a>
<p>Veuillez renseigner un nouveau mot de passe et le confirmer.</p>
<form action="requete-login/changementMDP.php" method="post">
    <input name="password1" type="password" placeholder="Nouveau mot de passe">
    <input name="password2" type="password" placeholder="Entrer à nouveau votre mot de passe">
    <button type="submit">Valider</button>
</form>

</body>
</html>
