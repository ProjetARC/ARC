<?php include('include/bdd.php'); 

if($_POST['modif'] == 'Supprimer')
{
	$reqContenu=$connexion->prepare("DELETE FROM sous_menu WHERE idPage=".$_POST['page']);
	$reqContenu->execute();
	$reqContenu=$connexion->prepare("DELETE FROM articles WHERE idPage=".$_POST['page']);
	$reqContenu->execute();
	$reqContenu=$connexion->prepare("DELETE FROM pages WHERE idPage=".$_POST['page']);
	$reqContenu->execute();

	header('location: admin.php');
	exit();
}


elseif($_POST['modif'] == 'Modifier')
{
	$reqContenu=$connexion->prepare("UPDATE pages SET libellePage='".utf8_decode(addslashes($_POST['menu']))."', lien='".utf8_decode(addslashes($_POST['lien']))."' WHERE idPage=".$_POST['page']);
	$reqContenu->execute();

	header('location: admin.php?gestion=menu&page='.$_POST['page']);
	exit();
}


elseif($_POST['modif'] == 'Ajouter' && !isset($_POST['modifMenu']))
{	
	if ($_POST['sousMenu'] != '' || $_POST['lien'] != '')
	{
		$reqContenu=$connexion->prepare("INSERT INTO sous_menu(idPage, libelleSousMenu, lien_sous_menu) VALUES (".$_POST['page'].", '".utf8_decode(addslashes($_POST['sousMenu']))."', '".utf8_decode(addslashes($_POST['lien']))."')");
		$reqContenu->execute();
	}
	else
	{
		header('location: admin.php?gestion=menu&page='.$_POST['page'].'&type=error');
		exit();
	}

	header('location: admin.php?gestion=menu&page='.$_POST['page']);
	exit();
}

elseif(isset($_GET['modif']) == 'supprSousMenu')
{	
	$reqContenu=$connexion->prepare("DELETE FROM sous_menu WHERE idSousMenu=".$_GET['sousMenu']);
	$reqContenu->execute();

	header('location: admin.php?gestion=menu&page='.$_GET['page']);
	exit();
}

elseif(isset($_POST['modifSousMenu']) == 'Modifier')
{	
	$reqContenu=$connexion->prepare("UPDATE sous_menu SET libelleSousMenu='".utf8_decode(addslashes($_POST['sousMenuLibelle']))."', lien_sous_menu='".utf8_decode(addslashes($_POST['lien']))."' WHERE idSousMenu=".$_POST['sousMenu']);
	$reqContenu->execute();

	header('location: admin.php?gestion=menu&page='.$_POST['page']);
	exit();
}

elseif(isset($_POST['modifSousMenu']) == 'Annuler')
{
	header('location: admin.php?gestion=menu&page='.$_POST['page']);
	exit();
}

elseif($_POST['modifMenu'] == 'ajouterMenu' && $_POST['modif'] == 'Ajouter')
{
	$reqContenu=$connexion->prepare("INSERT INTO pages(libellePage, lien) VALUES ('".$_POST['menu']."', '".$_POST['lien']."')");
	$reqContenu->execute();

	$reqContenu=$connexion->prepare("SELECT idPage FROM pages WHERE libellePage='".$_POST['menu']."'");
	$reqContenu->execute();
	$lignes=$reqContenu->fetch(PDO::FETCH_OBJ);

	header('location: admin.php?gestion=menu&page='.$lignes->idPage);
	exit();
}

elseif ($_POST['modif'] == 'ordre')
{
	if ($_POST['type'] == 'Annuler')
	{
		header('location: admin.php?gestion=menu&page=principal');
		exit();
	}
	elseif ($_POST['type'] == 'Ok')
	{
		$reqContenu=$connexion->prepare("SELECT * FROM pages ORDER BY ordreMenu");
		$reqContenu->execute();

		while ($lignes=$reqContenu->fetch(PDO::FETCH_OBJ))
		{
			$reqUpdate=$connexion->prepare("UPDATE pages SET ordreMenu=".$_POST[$lignes->idPage]." WHERE idPage=".$lignes->idPage);
			$reqUpdate->execute();
		}

		header('location: admin.php?gestion=menu&page=principal');
		exit();
	}
}
?>