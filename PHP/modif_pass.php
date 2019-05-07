<?php
session_start();
include("connexion.php");
//Changement de mot de passe
//on vérifie que le mot de passe entré est le même
if(isset($_POST['password']) AND isset($_POST['newpass']))

    if($_POST['pass'] != $_SESSION['pass']){
        echo '<div id="erreur">Vous avez entre un mauvais mot de passe actuel !</div>';
    }
    else{
        connexion_bd();
            // on enregistre les données
            pg_query("UPDATE users 
                SET "
                //Remplir ICI 
            //Si il y a une erreur
            if (!$mdp) {
                die('Requête invalide : ' . pg_last_error());
            }
            //pas d'erreur d'enregistrement
            else {
                //confirmation et redirection
                echo '<div id="ok">Changement de passe ok. Veuillez vous reconnecter.</div>
                session_destroy();
                exit;
            }      
        close_bd();
        }               
           
    }
?>