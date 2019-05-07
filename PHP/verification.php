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
  $pro = 'T';
  
  if($password = $password_confirm)
     {
      include("connexion.php");
      connexion_bd();
      $insert = pg_query("INSERT INTO utilisateur VALUES ($email, $prenom, $nom, $pro, $cp, $adresse, $password, $datenaissance, $ville)");
     }
?>
