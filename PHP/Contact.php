<?php

  define ("NBRE_CARACTERES","75");
  function afficherContact (){
if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    include("connexionbd.php");
    $dbcon = connexion_bd();
    $query = "SELECT * FROM utilisateur WHERE mail = '{$email}'"; //requete qui recupère la ligne de l'utilisateur dans la bd
    $res = pg_query($dbcon, $query);
    $res = pg_fetch_row($res, 0); //on parse le resultat de la requete dans un tableau
//recupère le contenu de la variable de session
          echo '
            <form action="../PHP/EnvoyerContact.php" method="POST">
                        <h1>Nous contacter</h1>
                        <b>Email</b><br/> 
                        <input type="text" value="' . $res[0] . '" name="email"><br/> 
                        <b>Objet</b>
                        <input type="text" value="' . $res[6] . '" name="objet" >
                        <b>Contenu</b>
                        <input type="text" placeholder="Décrivez votre problème" name="requeteContact" >
                        <input type="submit" id="submit" value="Envoyer">
             </form>
     ';
      } else {
          echo '
            <form action="../PHP/EnvoyerContact.php" method="POST">
                        <h1>Nous contacter</h1>
                        <b>Email</b>
                        <input type="email" placeholder="Votre E-mail" name="email"><br/> 
                        <b>Objet</b>
                        <input type="text" placeholder="Objet de votre demande" name="objet" >
                        <b>Contenu</b>
                        <input type="text" placeholder="Décrivez votre problème" name="requeteContact" >
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
        <!-- On met les critiques générées -->
        <?php  afficherContact();?>
        <!-- On met un bouton pour afficher plus de critiques -->
			</section>
		</div>

					<!-- footer -->
					<footer id="footer">
						<div>
						<input type="submit" id='btnContacter' value='Contact'>
						<input type="submit" id='btnConditions' value='Nos conditions'></div>
					</footer>
		</body>
</html>
