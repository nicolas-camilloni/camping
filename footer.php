<footer>
		<section id="containerfooter">
			<section id="cfooterlogo">
				<article id="footerlogo">
					<img id="logocampingfooter" src="img/logocamping.png">
				</article>
			</section>
			<section id="cfootermenu">
				<article id="footermenu">
					<article id="titremenu">
						Navigation
					</article>
					<ul>
                    <nav>
                        <a href="index.php"><li>Accueil</li></a>
                        <?php if(!isset($_SESSION['login'])){ ?>
                        <a href="inscription.php"><li>Inscription</li></a>
                        <a href="connexion.php"><li>Connexion</li></a>
                        <?php } if(isset($_SESSION['login'])){ ?>
                        <a href="profil.php"><li>Mon compte</li></a>
                        <?php } ?>
                        <a href="planning.php"><li>Planning</li></a>
                    </nav>
					</ul>
				</article>
			</section>
			<section id="cfooterreseaux">
				<section id="footerreseaux">
					<article id="tableaufooter">
						<table>
							<tbody>
								<tr>
									<td><img src="img/adressef.png"></td>
									<td>4 rue des cocotiers jaunes<br />
									13000 Marseille</td>
								</tr>
								<tr>
									<td><img src="img/telf.png"></td>
									<td>+33 (0) 4 90 54 23 13</td>
								</tr>
								<tr>
									<td><img src="img/mailf.png"></td>
                                    <td>campigo@gmail.com</td>
								</tr>
							</tbody>
						</table>
					</article>
					<section id="boutonreseaux">
						<article id="footertwitter">
						</article>
						<article id="footeryoutube">
						</article>
						<article id="footerfacebook">
						</article>
					</section>
				</section>
			</section>
		</section>
		<section id="containercopyright">
			<article id="copyright">
				Copyright 2020 - La Plateforme | Nicolas & Thierry
		</section>
	</footer>