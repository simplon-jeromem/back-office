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

    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

    <!-- Milligram CSS minified -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.1.0/milligram.min.css">

    <meta charset="UTF-8">
    <title>Nouveau password</title>
</head>
<body>
<a href="requete-login/logout.php">Logout</a>
<p>Veuillez renseigner un nouveau mot de passe et le confirmer.</p>
<form action="requete-login/changementMDP.php" method="post">
    <input name="password1" required="required" type="password" placeholder="Nouveau mot de passe">
    <input name="password2" required="required" type="password" placeholder="Entrer à nouveau votre mot de passe">
    <button type="submit">Valider</button>
</form>

</body>
</html>
