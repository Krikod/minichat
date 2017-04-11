<?php
// insère le message reçu avec $_POST dans la base de données puis redirige vers minichat.php.

// Connexion à la bade de données

setcookie('pseudo', $_POST['pseudo'], time() + 60*24*3600, null, null, false, true);


// Insertion du message à l'aide d'une requête préparée
if (isset($_POST['pseudo']) AND isset($_POST['message'])) {
	try {
	$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', 'root');
	}

	catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO messages (pseudo, message) VALUES(?, ?)');
	$req->execute(array($_POST['pseudo'], $_POST['message']));
}

// Redirection du visiteur vers la page minichat.php
header('location: minichat.php');

?>