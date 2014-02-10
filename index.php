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
			<div id='presentation'>
				<div class='titre orange'>
					<span class='text'>Qui sommes-nous ?</span>
					<span class='trait'>
					</span>
				</div>
				
				<p>La société ARC Informatique, 
					créée en 1993, a réussi à hisser 
					parmi les entreprises les plus 
					performantes du Sénégal, 
					elle dispose d'une équipe 
					d'ingénieurs expérimentés, 
					maîtrisant l'Audit, le Design, 
					la Gestion de Projets, 
					et les Services managés.
				<br/>
				<br/>
					Tout au long de son parcours,
					ARC s’est démarquée en tant qu’intégrateur de solutions allant de la mise en oeuvre de solutions informatiques complexes, 
					au développement d’applications de gestion intégrées.
				<br/>
				<br/>
					Ainsi, de part sa notoriété, ARC a noué des partenariats avec des opérateurs internationaux.
					Par ailleurs, elle a signé des accords stratégiques avec des constructeurs et éditeurs leaders sur le marché de l'informatique.
				<br/>
				<br/>
				</p>
			</div>
			
			<!-- bloc qui permet d'accéder au webmail -->
			<div id='webmail'>
				<div class='titre bleu'>
					<span class='text'>Webmail</span>
					<span class='trait'>
						
					</span>
				</div>
				<div class='webmail_contenu'>
					<p> Pour accèder à votre Webmail 
						il vous suffit de taper l'adresse : 
					</p>
					<p>
						<a href='http://webmail.arc.sn'>http://webmail.arc.sn</a> 
						ou de cliquer sur l'icone ci-dessous.
					</p>
				</div>
				<div class='webmail_logo'>
					<a href='http://webmail.arc.sn'><img class='logo_webmail' src='images/webmail.png'/></a>
				</div>
			</div>
		</div>
		
		<!-- include qui permet l'affichage du pied de page -->
		<?php include('includes/footer.php'); ?>
