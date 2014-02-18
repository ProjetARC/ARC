<?php
	$serveur = 'localhost';
	$utilisateur = 'root';
	$motdepasse = '';
	$base = 'arc';
	$connexion = new PDO('mysql:host='.$serveur.';dbname='.$base, $utilisateur, $motdepasse);
?>