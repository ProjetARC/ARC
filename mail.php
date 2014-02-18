<?php

	$user_mail = $_GET['mail'];
	$objet = $_GET['objet'];
	$msg = $_GET['contenu_mail'];	
	
	mail("wsdown@gmail.com","sujet","test");



	
	/*header('location:contact.php');
	exit();*/
?>