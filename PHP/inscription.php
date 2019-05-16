<?php
 
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];
  $email = $_POST['email'];
  $datenaissance = $_POST['datenaissance'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $adresse = $_POST['adresse'];
  $cp = $_POST['cp'];
  $ville = $_POST['ville'];
  $profes = $_POST['prof'];
  
  if($password == $password_confirm)
  {
      include("connexionbd.php");
      connexion_bd();
	  $insert = pg_query("SELECT mail FROM utilisateur WHERE mail = $email");
	  if (count($insert) > 0)
	  {
		  echo "Le mail existe deja";
	  }
	  else
	  {
		$insert = pg_query("INSERT INTO utilisateur (mail, prenom, nom, professionnel, cp, adresse, mdp, date_de_naissance, ville) VALUES ('$email', '$prenom', '$nom', '$profes', '$cp', '$adresse', '$password', '$datenaissance', '$ville')");
	  }
  }
  else
  {
	  echo "Les mots de passes ne correspondent pas";//mauvais mot de passe
  }
?>
