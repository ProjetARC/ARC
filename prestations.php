<?php include('includes/header.php'); ?>
	
	<div id='contenu'>

		<div id='menu_solutions'>
			<?php
				$req = 'SELECT titreArticle, idArticle FROM pages, articles WHERE pages.idPage = articles.page AND libellePage = "Solutions" ORDER BY ordreArticle';
				$res = mysql_query($req);
				$ligne = mysql_fetch_array($res);

				echo ('<ul>');	

				while($ligne)
				{
					echo('<li><a href="prestations.php?page='.$ligne['idArticle'].'">'.utf8_encode($ligne['titreArticle']).'</a></li>');
					$ligne = mysql_fetch_array($res);
				}

				echo ('</ul>');
			?>
		</div>

		<div class='contenu_solutions'>
			
				<?php
					if(isset($_GET['page']))
					{
						echo('<div class="titre prestation orange">');

						$req = 'SELECT titreArticle FROM articles WHERE idArticle = '.$_GET['page'];
						$res = mysql_query($req);
						$ligne = mysql_fetch_array($res);

						echo utf8_encode($ligne['titreArticle']);
						echo('</div>');
					}
					else
					{
						echo('<div class="titre prestation orange">');

						$req = 'SELECT titreArticle FROM articles, pages WHERE pages.idPage = articles.page AND libellePage = "Solutions"';
						$res = mysql_query($req);
						$ligne = mysql_fetch_array($res);

						echo utf8_encode($ligne['titreArticle']);
						echo('</div>');
					}
				?>
			
			<div>
				<?php
					if(isset($_GET['page']))
					{
						$req = 'SELECT contenuArticle FROM articles WHERE idArticle = '.$_GET['page'];
						$res = mysql_query($req);
						$ligne = mysql_fetch_array($res);
						echo utf8_encode($ligne['contenuArticle']);
					}
					else
					{
						$req = 'SELECT contenuArticle FROM articles, pages WHERE pages.idPage = articles.page AND libellePage = "Solutions"';
						$res = mysql_query($req);
						$ligne = mysql_fetch_array($res);
						echo utf8_encode($ligne['contenuArticle']);
					}
				?>
			</div>
		</div>
	</div>

<?php include('includes/footer.php'); ?>