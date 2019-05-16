<?php

  define ("NBRE_CARACTERES","75");
  function afficherAccueil (){
    // Connnexion à la base de données
    include("connexionbd.php");
    $connexion = connexion_bd();
    //On récupère les 5 dernières critiques
    $requete = pg_query($connexion,"select critique.titre, critique.corps, critique.date_publication, utilisateur.nom from critique, utilisateur where utilisateur.mail = critique.mail order by date_publication desc limit 5;");
    // Met toutes les reponses dans une liste
    $liste = pg_fetch_all($requete);
    $taille = count($liste);
    // On parcours et on fait un afffichage
    for ( $cpt = 0 ; $cpt < $taille ; $cpt ++){
      echo '
      <article>
        <a href="">
            <header>
              <h2>'.$liste[$cpt]['titre'].'</h2>
              <p>'.$liste[$cpt]['date_publication'].' par '.$liste[$cpt]['nom'].'</p>
            </header>
          </a>
        <p>'.substr($liste[$cpt]['corps'],0,NBRE_CARACTERES).'[...] </p>
      </article>';
    }
  }

?>


<!doctype html>

	<form lang="fr">
		<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="../CSS/style_accueil.css" type="text/css" />
				<title>Partag'Zic</title>
		</head>

		<body>
		<!-- php associe -->
				<form action="/PHP/accueil.php" method="POST">
				<!-- Header -->
				<header id="header">
					<div id="hautheader">
						<img src="..//IMAGES/favicon.png" id="favicon" />
						<a href="view_connexion.html">
							<input type="button" id='btnConnexion' value='CONNEXION'>
						</a>
						<h1 id="titre">Le bistrot musical, la référence en critique musciale</h1>
					</div>

					<div>
						<!-- nav principale -->
						<nav id="sitenav">
	 			     <div class="container">
	 			       <ul class="links">
								 <li><a href="../HTML/view_accueil.html" class ="active">ACCUEIL</a></li>
								 <li><a href="view_rechercher_connecte.html">RECHERCHER</a></li>
								 <li><a href="../HTML/view_publier.html">PUBLIER</a></li>
	 			       </ul>
	 			     </div>
 			     </nav>
					</div>
				</header>

		<div id="wrapper">
			<!-- Main -->
			<section id="main">
        <!-- On met les critiques générées -->
        <?php  afficherAccueil();?>
        <!-- On met un bouton pour afficher plus de critiques -->
			</section>


			<!-- sidebar -->
			<aside id="sidebar">
				<h3>Recherche rapide </h3>
				<hr />
				<div>
					<input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide">
					<button>RECHERCHER</button>
				</div>
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
				</form>
		</body>
</form>
</html>
