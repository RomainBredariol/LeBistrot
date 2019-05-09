<?php session_start(); ?>

<!DOCTYPE html>
 <html>
  <head>
   <meta charset="UTF-8" />
   <title>Identification erronee</title>
   <link rel="stylesheet" type="text/css" href="" />
  </head>

  <body>
   <!-- Affichage entete -->
   <?php 
     $_SESSION = array(); // Réinitialisation du tableau de session
     session_destroy();   // Destruction de la session
     unset($_SESSION);    // Destruction du tableau de session
     include("entete.html");
   ?>
   <section>
    <p>
     <br />
     <em><strong>TEST</strong></em>
     <br />
    </p>
    <br />
    <p class="erreur">Mot de passe non saisi ou erronee; !!!</p>
    <br />
    <hr />
   </section>
   <footer>
    <p><a href="./HTML/Index.html">Retour a l'accueil</a></p>
    <p><a href="login_form.php">Retour à l'indentification</a></p>
   </footer>
  </body>
 </html>
