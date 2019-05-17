<?php



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
					<form action="modificationProfil.php" method="POST">
						<p>Nom d'utilisateur</p>
						<input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
						<p>Nouveau mot de passe</p>
						<input type="password" placeholder="Entrer le nouveau mot de passe" name="password" required>
						<p>Confirmation du nouveau mot de passe</p>
						<input type="password" placeholder="Confirmer le nouveau mot de passe" name="password_confirm" required>
						<p>E-mail</p>
						<input type="email" placeholder="Entrer votre email" name="email" required>
						<p>Age</p>
						<input type="text" placeholder="Entrer votre age" name="age" required>
						<p>Vos styles<br></p>
						<select multiple size = 3 id=select>
							<option value="Classique">Classique</option>
							<option value="Rock">Rock</option>
							<option value="Pop">Pop</option>
							<option value="Techno">Techno</option>
						</select>
						<p>Saissiez votre mot de passe actuel</p>
						<input type="password" placeholder="Saisez le mot de passe actuel et validez pour accepter les changements" required>
						<input type="submit" id='submit' value='ACCEPTER LES MODIFICATIONS' >
				</form>
			</div>

					<!-- footer -->
					<footer id="footer">
						<div>
						<input type="submit" id='btnContacter' value='Contact'>
						<input type="submit" id='btnConditions' value='Nos conditions'></div>
					</footer>

		</body>
</html>
