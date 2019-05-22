<?php
  // Lancement de la session
  session_start();
  // Les includes
  include("connexionbd.php");
  // Constantes
  define ("NBRE_CARACTERES","75");

  // Si une suppression a eu lieu
  if ( ! empty($_GET['suppression'])){
    $connexion = connexion_bd();
    // On récupère la valeur administration du compte administrateur
    $requete = pg_query($connexion,"delete from contact where id_contact = '".$_GET['suppression']."';");
  }

  function afficherContact (){
    if (isset($_SESSION['username'])) {
      // Connnexion à la base de données
      $connexion = connexion_bd();
      // On récupère la valeur administration du compte administrateur
      $requete = pg_query($connexion,"select admin from utilisateur where utilisateur.mail = '".$_SESSION['username']."';");
      // Met toutes les reponses dans une liste
      $admin = pg_fetch_array($requete);
      $admin=$admin['admin'];
      // Si l'utilisateur est un administrateur on afffiche les pages avec la possibilité de suppriemr ou de les accepter
      if ( $admin == "t"){
        $query = "SELECT contact.id_contact, contact.objet, contact.message, contact.email FROM contact"; //requete qui recupère la ligne de l'utilisateur dans la bd
        $liste = pg_query($connexion, $query);
        $liste = pg_fetch_all($liste);
        // ON vérifie que le retour est un tableau
        $taille = 0;
        if ( is_array($liste)){
          $taille = count($liste);
        } else {
          echo "</br> Aucun message, tout va bien !";
        }
        // On parcours et on fait un afffichage
        for ( $cpt = 0 ; $cpt < $taille ; $cpt ++){
          echo '
          <article>
                <header>
                  <h2>'.$liste[$cpt]['objet'].'</h2>
                </header>
                <p>'.$liste[$cpt]['message'].'</br> par '.$liste[$cpt]['mail'].'</p>
                <a href="./contact.php?suppression='.$liste[$cpt]['id_contact'].'">
                  <input type="submit" value="Supprimer le message">
                </a>
          </article>';
        }


      } else {
        $query = "SELECT * FROM utilisateur WHERE mail = '".$_SESSION['username']."';"; //requete qui recupère la ligne de l'utilisateur dans la bd
        $result = pg_query($connexion, $query);
        //on parse le resultat de la requete dans un tableau

        $res = pg_fetch_row($result, 0);
        //recupère le contenu de la variable de session
        echo '
        <form action="../PHP/EnvoyerContact.php" method="POST">
                    <h1>Nous contacter</h1>
                    <b>Email</b><br/>
                    <input type="text" value="' . $res[0] . '" name="email"><br/>
                    <b>Objet</b>
                    <input type="text" value="" name="objet" >
                    <b>Contenu</b>
                    <textarea placeholder="Quel est votre problème ?" id="areacontenu" name="message"></textarea>
                    <input type="submit" id="submit" value="Envoyer">
         </form>
        ';
      }



      } else {
          echo '
            <form action="../PHP/EnvoyerContact.php" method="POST">
                        <h1>Nous contacter</h1>
                        <b>Email</b>
                        <input type="text" placeholder="Votre E-mail" name="email" required><br/>
                        <b>Objet</b>
                        <input type="text" placeholder="Objet de votre demande" name="objet" required>
                        <b>Contenu</b><br/>
                        <textarea placeholder="Quel est votre problème ?" id="areacontenu" name="message" required></textarea>
                        <input type="submit" id="submit" value="Envoyer">
             </form>
     ';
      }
    }
  ?>


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
                <br>
        <?php  afficherContact();?>
        <!-- On met un bouton pour afficher plus de critiques -->
			</section>
		</div>
		</body>
</html>
