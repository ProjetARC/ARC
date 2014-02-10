<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="css/menu_style.css" rel="stylesheet" type="text/css" media="screen"/>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
		<script type="text/javascript" src="js/carrousel.js"></script>
		<script type="text/javascript" src="js/autoHeight.js"></script>
		<script type="text/javascript" src="js/header.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="js/google_maps.js"></script>
		
		<title>ARC Informatique :: Bienvenue</title>
	</head>
	<body>
		<!-- bloc d'en-tête-->
		<div id='header'>
			<div id='header-border'>
				<div id='conteneur_header'>
					<div id='logo'>
						<img src="images/logo_ARC.png">
					</div>
					
					<!-- bloc du menu -->
					<div id='navigation1'>
						<ul id="menu1"> 
							<?php
								$tabUrl = parse_url($_SERVER['PHP_SELF']);
    							$fichier =basename ($tabUrl["path"]);

    							if ($fichier == "index.php")
								{	
									echo ('<li class="page"><a href="index.php"><span class="LigatureSymbols">home </span>Accueil</a></li><!--');
								}
								else
								{
									echo ('<li><a href="index.php"><span class="LigatureSymbols">home </span>Accueil</a></li><!--');
								}
							    echo ('--><li><a href="#"><span class="LigatureSymbols">memo </span>Partenaires</a></li><!--');
								echo ('--><li><a href="#"><span class="LigatureSymbols">server </span>Produits</a></li><!--');
								echo ('--><li><a href="#"><span class="LigatureSymbols">group </span>Prestations</a></li><!--');
								if ($fichier == "contact.php")
								{
									echo ('--><li class="page"><a href="contact.php"><span class="LigatureSymbols">mail </span>Contact</a></li><!--');
								}
								else
								{
									echo ('--><li><a href="contact.php"><span class="LigatureSymbols">mail </span>Contact</a></li><!--');
								}
								echo ('--><li><a href="http://webmail.arc.sn/""><span class="LigatureSymbols"><strong>@ </strong></span>Webmail</a></li>');
						 	?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- bloc qui contient tout le contenu -->
		<div id='conteneur'>

		<?php include('includes/menu.php'); ?>

			<div id='conteneur-sepia'>