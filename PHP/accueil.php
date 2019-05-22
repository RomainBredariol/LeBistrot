<?php
  // On integre les fonctions de la base de données
  include("connexionbd.php");

  // On regarde si une modification a eu lieu
  if (! empty($_GET['suppression'])){
    $connexion = connexion_bd();
    // On récupère la valeur administration du compte administrateur
    $requete = pg_query($connexion,"delete from critique where id_critique = '".$_GET['suppression']."';");
  }

  // On regarde si une modification a eu lieu
  if (! empty($_GET['acceptation'])){
    $connexion = connexion_bd();
    // On récupère la valeur administration du compte administrateur
    $requete = pg_query($connexion,"update critique set valide = 'TRUE' where id_critique = '".$_GET['acceptation']."';");
  }

  // Définition des constantes
  define ("NBRE_CARACTERES","75");
  function afficherAccueil (){
    // On récupère le parametre du nombre de critiques à afficher
    if (isset($_POST['nbreCritiques']) && ! empty($_POST['nbreCritiques'])){
      $nbreCritiques=$_POST['nbreCritiques'] + 5;
    }else{
      $nbreCritiques=5;
    }
    // Connnexion à la base de données
    $connexion = connexion_bd();
    // On récupère la valeur administration du compte administrateur

  if(isset($_SESSION['username'])) {
          $username=$_SESSION['username'];
      }
      else {
          $username="";
      }
    $requete = pg_query($connexion,"select admin from utilisateur where utilisateur.mail = '".$username."';");
    // Met toutes les reponses dans une liste
    $admin = pg_fetch_array($requete);
    $admin=$admin['admin'];
    // Si l'utilisateur est un administrateur on afffiche les pages avec la possibilité de suppriemr ou de les accepter
    if ( $admin == "t"){
      //On récupère les 5 dernières critiques
      $requete = pg_query($connexion,"select critique.id_critique, critique.titre, critique.corps, critique.date_publication, utilisateur.nom, utilisateur.prenom from critique, utilisateur where utilisateur.mail = critique.mail and critique.valide = 'FALSE' order by date_publication desc limit ".$nbreCritiques.";");
      // Met toutes les reponses dans une liste
      $liste = pg_fetch_all($requete);
      if ( is_array($liste)){
        $taille = count($liste);
      } else {
        echo "</br>Aucune critique n'est à valider !";
      }
      // On parcours et on fait un afffichage
      for ( $cpt = 0 ; $cpt < $taille ; $cpt ++){
        echo '
        <article>
              <header>
                <a href="./afficher_critique.php?id_critique='.$liste[$cpt]['id_critique'].'">
                  <h2>'.$liste[$cpt]['titre'].'</h2>
                </a>
                <p>'.$liste[$cpt]['date_publication'].' par '.$liste[$cpt]['prenom'].' '.$liste[$cpt]['nom'].'</p>
              </header>
              <p>'.substr($liste[$cpt]['corps'],0,NBRE_CARACTERES).'[...] </p>
              <a href="./accueil.php?suppression='.$liste[$cpt]['id_critique'].'">
                <input type="submit" value="Supprimer la critique">
              </a>
              <a href="./accueil.php?acceptation='.$liste[$cpt]['id_critique'].'">
                <input type="submit"value="Accepter la critique">
              </a>
        </article>';
      }
    }else{
      //On récupère les 5 dernières critiques
      $requete = pg_query($connexion,"select critique.id_critique, critique.titre, critique.corps, critique.date_publication, utilisateur.nom, utilisateur.prenom from critique, utilisateur where utilisateur.mail = critique.mail and critique.valide = 'TRUE' order by date_publication desc limit ".$nbreCritiques.";");
      // Met toutes les reponses dans une liste
      $liste = pg_fetch_all($requete);
      $taille = count($liste);
      // On parcours et on fait un afffichage
      for ( $cpt = 0 ; $cpt < $taille ; $cpt ++){
        echo '
        <article>
          <a href="./afficher_critique.php?id_critique='.$liste[$cpt]['id_critique'].'">
              <header>
                <h2>'.$liste[$cpt]['titre'].'</h2>
                <p>'.$liste[$cpt]['date_publication'].' par '.$liste[$cpt]['prenom'].' '.$liste[$cpt]['nom'].'</p>
              </header>
            </a>
          <p>'.substr($liste[$cpt]['corps'],0,NBRE_CARACTERES).'[...] </p>
        </article>';
      }
    }

    echo '
      <form action="./accueil.php" method="POST">
        <input type="hidden" name="nbreCritiques" value="'.$nbreCritiques.'" />
        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="generer" value="Générer plus de critiques">
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
								 <li><a href="Contact.php">CONTACT</a></li>
                                <li><a href="Conditions.php">CONDITIONS</a></li>
								 <!-- affiche le menu profil  -->
								 <?php
								 if (isset($_SESSION['username']))
								 {
									echo '<li><a href="profil.php">PROFIL</a></li>';
									$user= $_SESSION['username'];
									echo "<div align='right'><h3>vous êtes connecté en tant : <font color='red'>$user&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></h3></div>";
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
      			<section class = "rr">
			<!-- sidebar -->
			<aside id="sidebar">
				<h3>Recherche rapide </h3>
				<hr />
				<div>
          			<form name="rechercher" action="rechercher.php" method="post">
                		<input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide" name="texte">
                		<input type="image" src="../IMAGES/loupe.png" width="3%" id="boutonRechercher" value="RECHERCHER">
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
						<li>
							<a href="https://facebook.com"><img src="../IMAGES/fb.png" id="facebook" width="10%"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="https://instagram.com"><img src="../IMAGES/ins.png" id="instagram" width="10%"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="https://twitter.com"><img src="../IMAGES/tw.png" id="twitter" width="12%" /></a>							
						</li>
					</ul>
				</nav>

      			<section class = "rr">
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
		</body>
</html>
