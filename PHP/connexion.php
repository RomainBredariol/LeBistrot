 <?php

session_start(); // sert à maintenir la $_SESSION

if(isset($_POST['connexion'])) { // si le bouton "Connexion" est appuyé
    
    
    if(empty($_POST['username'])) // vérifie que le champ "Pseudo" n'est pas vide
    {
        echo "Le champ Pseudo est vide.";
    } else {
       
        if(empty($_POST['password'])) { // vérifie maintenant que le champ "Mot de passe" n'est pas vide
            echo "Le champ Mot de passe est vide.";
        } else {
              include("connexion.php");//on se connecte à la base de données
		      connexion_bd();
            
                // requête dans la base de données pour rechercher si ces données correspondent
                $Requete = pg_query($conn,"SELECT * FROM utilisateur WHERE mail = '".$username."' AND mdp = '".$password."'");//Pas username dans la table, j'ai mis le mail en attendant
            
                // si il y a un résultat, pg_num_rows() nous donnera 1
                // si pg_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                if(pg_num_rows($Requete) == 0) {
                    echo "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                } else {
                    // on ouvre la session avec $_SESSION:
                    $_SESSION['username'] = $username;
                    echo "Vous êtes à présent connecté !";
                }
            }
        }
    }
}
?>
