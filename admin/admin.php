<?php include('include/bdd.php'); 
error_reporting(E_ERROR | E_WARNING | E_PARSE);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="screen"/>

		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="js/menu.js"></script>
		<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>

		<title>ARC Informatique :: Bienvenue</title>
	</head>
	<body>
		<div id='header'>
			<div id='header_contenu'>
				<div id='logo'>
					<a href='../index.php'><img src="../images/logo_ARC.png"></a>
				</div>
			</div>
		</div>

		<!------------------ MENUS ------------------>
		<div id='menu'>
			<div id='conteneur_menu'>		
				<?php
				echo("<a href='admin.php'>Accueil</a>");

				$reqMenu=$connexion->prepare("SELECT * FROM pages WHERE libellePage NOT LIKE 'Partenaires'");
				$reqMenu->execute();

				echo('<span>Gestion des menus</span>');

				echo('<div class="spanMenu"><a href="admin.php?gestion=menu&page=principal">Menus</a></div>');

				while($lignes=$reqMenu->fetch(PDO::FETCH_OBJ))
				{	
					$id = $lignes->idPage;
					$libelle = $lignes->libellePage;
					echo("<a href='admin.php?gestion=menu&page=".$id."'>".$libelle."</a></br>");
				}

				echo('<span>Gestion des articles</span>');

				$reqMenu->execute();

				while($lignes=$reqMenu->fetch(PDO::FETCH_OBJ))
				{	
					$id = $lignes->idPage;
					$libelle = $lignes->libellePage;
					echo("<a href='admin.php?gestion=article&page=".$id."'>".$libelle."</a></br>");
				}

				echo('<span>Gestion du carrousel</span>');
				echo("<a href='admin.php?gestion=carrousel'>Carrousel</a><br/>");

				echo('<span>Gestion des partenaires</span>');
				echo('<a href="admin.php?gestion=partenaires">Partenaires</a><br/>');

				echo('<span>Gestion des footers</span>');
				echo("<a href='admin.php?gestion=prefooter'>Prefooter</a><br/>");
				echo("<a href='admin.php?gestion=footer'>Footer</a><br/>");
			?>
			</div>
		</div>
		<div id='conteneur'>
			<?php

			
				/**************** GESTION DES MENUS ******************/
				if($_GET['page'] == 'principal' && isset($_GET['gestion']))
				{
					echo("<span class='titre'>Menus</span>");

					echo('<form name="formMenu" action="gestionMenu.php" method="post">');
						echo('Ajouter un menu : ');
						echo('<input name="menu" class="input_menu" type="text">');
						echo(' Lien : ');
						echo('<input name="lien" class="input_menu" type="text">');
						echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
						echo('<input type="hidden"  name="modifMenu"  value="ajouterMenu">');
						echo('<input type="submit" name="modif" value="Ajouter">');
					echo('</form>');

					echo('<br/>');

					echo("<span class='span_sous_menu'>Liste des menus :</span>");

					$reqContenuMenu=$connexion->prepare("SELECT * FROM pages ORDER BY ordreMenu");
					$reqContenuMenu->execute();

					if(isset($_GET['ordreMenu']) && $_GET['ordreMenu'] == 1)
					{
						echo('<form name="formOrdreMenu" action="gestionMenu.php" method="post">');
					}

					echo('<table>');

						while($lignesMenu=$reqContenuMenu->fetch(PDO::FETCH_OBJ))
						{
							if (isset($_GET['ordreMenu']) && $_GET['ordreMenu'] == 1)
							{
								echo('<tr>');
									echo("<td><input name='".$lignesMenu->idPage."' class='input_ordre' type='text' Value='".$lignesMenu->ordreMenu."'>.</td>");
									echo('<td><a class="gris" href="admin.php?gestion=menu&page='.$lignesMenu->idPage.'">'.$lignesMenu->libellePage.'</a></td>');
								echo('</tr>');
							}
							else
							{
								echo('<tr>');
									echo('<td>'.$lignesMenu->ordreMenu.'. </td>');
									echo('<td><a class="gris" href="admin.php?gestion=menu&page='.$lignesMenu->idPage.'">'.$lignesMenu->libellePage.'</a></td>');
								echo('</tr>');
							}
						}

						if (!isset($_GET['ordreMenu']) || $_GET['ordreMenu'] != 1)
						{
							echo('<tr><td></td>');
							echo("<td><a class='bouton_ordre' href='admin.php?gestion=article&page=".$_GET['page']."&ordreMenu=1'>Modifier ordre</a></td>");
							echo('</tr>');
						}
						elseif (isset($_GET['ordreMenu']) && $_GET['ordreMenu'] == 1)
						{
							echo('<tr><td></td>');
							echo('<td><input type="submit" name="type" value="Ok">');
							echo('<input type="hidden"  name="modif"  value="ordre">');
							echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
							echo('<input type="submit" name="type" value="Annuler"></td>');
							echo('</tr>');
						}
						else
						{
							echo('<tr><td></td>');
							echo("<td><a class='bouton_ordre' href='admin.php?gestion=article&page=".$_GET['page']."&ordreMenu=1'>Modifier ordre</a></td>");
							echo('</tr>');
						}

					echo('</table>');

					if (isset($_GET['ordre']) && $_GET['ordre'] == 1)
					{
						echo('</form>');
					}


				}
				elseif(isset($_GET['page']) && $_GET['page'] != 'principal' && !isset($_GET['article']) && !isset($_GET['modif']) && isset($_GET['gestion']) && $_GET['gestion'] == 'menu')
				{
					$reqContenuMenu=$connexion->prepare("SELECT * FROM pages WHERE pages.idPage =".$_GET['page']);
					$reqContenuMenu->execute();
					$lignesMenu=$reqContenuMenu->fetch(PDO::FETCH_OBJ);

					$reqContenuSousMenu=$connexion->prepare("SELECT * FROM sous_menu WHERE sous_menu.idPage =".$_GET['page']);
					$reqContenuSousMenu->execute();


					echo('<form name="formMenu" action="gestionMenu.php" method="post">');
						echo('Titre : ');
						echo('<input name="menu" class="input_menu" type="text" value="'.$lignesMenu->libellePage.'">');
						echo(' Lien : ');
						echo('<input name="lien" class="input_menu" type="text" value="'.utf8_encode($lignesMenu->lien).'">');
						echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
						echo('<input type="submit" name="modif" value="Modifier">');
						echo('<input type="submit" name="modif" value="Supprimer">');
					echo('</form>');

					echo('<br><span class="attention">Attention : la suppression de la page supprimera les articles associés !</span><br><br>');
					echo("<span class='span_sous_menu'>Sous Menus</span>");

					echo('<div id="sous_menu">');

						echo('<table>');
						while ($lignesSousMenu=$reqContenuSousMenu->fetch(PDO::FETCH_OBJ))
						{	
							echo('<tr>');
							if (!isset($_GET['modifMenu']))
							{
								echo('<td>Titre : </td>');
								echo('<td class="gris">'.utf8_encode($lignesSousMenu->libelleSousMenu).'</td>');
								echo('<td>Lien : </td>');
								echo('<td class="gris">'.utf8_encode($lignesSousMenu->lien_sous_menu).'</td>');
								echo("<td><a class='bouton_menu' href='admin.php?gestion=menu&page=".$_GET['page']."&sousMenu=".$lignesSousMenu->idSousMenu."&modifMenu=modif'>Modifier</a></td>");
								echo("<td><a class='bouton_menu' href='gestionMenu.php?page=".$_GET['page']."&sousMenu=".$lignesSousMenu->idSousMenu."&modif=supprSousMenu'>Supprimer</a></td>");
							}
							elseif (isset($_GET['modifMenu']) == 'modif')
							{
								// Modifier un sous menu
								if ($lignesSousMenu->idSousMenu == $_GET['sousMenu'])
								{
									echo('<form name="formMenu" action="gestionMenu.php" method="post">');
										echo('<td>Titre : </td>');
										echo('<td class="gris"><input name="sousMenuLibelle" class="input_menu" type="text" value="'.utf8_encode($lignesSousMenu->libelleSousMenu).'"></td>');
										echo('<td>Lien : </td>');
										echo('<td class="gris"><input name="lien" class="input_menu" type="text" value="'.utf8_encode($lignesSousMenu->lien_sous_menu).'"></td>');
										echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
										echo('<input type="hidden"  name="modif"  value="sousMenu">');
										echo('<input type="hidden"  name="sousMenu"  value="'.$lignesSousMenu->idSousMenu.'">');
										echo('<td><input type="submit" name="modifSousMenu" value="Modifier"></td>');
										echo('<td><input type="submit" name="modifSousMenu" value="Annuler"></td>');
									echo('</form>');
								}
								else
								{
									echo('<td>Titre : </td>');
									echo('<td class="gris">'.utf8_encode($lignesSousMenu->libelleSousMenu).'</td>');
									echo('<td> Lien : </td>');
									echo('<td class="gris">'.utf8_encode($lignesSousMenu->lien_sous_menu).'</td>');
								}
							}
							echo('</tr>');
						}

						// Ajouter un sous menu
						if (!isset($_GET['modifMenu']))
						{
							echo('<tr>');
								echo('<form name="formAjoutSousMenu" action="gestionMenu.php" method="post">');
									echo('<td>Titre : </td>');
									echo('<td><input name="sousMenu" type="text" class="input_menu" type="text"></td>');
									echo('<td>Lien : </td>');
									echo('<td><input name="lien" type="text" class="input_menu"></td>');
									echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
									echo('<td><input type="submit" name="modif" value="Ajouter"></td>');
								echo('</form>');
							echo('</tr>');
						}

						echo('</table>');

					echo('</div>');
				}

				/**************** GESTION DES ARTICLES ******************/

				elseif(isset($_GET['page']) && !isset($_GET['article']) && !isset($_GET['modif']) && isset($_GET['gestion']) && $_GET['gestion'] == 'article')
				{
					
					$reqPage=$connexion->prepare("SELECT * FROM pages WHERE idPage =".$_GET['page']);
					$reqPage->execute();
					$lignes=$reqPage->fetch(PDO::FETCH_OBJ);

					$reqContenu=$connexion->prepare("SELECT * FROM articles WHERE page =".$_GET['page']." ORDER BY ordreArticle");
					$reqContenu->execute();

					echo("<a class='bouton_ajouter' href='admin.php?gestion=article&page=".$_GET['page']."&modif=Ajouter'>Ajouter</a><br>");
					echo("<span class='titre'>Articles de la page : ".$lignes->libellePage."</span>");
					echo("<div class='contenu'>");
					echo("<table>");

					if ($_GET['ordre'] == '1')
					{
						echo('<form name="gestionOrdre" action="gestionArticle.php" method="post">');
					}
						
					while($lignes=$reqContenu->fetch(PDO::FETCH_OBJ))
					{	

						$titre = utf8_encode($lignes->titreArticle);

						if($titre == "")
						{
							$titre = 'Sans titre';
						}
						else
						{
							$titre = utf8_encode($lignes->titreArticle);
						}

						if ($_GET['ordre'] == '1')
						{
							$nbResult = count($reqContenu);

							if ($nbResult > 0)
							{
								
								echo("<tr>");
									echo("<td><input name='".$lignes->idArticle."' class='input_ordre' type='text' Value='".$lignes->ordreArticle."'>.</td>");
									echo("<td class='gris'>".utf8_encode($lignes->titreArticle)."</td>");
								echo("</tr>");
							}
						}

						elseif ($_GET['ordre'] != '1')
						{

							$nbResult = count($reqContenu);

							if ($nbResult > 0)
							{
								echo("<tr>");
									echo("<td>".$lignes->ordreArticle.". </td>");
									echo("<td class='gris'>".$titre."</td>");
									echo("<td><a class='bouton_menu' href='admin.php?gestion=article&page=".$_GET['page']."&article=".$lignes->idArticle."&modif=modif'>Modifier</a></td>");
									echo("<td><a class='bouton_menu' href='gestionArticle.php?page=".$_GET['page']."&article=".$lignes->idArticle."&modif=suppr'>Supprimer</a></td>");		
								echo("</tr>");
							}
						}
					}

					if (!isset($nbResult))
					{
						echo("Aucun article n'a été enregistré.");
					}

					elseif (isset($nbResult) && $_GET['ordre'] == '1')
					{
							echo('<tr><td></td>');
							echo('<td><input type="submit" name="type" value="Ok">');
							echo('<input type="hidden"  name="modif"  value="ordre">');
							echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
							echo('<input type="submit" name="type" value="Annuler"></td>');
							echo('</tr>');
						echo('</form>');
					}
					elseif (isset($nbResult) && $_GET['ordre'] != '1')
					{
						echo('<tr><td></td>');
						echo("<td><a class='bouton_ordre' href='admin.php?gestion=article&page=".$_GET['page']."&ordre=1'>Modifier ordre</a></td>");
						echo('</tr>');
					}
					echo("</table>");
					echo("</div>");
				}

				// MODIFIER UN ARTICLE
				elseif(isset($_GET['page']) && isset($_GET['article']) && isset($_GET['modif']))
				{
					$reqContenu=$connexion->prepare("SELECT * FROM articles WHERE page =".$_GET['page']." AND idArticle =".$_GET['article']);
					$reqContenu->execute();
					$lignes=$reqContenu->fetch(PDO::FETCH_OBJ);

					$reqCouleur=$connexion->prepare("SELECT * FROM couleur");
					$reqCouleur->execute();
					$selected = '';

					echo('<form name="formArticle" action="gestionArticle.php" method="post">');
						echo('<table>');
							echo('<tr>');
								echo('<td>Titre :</td>');
								echo('<td>Couleur du titre :</td>');
							echo('</tr>');
							echo('<tr>');
								echo('<td><input name="titre" class="input" type="text" Value="'.utf8_encode($lignes->titreArticle).'"></td>');
								echo('<td><SELECT name="couleur" size="1">');
								while($lignesCouleur=$reqCouleur->fetch(PDO::FETCH_OBJ))
								{
									if ($lignes->couleur == $lignesCouleur->idCouleur)
									{
										$selected = 'selected';
									}
									else
									{
										$selected = '';
									}
									echo('<OPTION '.$selected.' VALUE="'.$lignesCouleur->idCouleur.'">'.$lignesCouleur->libelleCouleur);
								}
								echo('</SELECT></td>');
							echo('</tr>');
							echo('<tr></tr>');
							echo('<tr>');
								echo('<td>Contenu :</td>');
							echo('</tr>');
						echo('</table>');
						echo('<textarea name="n_text" class="ckeditor" class="input" cols="150" rows="40">'.utf8_encode($lignes->contenuArticle).'</textarea>');
						echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
						echo('<input type="hidden"  name="idArticle"  value="'.$_GET['article'].'">');
						echo('<input type="hidden"  name="modif"  value="modif">');
						echo('<input type="submit" name="type" value="Envoyer">');
						echo('<input type="submit" name="type" value="Annuler">');
					echo('</form>');
				}

				// AJOUT D'UN ARTICLE
				elseif(isset($_GET['page']) && isset($_GET['modif']) && $_GET['modif'] == 'Ajouter')
				{
					$reqCouleur=$connexion->prepare("SELECT * FROM couleur");
					$reqCouleur->execute();

					echo('<form name="formArticle" action="gestionArticle.php" method="post">');
						echo('<table>');
							echo('<tr>');
								echo('<td>Titre :</td>');
								echo('<td>Couleur du titre :</td>');
							echo('</tr>');
							echo('<tr>');
								echo('<td><input name="titre" class="input" type="text"></td>');
								echo('<td><SELECT name="couleur" size="1">');
								while($lignesCouleur=$reqCouleur->fetch(PDO::FETCH_OBJ))
								{
									echo('<OPTION '.$selected.' VALUE="'.$lignesCouleur->idCouleur.'">'.$lignesCouleur->libelleCouleur);
								}
								echo('</SELECT></td>');
							echo('</tr>');
							echo('<tr></tr>');
							echo('<tr>');
								echo('<td>Contenu :</td>');
							echo('</tr>');
						echo('</table>');
						echo('<textarea name="n_text" class="ckeditor" id="n_text" class="input" cols="150" rows="40"></textarea>');
						echo('<input type="hidden"  name="page"  value="'.$_GET['page'].'">');
						echo('<input type="hidden"  name="modif"  value="'.$_GET['modif'].'">');
						echo('<input type="submit" name="type" value="Envoyer">');
						echo('<input type="submit" name="type" value="Annuler">');
					echo('</form>');
				}

				/**************** GESTION DU PREFOOTER ******************/

				elseif (isset($_GET['gestion']) && $_GET['gestion'] == 'prefooter')
				{
					echo("<span class='titre'>Prefooter</span><br/><br/>");

					$reqContenu=$connexion->prepare("SELECT * FROM prefooter");
					$reqContenu->execute();
					$lignes=$reqContenu->fetch(PDO::FETCH_OBJ);

					echo('<form name="formPreFooter" action="gestionFooter.php" method="post" >');
						echo('<textarea name="n_text" class="ckeditor" id="n_text" class="input" cols="150" rows="40">'.$lignes->contenuPreFooter.'</textarea>');
						echo('<input type="hidden"  name="page"  value="prefooter">');
						echo('<input type="submit" name="type" value="Modifier">');
					echo('</form>');
				}

				/**************** GESTION DU FOOTER ******************/

				elseif (isset($_GET['gestion']) && $_GET['gestion'] == 'footer')
				{

					$reqContenu=$connexion->prepare("SELECT * FROM footer");
					$reqContenu->execute();

					echo("<span class='titre'>Footer</span>");
					
					echo('<table>');

					while ($lignes=$reqContenu->fetch(PDO::FETCH_OBJ))
					{	
						echo('<tr>');
						if (!isset($_GET['modifFooter']))
						{
							echo('<td>Titre : </td>');
							echo('<td class="gris">'.utf8_encode($lignes->libelleFooter).'</td>');
							echo('<td>Lien : </td>');
							echo('<td class="gris">'.utf8_encode($lignes->lienFooter).'</td>');
							echo("<td><a class='bouton_menu' href='admin.php?gestion=footer&footer=".$lignes->idFooter."&modifFooter=modif'>Modifier</a></td>");
							echo("<td><a class='bouton_menu' href='gestionFooter.php?page=footer&footer=".$lignes->idFooter."&modifFooter=supprFooter'>Supprimer</a></td>");
						}
						elseif (isset($_GET['modifFooter']) == 'modif')
						{
							// Modifier un footer
							if ($lignes->idFooter == $_GET['footer'])
							{
								echo('<form name="formFooter" action="gestionFooter.php" method="post">');
									echo('<td>Titre : </td>');
									echo('<td class="gris"><input name="footer" class="input_menu" type="text" value="'.utf8_encode($lignes->libelleFooter).'"></td>');
									echo('<td>Lien : </td>');
									echo('<td class="gris"><input name="lien" class="input_menu" type="text" value="'.utf8_encode($lignes->lienFooter).'"></td>');
									echo('<input type="hidden"  name="page"  value="footer">');
									echo('<input type="hidden"  name="idFooter" value="'.$lignes->idFooter.'">');
									echo('<td><input type="submit" name="modifFooter" value="Modifier"></td>');
									echo('<td><input type="submit" name="modifFooter" value="Annuler"></td>');
								echo('</form>');
							}
							else
							{
								echo('<td>Titre : </td>');
								echo('<td class="gris">'.utf8_encode($lignes->libelleFooter).'</td>');
								echo('<td> Lien : </td>');
								echo('<td class="gris">'.utf8_encode($lignes->lienFooter).'</td>');
							}
						}
						echo('</tr>');
					}

					// Ajouter un footer
					if (!isset($_GET['modifFooter']))
					{
						echo('<tr>');
							echo('<form name="formAjoutFooter" action="gestionFooter.php" method="post">');
								echo('<td>Titre : </td>');
								echo('<td><input name="footer" type="text" class="input_menu" type="text"></td>');
								echo('<td>Lien : </td>');
								echo('<td><input name="lien" type="text" class="input_menu"></td>');
								echo('<input type="hidden"  name="page"  value="footer">');
								echo('<td><input type="submit" name="modifFooter" value="Ajouter"></td>');
							echo('</form>');
						echo('</tr>');
					}

					echo('</table>');
				}

				/**************** GESTION DU CARROUSEL ******************/

				elseif (isset($_GET['gestion']) && $_GET['gestion'] == 'carrousel')
				{

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

					$nbImage = count_files('../images/carrousel');

					echo("<span class='titre'>Carrousel</span>");

					if($_GET['error'] == 'extension')
					{
						echo('<br/><br/><span class="attention">Extension autorisée : jpg!</span>');
					}
					elseif($_GET['suppr'] == 'ok')
					{
						echo('<br/><br/><span class="vert">Suppression réussie : si aucun changement, veuillez actualiser la page.</span>');
					}
					elseif($_GET['error'] == 'upload')
					{
						echo('<br/><br/><span class="attention">Echec de l\'upload !</span>');
					}


					echo('<table>');
						echo('<form method="post" action="gestionCarrousel.php?modifCarrousel=ajout" enctype="multipart/form-data"');
							echo('<tr>');
								echo('<td>Ajouter fichier : </td>');
								echo('<td><input type="file" name="fichier"/></td>');
								echo('<td><input type="submit" name="submit" value="Ajouter" /></td>');
							echo('</tr>');
						echo('</form>');
						echo('<tr><td class="espace"></td></tr>');

					for ($i = 1; $i <= $nbImage; $i++)
					{
						echo('<tr>');
							echo('<td>Nom : </td>');
							echo('<td class="gris">img'.$i.'.jpg</td>');
						echo('</tr>');
						echo('<tr>');
							echo('<td>Aperçu : </td>');
							echo('<td class="appercu"><img src="../images/carrousel/img'.$i.'.jpg"></td>');
						echo('</tr>');
						echo('<tr>');
							echo('<td></td>');
							echo("<td><a class='bouton_ordre' href='gestionCarrousel.php?gestion=carrousel&img=".$i."&modifCarrousel=suppr'>Supprimer</a></td>");
						echo('</tr>');
						echo('<tr><td class="espace"></td></tr>');
					}
					echo('</table>');
				}

				/**************** GESTION DES PARTENAIRES *****************/

				elseif(isset($_GET['gestion']) && $_GET['gestion'] == 'partenairesArticles')
				{
					$req = $connexion->prepare("SELECT * FROM articles WHERE idArticle = '". $_GET['articlesPartenaires']."'");
					$req->execute();
					$lignes=$req->fetch(PDO::FETCH_OBJ);

					echo('<form name="formPartenairesArticles" action="gestionPartenaires.php" method="post">');
						echo('<table>');
							echo('<tr>');
								echo('<td>Titre : </td>');
							echo('</tr>');
							echo('<tr>');
								echo('<td><input name="titre" class="input" type="text" value="'.$lignes->titreArticle.'"></td>');
							echo('</tr>');
							echo('<tr></tr>');
							echo('<tr>');
								echo('<td>Contenu :</td>');
							echo('</tr>');
						echo('</table>');
						echo('<textarea name="contenuArticle" class="ckeditor" id="n_text" class="input" cols="150" rows="40">'. $lignes->contenuArticle. '</textarea>');
						echo('<input type="hidden"  name="modifPartenaires"  value="modification">');
						echo('<input type="hidden" name="articlesPartenaires" value='.$lignes->idArticle.'>');
						echo('<input type="submit" name="type" value="Envoyer">');
						echo('<input type="submit" name="type" value="Annuler">');
					echo('</form>');
				}

				elseif (isset($_GET['gestion']) && $_GET['gestion'] == 'partenaires')
				{
					$reqPartenaires=$connexion->prepare("SELECT * FROM partenaires");
					$reqPartenaires->execute();

					$reqPartenairesArticles=$connexion->prepare("SELECT * FROM articles, pages WHERE articles.page = pages.idPage AND libellePage = 'Partenaires'");
					$reqPartenairesArticles->execute();

					echo('<div id="sous_menu">');
						echo('<table>');

							while($lignesPartenairesArticles=$reqPartenairesArticles->fetch(PDO::FETCH_OBJ))
							{	
								echo('<tr>');
								echo('<td>Titre : </td>');
								echo('<td class="gris">'.$lignesPartenairesArticles->titreArticle.'</td>');
								echo('<td><a class="bouton_menu" href="admin.php?gestion=partenairesArticles&modifPartenairesArticles=modif&articlesPartenaires='.$lignesPartenairesArticles->idArticle.'">Modifier</a></td>');
								echo('</tr>');
							}

						echo('</table>');
						echo('<br /><br />');


						echo('<table>');
						while ($lignesPartenaires=$reqPartenaires->fetch(PDO::FETCH_OBJ))
						{	
							echo('<tr>');
							if (!isset($_GET['modifPartenaires']))
							{
								echo('<td>Nom : </td>');
								echo('<td class="gris">'.utf8_encode($lignesPartenaires->libellePartenaire).'</td>');
								echo('<td>Lien : </td>');
								echo('<td class="gris">'.utf8_encode($lignesPartenaires->lienPartenaire).'</td>');
								echo('<td>Image : </td>');
								echo('<td class="gris">'.utf8_encode($lignesPartenaires->imagePartenaire).'</td>');
								echo("<td><a class='bouton_menu' href='admin.php?gestion=partenaires&partenaires=".$lignesPartenaires->idPartenaire."&modifPartenaires=modif'>Modifier</a></td>");
								echo("<td><a class='bouton_menu' href='gestionPartenaires.php?partenaires=".$lignesPartenaires->idPartenaire."&modifPartenaires=supprPartenaires'>Supprimer</a></td>");
							}
							elseif (isset($_GET['modifPartenaires']) == 'modif')
							{
								// Modifier Partenaires
								if ($lignesPartenaires->idPartenaire == $_GET['partenaires'])
								{
									echo('<form name="formModifPartenaires" action="gestionPartenaires.php" method="post" enctype="multipart/form-data">');
										echo('<td>Nom : </td>');
										echo('<td class="gris"><input name="libellePartenaire" class="input_menu" type="text" value="'.utf8_encode($lignesPartenaires->libellePartenaire).'"></td>');
										echo('<td>Lien : </td>');
										echo('<td class="gris"><input name="lienPartenaire" class="input_menu" type="text" value="'.utf8_encode($lignesPartenaires->lienPartenaire).'"></td>');
										echo('<td>Image : </td>');
										echo('<td class="gris"><input name="imagePartenaire" class="input_menu" type="file" value="'.utf8_encode($lignesPartenaires->imagePartenaire).'"</td>');
										echo('<input type="hidden"  name="modif"  value="partenaires">');
										echo('<input type="hidden"  name="idPartenaire"  value="'.$lignesPartenaires->idPartenaire.'">');
										echo('<td><input type="submit" name="modifPartenaires" value="Modifier"></td>');
										echo('<td><input type="submit" name="modifPartenaires" value="Annuler"></td>');
									echo('</form>');
								}

								else
								{
									echo('<td>Nom : </td>');
									echo('<td class="gris">'.utf8_encode($lignesPartenaires->libellePartenaire).'</td>');
									echo('<td> Lien : </td>');
									echo('<td class="gris">'.utf8_encode($lignesPartenaires->lienPartenaire).'</td>');
									echo('<td>Image : </td>');
									echo('<td class="gris">'.utf8_encode($lignesPartenaires->imagePartenaire).'</td>');
								}
							}
							echo('</tr>');
						}

						// Ajouter un partenaires
						if (!isset($_GET['modifPartenaires']))
						{
							echo('<tr>');
								echo('<form name="formAjoutPartenaires" action="gestionPartenaires.php" method="post" enctype="multipart/form-data">');
									echo('<td>Nom : </td>');
									echo('<td><input name="libellePartenaire" type="text" class="input_menu" type="text"></td>');
									echo('<td>Lien : </td>');
									echo('<td><input name="lienPartenaire" type="text" class="input_menu"></td>');
									echo('<td>Image : </td>');
									echo('<td><input name="imagePartenaire" class="input_menu" type="file"</td>');
									echo('<td><input type="submit" name="modifPartenaires" value="Ajouter"></td>');
								echo('</form>');
							echo('</tr>');
						}

						echo('</table>');

					echo('</div>');
				}
			?>
		</div>
	</body>
</html>