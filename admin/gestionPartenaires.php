<?php include('include/bdd.php'); 


if($_POST['modifPartenaires'] == 'Modifier')
{

	$req = $connexion->prepare("SELECT * FROM partenaires WHERE libellePartenaire = '" . $_POST['libellePartenaire'] . "'");
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_OBJ);


	$extensions_valides = array( '.jpg' , '.jpeg' , '.gif', '.png' );
	$extension_upload = strrchr($_FILES['imagePartenaire']['name'], '.');

	echo $nom = "../images/partenaires/".$ligne->libellePartenaire."{$extension_upload}";

	//echo $extension_upload;

		if (!(in_array($extension_upload,$extensions_valides)))
		{
			$reqContenu=$connexion->prepare("UPDATE partenaires SET libellePartenaire='".utf8_decode(addslashes($_POST['libellePartenaire']))."',lienPartenaire='".utf8_decode(addslashes($_POST['lienPartenaire']))."' WHERE idPartenaire=".$_POST['idPartenaire']);
			$reqContenu->execute();

			header('location: admin.php?gestion=partenaires');
			exit();

		} 

		$resultat = move_uploaded_file($_FILES['imagePartenaire']['tmp_name'],$nom);

		if ($resultat) 
		{
			$reqContenu=$connexion->prepare("UPDATE partenaires SET libellePartenaire='".utf8_decode(addslashes($_POST['libellePartenaire']))."', imagePartenaire='".$nom."' ,lienPartenaire='".utf8_decode(addslashes($_POST['lienPartenaire']))."' WHERE idPartenaire=".$_POST['idPartenaire']);

			$reqContenu->execute();

			header('location: admin.php?gestion=partenaires');
			exit();
		}
}

elseif($_GET['modifPartenaires'] == 'supprPartenaires')
{	
	$reqContenu=$connexion->prepare("DELETE FROM partenaires WHERE idPartenaire =".$_GET['partenaires']);
	$reqContenu->execute();

	header('location: admin.php?gestion=partenaires');
	exit();
}

elseif($_POST['modifPartenaires'] == 'Ajouter')
{	
	if ($_POST['libellePartenaire'] != '' || $_POST['lienPartenaire'] != '')
	{

		$extensions_valides = array( '.jpg' , '.jpeg' , '.gif', '.png' );
		$extension_upload = strrchr($_FILES['imagePartenaire']['name'], '.');



		echo $nom = "../images/partenaires/".$_POST['libellePartenaire']."{$extension_upload}";

		//echo $extension_upload;

		if (!(in_array($extension_upload,$extensions_valides)))
		{
			$reqContenu=$connexion->prepare("INSERT INTO partenaires (libellePartenaire, lienPartenaire) VALUES ('".utf8_decode(addslashes($_POST['libellePartenaire']))."','".utf8_decode(addslashes($_POST['lienPartenaire']))."')");
			$reqContenu->execute();	

			header('location: admin.php?gestion=partenaires&type=error');
			exit();
		} 

		$resultat = move_uploaded_file($_FILES['imagePartenaire']['tmp_name'],$nom);

		if ($resultat)
		{
				$reqContenu=$connexion->prepare("INSERT INTO partenaires (libellePartenaire, imagePartenaire, lienPartenaire) VALUES ('".utf8_decode(addslashes($_POST['libellePartenaire']))."','".$nom."' ,'".utf8_decode(addslashes($_POST['lienPartenaire']))."')");
				$reqContenu->execute();	


				header('location: admin.php?gestion=partenaires');
				exit();
		}
	
	}
	else
	{
		header('location: admin.php?gestion=menu&type=error');
		exit();
	}
}

elseif($_POST['modifPartenaires'] == 'Annuler')
{
	header('location: admin.php?gestion=partenaires');
	exit();
}

elseif($_POST['modifPartenaires'] == 'modification')
{
	$req = $connexion->prepare("UPDATE articles SET titreArticle = '". $_POST['titre'] . "', contenuArticle = '" . $_POST['contenuArticle'] . "' WHERE idArticle = '" . $_POST['articlesPartenaires'] . "'");
	$req->execute();

	header('location: admin.php?gestion=partenaires');
	exit();
}

?>