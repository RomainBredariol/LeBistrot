
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
 						<!-- nav  -->
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
      </div>
      </div>

 		<div id="wrapper">
 			<!-- Main -->
 			<section id="main" class="main">
 <div id="form">
 				<div id="divRecherche">
 					<b>RECHERCHE</b>
 					<form name="rechercher" action="rechercher.php" method="post">
 						<input type="search" placeholder="Artiste, album, titre, date, auteur..." id="textRecherche" name="texte">
 						<input type="submit" id="boutonRechercher" value="RECHERCHER">
 					</form>

        </div>


          <?php

          function affichagecritique($index){
            $nbrow = pg_num_rows($index);
            for ($i=0; $i<$nbrow; $i++) {

                //A modifier a termes
                $arr = pg_fetch_array ($index, $i, PGSQL_NUM);
                //-------------------
                $titre = $arr[1];
                $date = $arr[3];
                $contenu = $arr[2];
                $idcrit = $arr[0];
                $aut = pg_query("SELECT * FROM utilisateur WHERE mail = (SELECT mail FROM Critique WHERE id_critique = '$idcrit')");
                $arr2 = pg_fetch_array ($aut);
                $nom = $arr2[2];
                $prenom=$arr2[1];



                echo '
                <article>
                  <a href="./afficher_critique.php?id_critique='.$idcrit.'">
                      <header>
                        <h2>'.$titre.'</h2>
                        <p>'.$date.' par '.$prenom.' '.$nom.'</p>
                      </header>
                    </a>
                  <p>'.$contenu.'</p>
                </article>';

            }
          }

          echo "<head>";
          echo '<meta charset="utf-8">';
          echo "</head>";

          //Récupération des données du formulaire de recherche

          if(isset($_POST['texte'])) {
              $recherch=$_POST['texte'];
          }
          else {
              $recherch="";
          }
          // echo "Voici votre recherche : ".$recherch;

          //Connexion à la base de données
          include("connexionbd.php");
          connexion_bd();
          //Recherche par nom d'Artiste
          //On regarde si il y a des Critiques qui portent sur des albums de cet utilisateur
          //Seulement les critiques avec le champs id_album != null seront affichées ici
          $listealb = pg_query("SELECT id_album FROM album WHERE id_artiste = (SELECT id_artiste FROM artiste WHERE upper(nom_artiste) = upper('$recherch'))");
          $nul = 0;
          //On sépare le résultat de la requête ci dessus pour traiter les lignes une par une
          for ($i=0; $i < pg_num_rows($listealb); $i++) {
            //On récupère les informations de la ligne
            $val = pg_fetch_array ($listealb, $i, PGSQL_NUM);
            //On va chercher les critiques qui correspondent au n° d'album que l'on a extrait précedemment
            $index = pg_query("SELECT * FROM Critique WHERE id_album = '$val[0]'");
            //Chaque fois, si le résultat de cette requête est != null, on incrémente $nul
            if (pg_num_rows($index) != 0){
              $nul++;
            }
            //Appel de la fonction d'affichage des critiques
            affichagecritique($index);
          }

          //Si le nom que l'on a rentré n'est pas un nom d'artiste
          if ($nul == 0){
            //Cette requete permet de sélectionner les critiques dont le nom d'album est recherché
            $index = pg_query("SELECT * FROM Critique WHERE id_album = (SELECT id_album FROM album WHERE upper(nom) = upper('$recherch'))");
            //Si le nom que l'on a rentré n'est pas un nom d'album
            if (pg_num_rows($index) == 0) {
              //Cette requête permet de sélectionner les critiques dont le nom de la chanson est recherché
              $index = pg_query("SELECT * FROM Critique WHERE id_musique = (SELECT id_musique FROM titre_musical WHERE upper(nom_musique) = upper('$recherch'))");
              //Si le nom que l'on a rentré n'est pas un titre de musique
              if (pg_num_rows($index) == 0) {
                //Cette requête permet de sélectionner lescritiques dont la date de publication est recherchée
                $index = @pg_query("SELECT * FROM Critique WHERE date_publication = '$recherch'");
                //Appel de la fonction d'affichage des critiques
                @affichagecritique($index);
                //Si la recherche ne correpond à rien
                if (@pg_num_rows($index) == 0){
                  echo "<h2> Aucun résultat pour votre recherche...</h2>";
                }
              }
              else{
                //Appel de la fonction d'affichage des critiques
                affichagecritique($index);
              }
            }
            else {
              //Appel de la fonction d'affichage des critiques
              affichagecritique($index);
            }
          }
?>

          </section>
<section class = "rr">
          <!-- sidebar -->
          <aside id="sidebar">
            <h3>Recherche rapide </h3>
            <hr />
            <div>
              <form name="rechercher" action="rechercher.php" method="post">
      				      <input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide" name="texte">
      				      <input type="submit" id="boutonRechercher" value="RECHERCHER">
              </form>
            </div>
            <br>
              <h3>Nombre de pages visités</h3>
            <hr />
            <?php
				include("compteur.php");
				$vue=compteur();
				echo "<p>Il y a eu $vue visites sur le site</p>";
				?>
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
          </section>
            <!-- footer -->
            <footer id="footer">
                <div>
                    <button> <a href="contact.php" class ="active">Contact</a> </button>
                    <button> <a href="conditions.php" class ="active">Nos conditons</a> </button>
                </div>
            </footer>

 		</body>

 </html>

