<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>TP: minichat</title>
	<link rel="stylesheet" type="text/css" href="minichat_style.css">
</head>
<body>

<!-- Contient le formulaire permettant d'ajouter un message et liste les 10 derniers messages.
-->

	<form method="post" action="minichat_post.php">
		<p>
			<label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="<?php 
			if (isset($_COOKIE['pseudo'])) {
				echo htmlspecialchars($_COOKIE['pseudo']);
				} ?>" autofocus required /><br>
		</p>
		<p>
			<label for="message">Message</label> : <input type="text" name="message" id="message" required/><br>
		</p>
		<p><input type="submit" value="Envoyer" /></p>
		<p><input type="button" onclick='window.location.reload(true)' value="Rafraichir"/></p>
	</form>



<?php

// Connexion à la base de données
try {
	$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', 'root');
	}

catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
	}

// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message FROM messages ORDER BY ID DESC LIMIT 0, 10');

echo '<p><strong>Les dix derniers messages: </strong></p>';

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch()) {
	echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
	}

$reponse->closeCursor();

/*
A FAIRE:
Afficher les anciens messages. On ne voit actuellement que les 10 derniers messages. Sauriez-vous trouver un moyen d'afficher les anciens messages ? Bien sûr, les afficher tous d'un coup sur la même page n'est pas une bonne idée. Vous pourriez imaginer un paramètre$_GET['page']qui permet de choisir le numéro de page des messages à afficher.
*/

?>
</body>
</html>