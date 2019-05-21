<?php

  define ("NBRE_CARACTERES","75");
  function afficherAccueil (){
    // On récupère le parametre du nombre de critiques à afficher
    if (isset($_POST['nbreCritiques']) && ! empty($_POST['nbreCritiques'])){
      $nbreCritiques=$_POST['nbreCritiques'] + 5;
    }else{
      $nbreCritiques=5;
    }
    // Connnexion à la base de données
    include("connexionbd.php");
    $connexion = connexion_bd();
    //On récupère les 5 dernières critiques
    $requete = pg_query($connexion,"select critique.titre, critique.corps, critique.date_publication, utilisateur.nom, utilisateur.prenom from critique, utilisateur where utilisateur.mail = critique.mail order by date_publication desc limit ".$nbreCritiques.";");
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
              <p>'.$liste[$cpt]['date_publication'].' par '.$liste[$cpt]['prenom'].' '.$liste[$cpt]['nom'].'</p>
            </header>
          </a>
        <p>'.substr($liste[$cpt]['corps'],0,NBRE_CARACTERES).'[...] </p>
      </article>';
    }
    echo '
      <form style="width:175px;border:1px;solid #f1f1f1;border-radius:5px;margin:1em;padding:1em;background:#fff" action="./accueil.php" method="POST">
        <input type="hidden" name="nbreCritiques" value="'.$nbreCritiques.'" />
        <input type="submit" name="generer" value="Générer plus de critiques">
      </form>';
  }
  ?>


<!doctype html>

		<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="../CSS/style_accueil.css" type="text/css" />
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
        <!-- On met les critiques générées -->
        <?php  afficherAccueil();?>
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
                            <button> <a href="Contact.php" class ="active">Contact</a> </button>
                            <button> <a href="Conditions.php" class ="active">Nos conditons</a> </button>
					</footer>
		</body>
</html>
