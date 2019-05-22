
include "connexionbd.php";
include "fonctions.php";
session_start();
//connexion à la db
$dbcon = connexion_bd();

//    //si le bouton commente est presse et que le commentaire n'est pas vide
    if(isset($_POST["btnCommenter"]) && isset($_POST["areacommentaire"])){
        commenter($dbcon);
    }

    //ajoute un commentaire à la critique
    function commenter($dbcon){

        //on recupere le max des id_commentaire dans la table commentaire
        $nb = pg_query($dbcon, "Select max(id_commentaire) as nb from commenter;");
        $nb_commentaire = pg_fetch_array($nb);

        //affectation des variables
        $id_commentaire = ((int) $nb_commentaire["nb"])+1;
        $mail = $_SESSION["username"];
        $id_critique = $_GET["id_critique"];
        $contenu = enleverCaracteresSpeciaux($_POST["areacommentaire"]);
        $date = date("Y-m-d");

        //on insere le commentaire dans la table commentaire
        pg_query($dbcon, "Insert into commenter values ($id_commentaire, '$mail', $id_critique, '$contenu', '$date');");
    }

function afficherCritique($dbcon)
{
    if (isset($_GET['id_critique'])) {

        //On récupère les 5 dernières critiques
        $requete = pg_query($dbcon, "select critique.titre, critique.corps, critique.date_publication, 
                    utilisateur.nom, utilisateur.prenom from critique, utilisateur where utilisateur.mail = critique.mail 
                    and critique.id_critique = " . $_GET['id_critique'] . ";");

        // Met toutes les reponses dans une liste
        $liste = pg_fetch_array($requete);
        echo "<fieldset id='fieldtype'>
                      <legend>" . $liste['titre'] . "</legend>
                      <article>" . $liste['corps'] . "</article>
                  </fieldset>";

        echo "</br>Ecrit par " . $liste['prenom'] . " " . $liste['nom'] . "</br>";
    }
}

function afficherCommentaire($dbcon)
{
    if (isset($_GET['id_critique'])) {
        //On récupère les commentaires sur cette critique
        $comm = pg_query($dbcon, "SELECT * FROM commenter WHERE id_critique = '" . $_GET['id_critique']. "' order by date_commentaire desc");
        //Met toutes les réponses dans une liste
        $nbrow = pg_num_rows($comm);
        for ($i = 0; $i < $nbrow; $i++) {
            //On récupère chaque ligne des commentaires
            $listecom = pg_fetch_array($comm, $i, PGSQL_NUM);
            //On récupère le contenu de la critique
            $contenu = $listecom[3];
            //Requête pour l'auteur du commentaire
            $aut = pg_query("SELECT * FROM utilisateur WHERE mail = (SELECT mail FROM Critique WHERE id_critique = '" . $_GET['id_critique'] . "')");
            //On récupère la ligne
            $arr2 = pg_fetch_array($aut);
            //nom
            $nom = $arr2[2];
            //prenom
            $prenom = $arr2[1];
            //On affiche le commentaire
            echo "<fieldset id='fieldtype'>
                      	<article>" . $contenu . "</article>
												</br>Ecrit par " . $prenom . " " . $nom . "</br>
                  		</fieldset><br>";
        }
    }

}


?>


<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/style_accueil.css" type="text/css"/>
    <title>Partag'Zic</title>
</head>

        ?>
      <!-- On met un bouton pour afficher plus de critiques -->
			</section>


			<!-- sidebar -->
			<aside id="sidebar">
				<h3>Recherche rapide </h3>
				<hr />
				<div>
					<input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide">
					<button>RECHERCHER</button>
				</div>
				<h3>Statistiques du site</h3>
				<hr />
				<p> Il y a eu X visites sur le site</p>
				<br>
				<h3>Nous suivre sur les réseaux</h3>
				<hr />
				<nav>
					<ul>
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Snapchat</a></li>
						<li><a href="#">Instagram</a></li>
					</ul>
				</nav>


					<!-- footer -->
					<footer id="footer">
						<div>
                            <button> <a href="Contact.php" class ="active">Contact</a> </button>
                            <button> <a href="Conditions.php" class ="active">Nos conditons</a> </button>
					</footer>
		</body>
</html>

include "connexionbd.php";
include "fonctions.php";
session_start();
//connexion à la db
$dbcon = connexion_bd();

//    //si le bouton commente est presse et que le commentaire n'est pas vide
    if(isset($_POST["btnCommenter"]) && isset($_POST["areacommentaire"])){
        commenter($dbcon);
    }

    //ajoute un commentaire à la critique
    function commenter($dbcon){

        //on recupere le max des id_commentaire dans la table commentaire
        $nb = pg_query($dbcon, "Select max(id_commentaire) as nb from commenter;");
        $nb_commentaire = pg_fetch_array($nb);

        //affectation des variables
        $id_commentaire = ((int) $nb_commentaire["nb"])+1;
        $mail = $_SESSION["username"];
        $id_critique = $_GET["id_critique"];
        $contenu = enleverCaracteresSpeciaux($_POST["areacommentaire"]);
        $date = date("Y-m-d");

        //on insere le commentaire dans la table commentaire
        pg_query($dbcon, "Insert into commenter values ($id_commentaire, '$mail', $id_critique, '$contenu', '$date');");
    }

function afficherCritique($dbcon)
{
    if (isset($_GET['id_critique'])) {

        //On récupère les 5 dernières critiques
        $requete = pg_query($dbcon, "select critique.titre, critique.corps, critique.date_publication, 
                    utilisateur.nom, utilisateur.prenom from critique, utilisateur where utilisateur.mail = critique.mail 
                    and critique.id_critique = " . $_GET['id_critique'] . ";");

        // Met toutes les reponses dans une liste
        $liste = pg_fetch_array($requete);
        echo "<fieldset id='fieldtype'>
                      <legend>" . $liste['titre'] . "</legend>
                      <article>" . $liste['corps'] . "</article>
                  </fieldset>";

        echo "</br>Ecrit par " . $liste['prenom'] . " " . $liste['nom'] . "</br>";
    }
}

function afficherCommentaire($dbcon)
{
    if (isset($_GET['id_critique'])) {
        //On récupère les commentaires sur cette critique
        $comm = pg_query($dbcon, "SELECT * FROM commenter WHERE id_critique = '" . $_GET['id_critique']. "' order by date_commentaire desc");
        //Met toutes les réponses dans une liste
        $nbrow = pg_num_rows($comm);
        for ($i = 0; $i < $nbrow; $i++) {
            //On récupère chaque ligne des commentaires
            $listecom = pg_fetch_array($comm, $i, PGSQL_NUM);
            //On récupère le contenu de la critique
            $contenu = $listecom[3];
            //Requête pour l'auteur du commentaire
            $aut = pg_query("SELECT * FROM utilisateur WHERE mail = (SELECT mail FROM Critique WHERE id_critique = '" . $_GET['id_critique'] . "')");
            //On récupère la ligne
            $arr2 = pg_fetch_array($aut);
            //nom
            $nom = $arr2[2];
            //prenom
            $prenom = $arr2[1];
            //On affiche le commentaire
            echo "<fieldset id='fieldtype'>
                      	<article>" . $contenu . "</article>
												</br>Ecrit par " . $prenom . " " . $nom . "</br>
                  		</fieldset><br>";
        }
    }

}


?>


<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/style_accueil.css" type="text/css"/>
    <title>Partag'Zic</title>
</head>

<body>
<!-- php associe -->
<!-- Header -->
<header id="header">
    <div id="hautheader">
        <img src="..//IMAGES/favicon.png" id="favicon"/>
        <a href="connexion.php">
            <input type="button" id='btnConnexion' value='CONNEXION'>
        </a>
        <h1 id="titre">Le bistrot musical, la référence en critique musciale</h1>
    </div>

    <div>
        <!-- nav principale -->
        <nav id="sitenav">
            <div class="container">
                <ul class="links">
                    <li><a href="accueil.php" class="active">ACCUEIL</a></li>
                    <li><a href="view_rechercher_connecte.php">RECHERCHER</a></li>
                    <li><a href="publier.php">PUBLIER</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<div id="wrapper">
    <!-- Main -->
    <section id="main">
        </br>
        </br>
        </br>
        <!-- On affiche la critique avec toutes les infos correspondantes -->
        <?php
            afficherCritique($dbcon);
        ?>
      <!-- On met un bouton pour afficher plus de critiques -->
			</section>

        <!-- Commentaires -->
        <br><br>
        <h2> Commentaires </h2><br>
        <?php
            $lien = "afficher_critique.php?id_critique=".$_GET["id_critique"];
        ?>
        <form action="<?php echo $lien; ?>" method="POST">
            <textarea placeholder="Commentez" id="areatitre" name="areacommentaire"></textarea><br>
            <input type="submit" name="btnCommenter" value="COMMENTER"><br><br>
        </form>

			<!-- sidebar -->
			<aside id="sidebar">
				<h3>Recherche rapide </h3>
				<hr />
				<div>
					<input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide">
					<button>RECHERCHER</button>
				</div>
				<h3>Statistiques du site</h3>
				<hr />
				<p> Il y a eu X visites sur le site</p>
				<br>
				<h3>Nous suivre sur les réseaux</h3>
				<hr />
				<nav>
					<ul>
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Snapchat</a></li>
						<li><a href="#">Instagram</a></li>
					</ul>
				</nav>
        <?php
            afficherCommentaire($dbcon);
        ?>


					<!-- footer -->
					<footer id="footer">
						<div>
                            <button> <a href="Contact.php" class ="active">Contact</a> </button>
                            <button> <a href="Conditions.php" class ="active">Nos conditons</a> </button>
					</footer>
		</body>

    </section>


    <!-- sidebar -->
    <aside id="sidebar">
        <h3>Recherche rapide </h3>
        <hr/>
        <div>
            <input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide">
            <button>RECHERCHER</button>
        </div>
        <h3>Statistiques du site</h3>
        <hr/>
        <p> Il y a eu X visites sur le site</p>
        <br>
        <h3>Nous suivre sur les réseaux</h3>
        <hr/>
        <nav>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Snapchat</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </nav>

    </aside>
</div>

<!-- footer -->
<footer id="footer">
    <div>
        <button><a href="Contact.php" class="active">Contact</a></button>
        <button><a href="Conditions.php" class="active">Nos conditons</a></button>
    </div>
</footer>
</body>
</html>
