<?php include('includes/header.php'); ?>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/google_maps.js"></script>
	
	<!-- bloc affichant les contacts de l'entreprise ainsi que le plan d'accès -->
	<div id='contenu'>

		<div class='titre orange'>
					<span class='text'>Contactez-nous</span>
					<span class='trait'></span>
		</div>

		
		<!-- bloc qui affiche les informations détaillées -->
		<div class='info-contact'>
			<div class='google-map'>
				<div id='map'>
				</div>
			</div>
			<?php
				$req = "SELECT contenuArticle FROM articles, pages WHERE articles.page = pages.idPage AND libellePage = 'Contact'";
				$res = mysql_query($req);
				$ligne = mysql_fetch_array($res);

				echo utf8_encode($ligne['contenuArticle']);
			?>
		</div>

		<div class='contact_mail'>
			
			<form name='mail' method='get' action='mail.php'>
				<div class='form_info'>
					<input type='text' name='nom' placeholder='Votre nom'/>
					<input type='email' name='mail' placeholder='E-mail'/>
					<input type='text' name='objet' placeholder='Objet'/>
				</div>
				<div class='form_message'>
						<textarea name='contenu_mail' placeholder='Votre message'></textarea>
				</div>
				<div class='form_envoi'>
					<input type='submit' name='envoyez' value='Envoyez'/>
				</div>
			</form>

		</div>
	</div>


<?php include('includes/footer.php'); ?>