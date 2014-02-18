<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style_connexion.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/form.js"></script>
</head>
<body>
	
	<div id='connexion_admin'>
		<form class='form_admin' name='form_admin' method='post' action='admin_traitement.php'>
			
			<div class='form_logo'>
				<img src='../images/logo_ARC.png' />
			</div>

			<div class='form_identification'>
				<input type='text' name='login' placeholder='Login' />
				<input type='password' name='password' placeholder='Password' />
			</div>

			<?php
				$error = isset($_GET['error']);

				if($error == true) {
					echo('<p class="error">Identifiants incorrects.</p>');
				}
			?>

			<div class='form_bouton'>
				<input type='submit' name='envoyez' value='Envoyez' />
			</div>

		</form>
	</div>


</body>
</html>