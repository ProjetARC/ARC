<?php include('include/bdd.php'); 

if ($_POST['type'] == 'Annuler')
{
	header ('location: admin.php?gestion=article&page='.$_POST['page'].'&error=1');
	exit();
}

// MODIFIER ARTICLE
elseif ($_POST['type'] == 'Envoyer' && isset($_POST['modif']) && $_POST['modif'] == 'modif')
{
	$reqContenu=$connexion->prepare("UPDATE articles SET titreArticle='".utf8_decode(addslashes($_POST['titre']))."', contenuArticle='".utf8_decode(addslashes($_POST['n_text']))."', couleur=".$_POST['couleur']." WHERE idArticle=".utf8_encode($_POST['idArticle']));
	$reqContenu->execute();
	header('location: admin.php?gestion=article&page='.$_POST['page'].'&error=2');
	exit();
}

//AJOUTER ARTICLE
elseif ($_POST['type'] == 'Envoyer' && isset($_POST['modif']) && $_POST['modif'] != 'modif')
{
	$reqOrdre=$connexion->prepare("SELECT max(ordreArticle) as ordre FROM articles WHERE page=".utf8_encode($_POST['page']));
	$reqOrdre->execute();
	$lignes=$reqOrdre->fetch(PDO::FETCH_OBJ);

	$ordre = $lignes->ordre;

	if ($ordre == 0)
	{
		$ordre = 1;
	}
	else
	{
		$ordre++;
	}

	$reqContenu=$connexion->prepare("INSERT INTO articles(titreArticle, contenuArticle, page, ordreArticle, couleur) VALUES ('".utf8_decode(addslashes($_POST['titre']))."', '".utf8_decode(addslashes($_POST['n_text']))."', ".$_POST['page'].", ".$ordre.", ".$_POST['couleur'].")");
	$reqContenu->execute();
	header('location: admin.php?gestion=article&page='.$_POST['page'].'&error=3');
	exit();
}

// MODIFIER ORDRE
elseif ($_POST['type'] == 'Ok' && isset($_POST['modif']) && $_POST['modif'] == 'ordre')
{
	$reqContenu=$connexion->prepare("SELECT * FROM articles WHERE page =".$_POST['page']." ORDER BY ordreArticle");
	$reqContenu->execute();

	while($lignes=$reqContenu->fetch(PDO::FETCH_OBJ))
	{
		$reqUpdate=$connexion->prepare("UPDATE articles SET ordreArticle=".$_POST[$lignes->idArticle]." WHERE idArticle=".$lignes->idArticle);
		$reqUpdate->execute();
	}

	header('location: admin.php?gestion=article&page='.$_POST['page'].'&error=5');
	exit();

}

// SUPPRIMER ARTICLE
elseif (isset($_GET['page']) && isset($_GET['article']) && isset($_GET['modif']) && $_GET['modif'] == 'suppr')
{
	$reqContenu=$connexion->prepare("DELETE FROM articles WHERE idArticle=".$_GET['article']);
	$reqContenu->execute();
	header('location: admin.php?gestion=article&page='.$_GET['page'].'&error=4');
	exit();
}
?>