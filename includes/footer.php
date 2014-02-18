				<!-- bloc qui affiche le pré-footer -->
				<div id='pre-footer-orange'> 
					<div id='pre-footer'>
						<?php
							$req = "SELECT * FROM prefooter";
							$res = mysql_query($req);
							$ligne = mysql_fetch_array($res);

							echo('<div id="contenu-pre-footer">');

							while($ligne)
							{
								echo(utf8_encode($ligne['contenuPreFooter']));
								$ligne = mysql_fetch_array($res);
							}

							echo('</div>');

						?>
					</div>
				</div>
				
				<!-- bloc du pied de page-->
				<div id='footer'>
					<table>
						<tr>
						<?php
							$req = "SELECT * FROM footer";
							$res = mysql_query($req);
							$ligne = mysql_fetch_array($res);

							while($ligne)
							{
								echo('<td><p><a href="'.$ligne['lienFooter'].'">'.$ligne['libelleFooter'].'</a></p></td>');
								$ligne = mysql_fetch_array($res);
							}
						?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>