<?php

include("connexionbd.php");

// Lancement de la session
session_start();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username']; //recupère le contenu de la variable de session
} else {
  $email="";
}
$dbcon = connexion_bd();
echo $_SESSION['username'];
$query = "SELECT * FROM utilisateur WHERE mail = '".$_SESSION['username']."';"; //requete qui recupère la ligne de l'utilisateur dans la bd
$res = pg_query($dbcon, $query);
$res = pg_fetch_row($res, 0); //on parse le resultat de la requete dans un tableau

//On complete les champs avec le contenu récupéré dans la BD en fonction de ce que contient la variable de session
echo '

<html lang="fr">

		<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="../CSS/style_profil.css" type="text/css" />
				<title>Partag\'Zic</title>
		</head>

		<body>
		<!-- Header -->
				<header id="header">
					<!--	<span class="elem">header</span> -->
					<div id="hautheader">
						<img src="..//IMAGES/favicon.png" id="favicon" />
						<a href="connexion.php">
						<input type="submit" id=\'btnDeconnexion\' value=\'DECONNEXION\'>
						</a>
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
	 			           <li><a href="profil.php">PROFIL</a></li>
	 			       </ul>
	 			     </div>
 			     </nav>
				</header>
				<div id="wrapper">
					<!-- Main -->
                    <form action="../PHP/modification_profil.php" method="POST">
                        <h1>Modification du profil</h1>
                        <b>E-mail</b>
                        <input type="email" value="'.$res[0].'" name="email"><br/>
                        <b>Mot de passe</b>
                        <input type="password" value="'.$res[6].'" name="password" >
                        <b>Confirmation du mot de passe</b>
                        <input type="password" value="'.$res[6].'" name="password_confirm" >
                        <b>Nom</b>
                        <input type="text" value="'.$res[2].'" name="nom" >
                        <b>Prenom</b>
                        <input type="text" value="'.$res[1].'" name="prenom" >
                        <b>Date de naissance</b>
                        <input type="text" value="'.$res[7].'" name="datenaissance" >
                        <br/>
                        <b>Adresse</b>
                        <input type="text" value="'.$res[5].'" name="adresse" >
                        <br/>
                        <b>Code Postal</b>
                        <input type="text" value="'.$res[4].'" name="cp" >
                        <br/>
                        <b>Ville</b>
                        <input type="text" value="'. $res[8].'" name="ville" >
                        <b>Mot de passe</b>
                        <input type="password" placeholder="Entrer votre ancien mot de passe" name="oldPassword" >
                        <input type="submit" id=\'submit\' value=\'Modifier\' >
                    </form>
                </div>

		</body>
</html>';

?>
