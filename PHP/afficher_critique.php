
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
									echo '<a href="deconnexion.php"><input type="submit" id="btnConnexion" value="DECONNEXION"></a>';
								 }
								 else
								 {
									echo '<a href="connexion.php"><input type="submit" id="btnConnexion" value="CONNEXION"></a>';
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
								 <li><a href="contact.php">CONTACT</a></li>

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
      </br>
      </br>
      </br>
        <!-- On affiche la critique avec toutes les infos correspondantes -->
        <?php

        function afficherCritique ($id){
          if ( isset($_GET['id_critique'])){
            // Connnexion à la base de données
            include("connexionbd.php");
            $connexion = connexion_bd();
            //On récupère les 5 dernières critiques
            $requete = pg_query($connexion,"select critique.titre, critique.corps, critique.date_publication, utilisateur.nom, utilisateur.prenom from critique, utilisateur where utilisateur.mail = critique.mail and critique.id_critique = ".$_GET['id_critique'].";");
						// Met toutes les reponses dans une liste
            $liste = pg_fetch_array($requete);
            echo "<fieldset id='fieldtype'>
                      <legend>".$liste['titre']."</legend>
                      <article>".$liste['corps']."</article>
                  </fieldset>";

            echo "</br>Ecrit par ".$liste['prenom']." ".$liste['nom']."</br>";
						echo "<br><br><h2> Commentaires </h2><br>";
						//On récupère les commentaires sur cette critique
						//$comm = pg_query($connexion,"select * from commenter where id_critique = ".$_GET['id_critique'].";");
						$comm = pg_query("SELECT * FROM commenter WHERE id_critique = '".$_GET['id_critique']."'");
						//Met toutes les réponses dans une liste
						$nbrow = pg_num_rows($comm);
						for ($i=0; $i<$nbrow; $i++) {
								//On récupère chaque ligne des commentaires
								$listecom = pg_fetch_array ($comm, $i, PGSQL_NUM);
								//On récupère le contenu de la critique
								$contenu = $listecom[3];
								//Requête pour l'auteur du commentaire
							  $aut = pg_query("SELECT * FROM utilisateur WHERE mail = (SELECT mail FROM Critique WHERE id_critique = '".$_GET['id_critique']."')");
								//On récupère la ligne
								$arr2 = pg_fetch_array ($aut);
								//nom
								$nom = $arr2[2];
								//prenom
                $prenom=$arr2[1];
								//On affiche le commentaire
            		echo "<fieldset id='fieldtype'>
                      	<article>".$contenu."</article>
												</br>Ecrit par ".$prenom." ".$nom."</br>
                  		</fieldset><br>";
						}

          }
        }






        afficherCritique($_GET['id_critique']);

        ?>
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
                            <button> <a href="contact.php" class ="active">Contact</a> </button>
                            <button> <a href="conditions.php" class ="active">Nos conditons</a> </button>
					</footer>
		</body>
</html>
