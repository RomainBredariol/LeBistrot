<!doctype html>
		<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="../CSS/style_contact.css" type="text/css" />
				<title>Partag'Zic</title>
		</head>

		<body>
		<!-- php associe -->
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
									echo '<a href="connexion.php"><input type="button" id="btnConnexion" value="CONNEXION"></a>';
								 }
								 ?>
						<h1 id="titre">Le bistrot musical, la référence en critique musciale</h1>
					</div>

					<div>
						<!-- nav principale -->
						<nav id="sitenav">
	 			     <div class="container">
	 			       <ul class="links">
								 <li><a href="accueil.php" class ="active">ACCUEIL</a></li>
								 <li><a href="rechercher.php">RECHERCHER</a></li>
								 <li><a href="publier.php">PUBLIER</a></li>
								 
								 <!-- affiche le menu profil  -->
								 <?php
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
                <form>
                    <h1> Nos conditions </h1>
                    <hr/>
<p>Vous pouvez avoir recours à nos services pour toutes sortes de raisons : pour rechercher et partager des données, pour communiquer avec d’autres personnes ou pour créer de nouveaux contenus.
    En partageant vos données avec nous, vous nous permettez d’augmenter la qualité de ces services – en améliorant la pertinence des annonces et des résultats qui vous sont proposés, en vous aidant à établir des contacts ou en accélérant le partage de vos données. Comme vous utilisez nos services, nous souhaitons que vous compreniez comment nous utilisons vos données et de quelles manières vous pouvez protéger votre vie privée.
    Notre politique de confidentialité explique :
    Les données que nous collectons et les raisons de cette collecte ;
    La façon dont nous utilisons ces données ;
    Nous nous efforçons d’être le plus clair possible.
    Toutefois, si vous n’êtes pas familier avec les termes comme témoins, adresses IP, balises pixel et navigateurs, renseignez-vous au préalable sur ces termes clés. Ainsi, que vous soyez un nouveau visiteur ou un habitué, prenez le temps de découvrir notre site et, si vous avez des questions, n’hésitez pas à communiquer avec nous.</p>
                </form><!-- On met un bouton pour afficher plus de critiques -->
			</section>
		</div>

					<!-- footer -->
					<footer id="footer">
						<div>
                            <button> <a href="Contact.php" class ="active">Contact</a> </button>
                            <button> <a href="Conditions.php" class ="active">Nos conditons</a> </button>
					</footer>
		</body>
</html>
