<?php include('includes/header.php'); ?>

	
	<div id='contenu'>
	
		<?php
			$req = "SELECT * FROM articles, pages, couleur WHERE articles.page = pages.idPage AND articles.couleur = couleur.idCouleur AND libellePage = 'Partenaires'";
			$res = mysql_query($req);
			$ligne = mysql_fetch_array($res);

			echo('<div class="titre '.$ligne['libelleCouleur'].'">');
				echo ($ligne['titreArticle']);
			echo('</div>');

			echo($ligne['contenuArticle']);

		?>

		<table class='logos_partenaires'>
				
			<?php
				$req_nblignes = "SELECT COUNT(*) AS nblignes FROM partenaires";
				$res_nblignes = mysql_query($req_nblignes);
				$ligne_nblignes = mysql_fetch_array($res_nblignes);

				$req = "SELECT * FROM partenaires";
				$res = mysql_query($req);
				$ligne = mysql_fetch_array($res);

				for($i=0; $i <= $ligne_nblignes['nblignes']; $i++)
				{
					if(($i%4) == 0)
					{	
						echo('</tr>');
					}
					else
					{
						echo('<tr>');
						$j = 0;

						while(($ligne) && ($j < 4))
						{
							echo('<td><a href="'.$ligne['lienPartenaire'].'"><img src="'.str_replace('../','',$ligne['imagePartenaire']).'"/></a></td>');
							$j++;
							$ligne = mysql_fetch_array($res);
						}						
					}
				}


			?>

		</table>

	</div>


<?php include('includes/footer.php'); ?>