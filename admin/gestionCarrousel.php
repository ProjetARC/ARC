<?php

if(isset($_GET['modifCarrousel']) && $_GET['modifCarrousel'] == 'suppr')
{
	$fichier = '../images/carrousel/img'.$_GET['img'].'.jpg';
	
	if( file_exists ( $fichier))
	{
		unlink( $fichier );
	}

	$pointeur=opendir('../images/carrousel/');
	$i = 1;
	
	while ($entree = readdir($pointeur))
	{
		if ($entree != "." && $entree != "..") 
		{
			rename('../images/carrousel/'.$entree, '../images/carrousel/img'.$i.'.jpg');
			$i++;
		}
	}
	closedir($pointeur);

    header('location: admin.php?gestion=carrousel&suppr=ok');
	exit();
}

elseif (isset($_GET['modifCarrousel']) && $_GET['modifCarrousel'] == "ajout")
{
	$extensions_valides = array( '.jpg' );
	$extension_upload = strrchr($_FILES['fichier']['name'], '.');

    if (in_array($extension_upload,$extensions_valides))
    {
    	$nbImages = count_files('../images/carrousel/') + 1;

		$nom = 'img'.$nbImages.'.jpg';

		if(move_uploaded_file($_FILES['fichier']['tmp_name'], '../images/carrousel/' . $nom)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
	    {
	    	header('location: admin.php?gestion=carrousel');
			exit();
	    }
	    else //Sinon (la fonction renvoie FALSE).
	    {
	        header('location: admin.php?gestion=carrousel&error=upload');
			exit();
		}
	}
	else
	{
		header('location: admin.php?gestion=carrousel&error=extension');
		exit();
	}
}

function count_files($dir)
{
	$num = 0;
	 
	$dir_handle = opendir($dir);
	while($entry = readdir($dir_handle))
	if(is_file($dir.'/'.$entry))
	$num++;
	closedir($dir_handle);
	 
	return $num;
}
?>