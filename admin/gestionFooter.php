<?php include('include/bdd.php'); 

if (isset($_POST['page']) && $_POST['page'] == 'prefooter')
{
	$reqContenu=$connexion->prepare("UPDATE prefooter SET contenuPreFooter='".utf8_decode(addslashes($_POST['n_text']))."'");
	$reqContenu->execute();

	header('location: admin.php?gestion=prefooter');
	exit();
}

elseif ((isset($_POST['page']) && $_POST['page'] == 'footer') || (isset($_GET['page']) && $_GET['page'] == 'footer'))
{	
	if (isset($_POST['modifFooter']) && $_POST['modifFooter'] == 'Modifier')
	{
		$reqContenu=$connexion->prepare("UPDATE footer SET libelleFooter='".utf8_decode(addslashes($_POST['footer']))."', lienFooter='".utf8_decode(addslashes($_POST['lien']))."' WHERE idFooter = ".$_POST['idFooter']);
		$reqContenu->execute();

		header('location: admin.php?gestion=footer');
		exit();
	}

	elseif (isset($_POST['modifFooter']) && $_POST['modifFooter'] == 'Annuler')
	{
		header('location: admin.php?gestion=footer');
		exit();
	}

	elseif (isset($_GET['modifFooter']) && $_GET['modifFooter'] == 'supprFooter')
	{
		$reqContenu=$connexion->prepare("DELETE FROM footer WHERE idFooter = ".$_GET['footer']);
		$reqContenu->execute();

		header('location: admin.php?gestion=footer');
		exit();
	}

	elseif (isset($_POST['modifFooter']) && $_POST['modifFooter'] == 'Ajouter')
	{
		$reqContenu=$connexion->prepare("INSERT INTO footer(libelleFooter, lienFooter) VALUES ('".$_POST['footer']."', '".$_POST['lien']."')");
		$reqContenu->execute();

		header('location: admin.php?gestion=footer');
		exit();
	}
}
?>