<?php
  $username =   $_POST['username'];
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];
  $email = $_POST['email'];
  $datenaissance = $_POST['datenaissance'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $adresse = $_POST['adresse'];
  $cp = $_POST['cp'];
  $ville = $_POST['ville'];
  $profes = 'TRUE';
  
  if($password == $password_confirm)
     {
      include("connexionbd.php");
      connexion_bd();
      $insert = pg_query("INSERT INTO utilisateur (mail, prenom, nom, professionnel, cp, adresse, mdp, date_de_naissance, ville) VALUES ('$email', '$prenom', '$nom', '$profes', '$cp', '$adresse', '$password', '$datenaissance', '$ville')");
     }
  else
  {
	  echo "Les mots de passes ne correspondent pas";//mauvais mot de passe
  }
?>
