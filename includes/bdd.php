<?php
	$host = 'localhost';
	$user = 'root';
	$pwd = '';
	$bdd = 'arc';

	mysql_connect($host, $user, $pwd) or die('Erreur de connection');
	mysql_select_db($bdd);
?>