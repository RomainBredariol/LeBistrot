<!doctype html>
<html lang="fr">

		<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="../CSS/style_rechercher.css" type="text/css" />
				<title>Partag'Zic</title>
		</head>

		<body>

		<!-- Header -->
				<header id="header">
					<div id="hautheader">
						<img src="..//IMAGES/favicon.png" id="favicon" />
						
						<!-- affiche le bouton connexion ou deconnexion en fonction de si on est connecté ou pas -->
								<?php
								 session_start();
								 if (isset($_SESSION['username']))
								 {
									echo '<a href="deconnexion.php"><input type="button" id="btnConnexion" value="DECONNEXION"></a>';
								 }
								 else
								 {
									echo '<a href="connexion.php"><input type="button" id="btnConnexion" value="DECONNEXION"></a>';
								 }
								 ?>
								 
						<h1 id="titre">Le bistrot musical, la référence en critique musciale</h1>
					</div>

					<div>
						<!-- nav  -->
						<nav id="sitenav">
	 			     <div class="container">
	 			       <ul class="links">
                           <li><a href="accueil.php" class ="active">ACCUEIL</a></li>
								 <li><a href="view_rechercher_connecte.php">RECHERCHER</a></li>
								 <li><a href="publier.php">PUBLIER</a></li>
								 
								 <!-- affiche le menu profil  -->
								 <?php
								 session_start();
								 if (isset($_SESSION['username']))
								 {
									echo '<li><a href="profil.php">PROFIL</a></li>';
								 }
								 ?>
	 			       </ul>
	 			     </div>
 			     </nav>
					</div>
				</header>

		<div id="wrapper">
			<!-- Main -->
			<section id="main">
<div id="form">
				<div id="divRecherche">
					<b>RECHERCHE</b>
					<input type="search" placeholder="Artiste, album, titre, date, auteur..." id="textRecherche">
					<input type="button" id="boutonRechercher" value="RECHERCHER">
				</div>
</div>

				<article>
					<header>
						<h2>Nom CRITIQUE</h2>
						<p>Date de publication, auteur</p>
					</header>

					<p>Contenu de la critique </p>

					<aside>
						<p>Espace commentaire</p>
					</aside>


				</article>
			</section>

			<!-- sidebar -->
			<aside id="sidebar">
				<h3>Recherche rapide </h3>
				<hr />
				<div>
					<input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide">
					<button>RECHERCHER</button>
				</div>
				<br>
				<h3>Statistiques du site</h3>
				<hr />
				<p> Il y a eu X visites sur le site</p>
				<br>
				<h3>Nous suivre sur les réseaux</h3>
				<hr />
				<nav>
					<ul>
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Snapchat</a></li>
						<li><a href="#">Instagram</a></li>
					</ul>
				</nav>

			</aside>
		</div>

					<!-- footer -->
					<footer id="footer">
						<div>
						<input type="submit" id='btnContacter' value='Contact'>
						<input type="submit" id='btnConditions' value='Nos conditions'></div>
					</footer>

		</body>
</html>
