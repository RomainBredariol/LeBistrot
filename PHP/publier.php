<?php
    include "connexionbd.php";
    include "fonctions.php";
    session_start();

    if (isset($_SESSION['username']))
        {
        }
    else
        {
            header("Location:connexion.php");
        }
    $dbcon = connexion_bd();

    //si le bouton publier est presse
    if (isset($_POST['btnPublier'])) {
        publier($dbcon);
        header("Location:accueil.php");
    }

    //on recupere l'ensemble des titres de musique et d'album
    $resultat_titre = pg_query($dbcon, "SELECT nom_musique FROM titre_musical ORDER BY nom_musique;");
    $titre = pg_fetch_all($resultat_titre);

    $resultat_album = pg_query($dbcon, "SELECT nom FROM album ORDER BY nom;");
    $album = pg_fetch_all($resultat_album);

//met les titres dans le select
function setSelectTitre($titre)
{
    for ($row = 0; $row < sizeof($titre); $row++) {
        $titre_musical = ($titre[$row])["nom_musique"];
        echo "<option value=\"$titre_musical\">$titre_musical</option>";
    }
}

//met les albums dans le select
function setSelectAlbum($album)
{
    for ($row = 0; $row < sizeof($album); $row++) {
        $titre_album = ($album[$row])["nom"];
        echo "<option value=\"$titre_album\">$titre_album</option>";
    }
}

//publie un article
function publier($dbcon)
{

    //si le titre et le contenu ne sont pas vides
    if (isset($_POST["areatitre"]) && isset($_POST["areacontenu"]) && isset($_POST["type"])) {

        //on recupere le max des id_critique dans la table critique
        $nb = pg_query($dbcon, "Select max(id_critique) as nb from critique;");
        $nb_critique = pg_fetch_all($nb);

        //si le bouton album est selectionné et que le select n'est pas a default
        if ($_POST["type"] == "btnAlbum" && $_POST["album"] != "Default") {

            //on recupere l'id de l'album selectionné
            $requete = "Select id_album from album where nom=$1";
            $res = pg_query_params($dbcon, $requete, array($_POST['album']));
            $id_album = pg_fetch_all($res);

            //affectation des variables
            $id_critique    = ((int)$nb_critique[0]["nb"]) + 1;
            $titre          = enleverCaracteresSpeciaux($_POST["areatitre"]);
            $corps          = enleverCaracteresSpeciaux($_POST["areacontenu"]);
            $date           = date("Y-m-d");
            $valide         = "false";
            $id_al          = (int) $id_album[0]["id_album"];
            $id_ti          = "NULL";
            $mail           = $_SESSION["username"];

            //on insere dans la table la critique
            pg_query($dbcon, "INSERT INTO critique 
                VALUES ($id_critique, '$titre', '$corps', '$date', $valide, $id_al, $id_ti, '$mail');");

        }
        //si le bouton titre est selectionné et que le select n'est pas a default
        elseif ($_POST["type"] == "btnTitre" && $_POST["titre"] != "Default"){

            //on recupere l'id du titre selectionné et de l'album correspondant
            $requete = "Select id_musique, id_album from titre_musical where nom_musique=$1";
            $res = pg_query_params($dbcon, $requete, array($_POST['titre']));
            $id = pg_fetch_all($res);

            //affectation des variables
            $id_critique    = ((int)$nb_critique[0]["nb"]) + 1;
            $titre          = enleverCaracteresSpeciaux($_POST["areatitre"]);
            $corps          = enleverCaracteresSpeciaux($_POST["areacontenu"]);
            $date           = date("Y-m-d");
            $valide         = "false";
            $id_al          = (int) $id[0]["id_album"];
            $id_ti          = (int) $id[0]["id_musique"];;
            $mail           = $_SESSION["username"];

            //on insere dans la table la critique
            pg_query($dbcon, "INSERT INTO critique 
                VALUES ($id_critique, '$titre', '$corps', '$date', $valide, $id_al, $id_ti, '$mail');");


        }

    }

}
?>


<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/style_publier.css" type="text/css" />
    <title>Partag'Zic</title>
</head>

<body>
<!-- Header -->
<header id="header">
    <div id="hautheader">
        <img src="..//IMAGES/favicon.png" id="favicon" />
		        <!-- affiche le bouton connexion ou deconnexion en fonction de si on est connecté ou pas -->
								<?php
								 if (isset($_SESSION['username']))
								 {
									echo '<a href="deconnexion.php"><input type="submit" id="btnConnexion" value="DECONNEXION"></a>';
								 }
								 else
								 {
									echo '<a href="connexion.php"><input type="submit" id="btnConnexion" value="CONNEXION"></a>';
								 }
								 ?>

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

                    <!-- affiche le menu profil  -->
						 <?php
								 if (isset($_SESSION['username']))
								 {
									echo '<li><a href="profil.php">PROFIL</a></li>';
									$user= $_SESSION['username'];
									echo "<div align='right'><h3>vous êtes connecté en tant : <font color='red'>$user&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></h3></div>";
								 }
								 ?>
                </ul>
            </div>
        </nav>
    </div>
</header>

<div id="wrapper">
<br>
    <!-- Main -->
    <section id="main" class="main">
        <!-- php associe -->
        <form action="publier.php" method="POST">
            <b> Publier une critique</b>
            <article>
                <header>
                    <textarea maxlength="50" placeholder="Titre de votre critique" id="areatitre" name="areatitre" required></textarea>
                    <fieldset id="fieldtype">
                        <legend>Objet de la critique</legend>


                        <input type="radio" onchange="selectTitre()" name="type" value="btnTitre">
                        <label>Titre</label><br/>
                        <select name="titre">
                            <option>Default</option>
                            <?php
                                setSelectTitre($titre);
                            ?>
                        </select><br>

                        <input type="radio" onclick="selectAlbum()" name="type" value="btnAlbum">
                        <label>Album</label><br/>
                        <select name="album">
                            <option>Default</option>
                            <?php
                                setSelectAlbum($album);
                            ?>
                        </select>
                    </fieldset>


                </header>

                <textarea placeholder="contenu de votre critique" id="areacontenu" name="areacontenu" required></textarea>
                <input type="submit" name="btnPublier" value="PUBLIER">

            </article>
        </form>
    </section>
    
    <section class = "rr">
    <!-- sidebar -->
    <aside id="sidebar">
      <h3>Recherche rapide </h3>
      <hr />
      <div>
        <form name="rechercher" action="rechercher.php" method="post">
              <input type="search" placeholder="Artiste, album, titre, date, auteur..." id="rechercheRapide" name="texte">
              <input type="image" src="../IMAGES/loupe.png" width="3%" id="boutonRechercher" value="RECHERCHER">
        </form>
      </div>
      <br>
        <h3>Nombre de pages visités</h3>
      <hr />
      <?php
  include("compteur.php");
  $vue=compteur();
  echo "<p>Il y a eu $vue visites sur le site</p>";
  ?>
      <br>
      <h3>Nous suivre sur les réseaux</h3>
      <hr />
      <nav>
        <ul>
          <li><a href="https://facebook.com"><img src="../IMAGES/fb.png" id="facebook" width="10%"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="https://instagram.com"><img src="../IMAGES/ins.png" id="instagram" width="10%"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="https://twitter.com"><img src="../IMAGES/tw.png" id="twitter" width="12%" /></a></li>
        </ul>
      </nav>

    </aside>
    </section>

</body>
</html>

