<?php
include "connexionbd.php";
session_start();
$dbcon = connexion_bd();

//on recupere l'ensemble des titres de musique et d'album
$resultat_titre = pg_query($dbcon, "SELECT nom_musique FROM titre_musical ORDER BY nom_musique;");
$titre = pg_fetch_all($resultat_titre);

$resultat_album = pg_query($dbcon, "SELECT nom FROM album ORDER BY nom;");
$album = pg_fetch_all($resultat_album);


function setSelectTitre($titre)
{
    for ($row = 0; $row < sizeof($titre); $row++) {
        $titre_musical = ($titre[$row])["nom_musique"];
        echo "<option value=\"$titre_musical\">$titre_musical</option>";
    }
}

function setSelectAlbum($album)
{
    for ($row = 0; $row < sizeof($album); $row++) {
        $titre_album = ($album[$row])["nom"];
        echo "<option value=\"$titre_album\">$titre_album</option>";
    }
}

function publier($dbconn){
    if(isset($_POST["areatitre"]) && isset($_POST["areacontenu"]) && $_POST["album"] != "Default"){
        
        $requete = "Insert Into ;";
        pg_query_params($dbconn, $requete);
    }
}

?>
<script type="text/javascript">
    function selectTitre() {
        $btn = document.getElementById("btnTitre");
        $select = document.getElementById("titre");
        if($btn.checked.valueOf() == true){
            $select.disabled = false;

        }else{
            $select.disabled = true;
        }
    }

    function selectAlbum() {
        $btn = document.getElementById("btnAlbum");
        $select = document.getElementById("album");
        if($btn.checked.valueOf() == true){
            $select.disabled = false;
        }else{
            $select.disabled = true;
        }
    }
</script>


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
									echo '<a href="deconnexion.php"><input type="button" id="btnConnexion" value="DECONNEXION"></a>';
								 }
								 else
								 {
									echo '<a href="connexion.php"><input type="button" id="btnConnexion" value="CONNEXION"></a>';
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
								 
						 <!-- affiche le menu profil  -->
						 <?php
						 if (isset($_SESSION['username']))
						{
							echo '<li><a href="profil.php">PROFIL</a></li>';
						}
						?>
                </ul>
            </div>
        </nav>
    </div>
</header>

<div id="wrapper">
    <!-- Main -->
    <section id="main">
        <!-- php associe -->
        <form action="/PHP/publier.php" method="POST">
            <b> Publier une critique</b>
            <article>
                <header>
                    <textarea maxlength="50" placeholder="Titre de votre critique" id="areatitre"></textarea>
                    <fieldset id="fieldtype">
                        <legend>Objet de la critique</legend>


                        <input type="radio" id="btnTitre" onchange="selectTitre()" name="type">
                        <label>Titre</label><br/>
                        <select id="titre" disabled>
                            <option>Default</option>
                            <?php
                                setSelectTitre($titre);
                            ?>
                        </select><br>

                        <input type="radio" id="btnAlbum" onclick="selectAlbum()" name="type">
                        <label>Album</label><br/>
                        <select id="album" disabled>
                            <option>Default</option>
                            <?php
                                setSelectAlbum($album);
                            ?>
                        </select>
                    </fieldset>


                </header>

                <textarea placeholder="contenu de votre critique" id="areacontenu"></textarea>
                <input type="button" value="PUBLIER" id="btnPublier">
            </article>
        </form>
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
    </aside>
</div>

<!-- footer -->
<footer id="footer">
    <div>
        <button> <a href="Contact.php" class ="active">Contact</a> </button>
        <button> <a href="Conditions.php" class ="active">Nos conditons</a> </button>
</footer>

</body>
</html>

