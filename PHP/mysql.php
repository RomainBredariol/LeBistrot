<?php
/* Script de connexion à la base R6 et Connexion */

  $id_bd = mysqli_connect( 'fdb15.eohost.com','2245390_rambow6' ,'laurentfavre12' ,'2245390_rambow6')
    or die("Connexion au serveur et/ou à la base de données impossible");

  /* Gestion de l'encodage des caractères */
  mysqli_query($id_bd, "SET NAMES 'utf8'");

?>
