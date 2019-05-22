<?php
	//verification si deja connecté
	session_start();
	if (isset($_SESSION['username']))
	{
		header("Location:accueil.php");
	}
								 
		include("connexionbd.php");
		connexion_bd();
    //On selectionne les données
		$password= $_POST['password'];
		$password= sha1($password);
		$index = pg_query("SELECT * FROM utilisateur WHERE mail='".$_POST['username']."' AND mdp='".$password."'");
?>

<html>
<meta charset="utf-8">
<link rel="stylesheet" href="../CSS/style_connexion.css" type="text/css" />

<title>Partag'Zic</title>

<head>

</head>

<body>
<header id="header">
    <!--	<span class="elem">header</span> -->
    <div id="hautheader">
        <img src="..//IMAGES/favicon.png" id="favicon" />
		<a href="inscription.php">
        <input type="submit" id='btnInscription' value='INSCRIPTION'>
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
                    <li><a href="Contact.php">CONTACT</a></li>
                    <li><a href="Conditions.php">CONDITIONS</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<div id="container">
<form action="../PHP/connexion.php" method="POST">

<?php
//partie connexion
//si pas de résultat
		$retour = $_POST['retour'];
		if(pg_num_rows($index) == 0)
		{
			if($retour == 1)
			{
			echo "<center><h3><font color='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mauvais nom d'utilisateur ou mot de passe !</font></h3></center>";
			
			}
		}
 //si résultat
		else
		{
             //on créer la session
			session_start();
			$username = $_POST['username'];
			$_SESSION['username'] = $_POST['username'];
                    //on redirige
			echo 'Vous êtes connecté en tant que :';
			echo $username;
			header("Location:accueil.php");
		}
		$retour = 1;
?>

    <!-- zone de connexion -->
    
        <h1>Connexion</h1>

        <b>Nom d'utilisateur</b>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
        <b>Mot de passe</b>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
		<!-- retour mauvais mdp -->
		<input type="hidden" name="retour" value="1" >
        <input type="submit" id='test' value='CONNEXION' >
        Vous n'avez pas de compte ?
        <a href="inscription.php" class ="active">S'enregistrer</a>
    </form>
</div>

</body>

</html>

