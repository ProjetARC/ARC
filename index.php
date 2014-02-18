		<!-- include qui permet l'affichage du menu et de l'en-tête -->
		<?php include('includes/header.php'); ?>
		
		<!-- bloc du caroussel, affichage des différentes prestations -->
		<div class='carrousel-conteneur'>
			<div class='carrousel-selecteur'></div>
			<div class='carrousel-selecteur-languette'></div>
			<div class='carrousel'>
				<ul class='diapo'>
					<?php
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

						$nbImage = count_files('images/carrousel');

						for ($i = 1; $i <= $nbImage; $i++)
						{
							echo ('<li id="diapo'.$i.'"><img src="images/carrousel/img'.$i.'.jpg"></li>');
						}
					?>
				</ul>
			</div>
			<div class='carrousel-lecture'><span></span></div>
		</div>
		<div id='cpt'></div>
		<!-- bloc qui  affiche les informations de l'entreprise -->
		<div id='contenu'>

			<?php

				$req = "SELECT * FROM articles, pages, couleur WHERE pages.idPage = articles.page AND couleur.idCouleur = articles.couleur AND libellePage = 'Accueil' ORDER BY ordreArticle";
				$res = mysql_query($req);
				$ligne = mysql_fetch_array($res);

				while($ligne)
				{
					echo('<div>');
						echo('<div class="titre '.$ligne['libelleCouleur'].'">');
							echo('<span class="text">');

							echo(utf8_encode($ligne['titreArticle']));

							echo('</span>');
							echo('<span class="trait">');
							echo('</span>');
						echo('</div>');

						echo('<div>');
							echo(utf8_encode($ligne['contenuArticle']));
						echo('</div>');
					echo('</div>');

					$ligne = mysql_fetch_array($res);
				}
			?>

		</div>
		
		<!-- include qui permet l'affichage du pied de page -->
		<?php include('includes/footer.php'); ?>
