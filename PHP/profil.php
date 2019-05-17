<?php

$email = $_SESSION['username']; //recupère le contenu de la variable de session
include("connexionbd.php");
connexion_bd();
$query = "SELECT * FROM utilisateur WHERE mail = '{$email}'"; //requete qui recupère la ligne de l'utilisateur dans la bd
$res = pg_query($dbconn, $query);
$res = pg_fetch_row($res); //on parse le resultat de la requete dans un tableau

//On complete les chamsavec le contenu récupéré dans la BD en fonction de que contient la variable de session
echo '
                        <b>E-mail</b>
                        <input type="email" value= $res[0] name="email" required><br/> 
                        <b>Mot de passe</b>
                        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                        <b>Confirmation du mot de passe</b>
                        <input type="password" placeholder="Confirmer le mot de passe" name="password_confirm" required>
                        <b>Nom</b>
                        <input type="text" value=$res[2] name="nom" required>
                        <b>Prenom</b>
                        <input type="text" value=$res[1] name="prenom" required>
                        <b>Date de naissance</b>
                        <input type="date" value=$res[7] name="datenaissance" required>
                        <br/>
                        <b>Adresse</b>
                        <input type="Adresse" value=$res[5] name="adresse" required>
                        <br/>
                        <b>Code Postal</b>
                        <input type="CP" value=$res[4] name="cp" required>
                        <br/>
                        <b>Ville</b>
                        <input type="text" value=$res[8] name="ville" required>';

?>
<html lang="fr">

		<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="../CSS/style_profil.css" type="text/css" />
				<title>Partag'Zic</title>
		</head>

		<body>

		<!-- Header -->
				<header id="header">
					<!--	<span class="elem">header</span> -->
					<div id="hautheader">
						<img src="..//IMAGES/favicon.png" id="favicon" />
						<input type="submit" id='btnDeconnexion' value='DECONNEXION'>
						<h1 id="titre">Le bistrot musical, la référence en critique musciale</h1>
					</div>

					<div>
						<!-- nav principale -->
						<nav id="sitenav">
	 			     <div class="container">
	 			       <ul class="links">
                           <li><a href="accueil.php" class ="active">ACCUEIL</a></li>
                           <li><a href="view_rechercher_connecte.php">RECHERCHER</a></li>
                           <li><a href="publier.php">PUBLIER</a></li>
	 			           <li><a href="view_profil.php">PROFIL</a></li>
	 			       </ul>
	 			     </div>
 			     </nav>
				</header>
				<div id="wrapper">
					<!-- Main -->
                    <form action="../PHP/modification_profil.php" method="POST">
                        <h1>Modification du profil</h1>

                        <b>E-mail</b>
                        <input type="email" placeholder="Entrer votre email" name="email" required><br/>
                        <b>Mot de passe</b>
                        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                        <b>Confirmation du mot de passe</b>
                        <input type="password" placeholder="Confirmer le mot de passe" name="password_confirm" required>
                        <b>Nom</b>
                        <input type="text" placeholder="Entrer votre nom" name="nom" required>
                        <b>Prenom</b>
                        <input type="text" placeholder="Entrer votre prénom" name="prenom" required>
                        <b>Date de naissance</b>
                        <input type="date" placeholder="Entrer votre date de naissance" name="datenaissance" required>
                        <br/>
                        <b>Adresse</b>
                        <input type="Adresse" placeholder="Entrer votre adresse" name="adresse" required>
                        <br/>
                        <b>Code Postal</b>
                        <input type="CP" placeholder="Entrer votre code postal" name="cp" required>
                        <br/>
                        <b>Ville</b>
                        <input type="text" placeholder="Entrer votre ville" name="ville" required>
                        Etes-vous un profesionnel ? :<br/>
                        <select name="prof" id="prof">
                            <option value="false">non</option>
                            <option value="true">oui</option>
                            <p>Choisissez vos styles<br></p>
                            <select multiple size = 2 id=select>
                                <option value="Classique">Classique</option>
                                <option value="Rock">Rock</option>
                                <option value="Pop">Pop</option>
                                <option value="Techno">Techno</option>
                            </select>
                            <input type="submit" id='submit' value='Modifier' >
                    </form>

					<!-- footer -->
					<footer id="footer">
						<div>
						<input type="submit" id='btnContacter' value='Contact'>
						<input type="submit" id='btnConditions' value='Nos conditions'></div>
					</footer>

		</body>
</html>
