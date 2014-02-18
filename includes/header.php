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
		<!--<script type="text/javascript" src="js/prestation.js"></script>-->

		<?php include('includes/bdd.php'); ?>
		
		
		<title>ARC Informatique :: Bienvenue</title>
	</head>
	<body>
		<!-- bloc d'en-tête-->
		<div id='header'>
			<div id='header-border'>
				<div id='conteneur_header'>
					<div id='logo'>
						<a href='index.php'><img src="images/logo_ARC.png"></a>
					</div>

					<!--<div class='conteneur_bouton'>
						<div class='segment_gauche'></div>
						<div class='bouton_menu'></div>
						<div class='segment_droite'></div>
					</div>-->
					
					<!-- bloc du menu -->
					<div id='navigation'>
						<ul id="menu"> 
							<?php
								$tabUrl = parse_url($_SERVER['PHP_SELF']);
    							$fichier =basename ($tabUrl["path"]);

    							$req = "SELECT * FROM pages ORDER BY ordreMenu";
    							$res = mysql_query($req);
    							$ligne = mysql_fetch_array($res);

    							
    							while($ligne)
    							{
    								echo('<li class="conteneur_bouton"><a href="'.$ligne['lien'].'"><span>'.$ligne['libellePage'].'</span></a>');

    									$req_id_page = "SELECT * FROM sous_menu WHERE idPage = '". $ligne["idPage"]."'";
	    								$res_id_page = mysql_query($req_id_page);
	    								$ligne_id_page = mysql_fetch_array($res_id_page);


	    								if($ligne['idPage'] == $ligne_id_page['idPage'])
	    								{

	    									echo('<div class="sub_menu"><ul>');

	    									while($ligne_id_page)
	    									{
	    										echo('<li><a href="'.$ligne_id_page['lien_sous_menu'].'">'.utf8_encode($ligne_id_page['libelleSousMenu']).'</a></li>');
	    										$ligne_id_page = mysql_fetch_array($res_id_page);
	    									}

	    									echo('</ul>');
	    									echo('</div></li>');
	    									
	    								}
	    								$ligne = mysql_fetch_array($res);
    								}
    								

    								echo ('<li class="conteneur_bouton"><a href="http://webmail.arc.sn/""><span>Webmail</span></a></li>');
						 	?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- bloc qui contient tout le contenu -->
		<div id='conteneur'>

		<?php// include('includes/menu.php'); ?>

			<div id='conteneur-sepia'>