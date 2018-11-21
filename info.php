<?php
	session_start();

?>

<a href="exo.php">accueil</a>
<a href="deco.php">deconnexion</a>
<h1>Info</h1>
<p> Utilisateur : <?= $_SESSION['user'] ?></p>
<p> Age : <?= $_SESSION['age'] ?></p>
<p> Job : <?= $_SESSION['job'] ?></p>
