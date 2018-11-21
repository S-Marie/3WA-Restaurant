<?php

session_start();

$name = 'thib';
$psw = '123';
$age = '28';
$job = 'dev';

if (!empty($_POST)) {

	$pdo = new PDO('mysql:host=localhost;dbname=exo_connexion', 'root', 'troiswa');
	$pdo->exec('SET NAMES UTF8');

	$query = $pdo->prepare
	(
		'SELECT * FROM user WHERE name=?'
	);
    
    $query->execute(array($_POST['name']));

$users = $query->fetchAll(PDO::FETCH_ASSOC);


	if ($_POST['name'] == $name && $_POST['psw'] == $psw ) {
    	$_SESSION['user'] = $name;
		$_SESSION['age'] = $age;
		$_SESSION['job'] = $job;
    }
}

?>

<!DOCTYPE html>
<html>
<body>
<h1> EXO DE CONNEXION</h1>
	<?php if(!empty($_SESSION['user']))  {?>

	<p>Bonjour <?=$_SESSION['user'] ?></p>
	<a href="info.php">Infos</a>
	<a href="deco.php">Deconnexion</a>

<?php } else { ?>
	<form action="exo.php" method="POST">
		<input type="text" name="name">
		<input type="text" name="psw">
		<input type="submit" name="envoyer">
	</form>
<?php }?>
</body>
</html>