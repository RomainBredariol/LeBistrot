<?php
		include("connexionbd.php");
		connexion_bd();
    //On selectionne les données
		$index = pg_query("SELECT * FROM utilisateur WHERE mail='".$_POST['username']."' AND mdp='".$_POST['password']."'");
    //si pas de résultat
		if(pg_num_rows($index) == 0)
		{
			echo 'Mauvais nom d utilisateur ou mot de passe!';
		}
 //si résultat
		else{
             //on créer la session
			session_start();
			$username = $_POST['username'];
			$_SESSION['username'] = $_POST['username'];
                    //on redirige
			echo 'Vous êtes connecté en tant que :';
			echo $username;
			header("Location:administration.php");
		}
?>