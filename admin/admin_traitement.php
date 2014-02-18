<?php
	include('include/bdd.php');


	$login = mysql_real_escape_string($_POST['login']);
	$password =  mysql_real_escape_string(hash('sha256',$_POST['password']));


	$req = $connexion->prepare("SELECT * FROM utilisateur WHERE login = '" . $login . "' AND password = '" . $password . "'");
	$req -> execute();
	$ligne=$req->fetch(PDO::FETCH_OBJ);

	if($ligne != false)
	{
		header('Location: admin.php');
		exit();

		
	}
	else
	{
		header('Location: index.php?error=true');
		exit();
		
	}
?>