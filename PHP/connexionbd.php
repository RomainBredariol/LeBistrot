<?php
/* Script de connexion à la bd  */    
function connexion_bd()
{

    $nom_du_serveur ="postgresql-partagzic.alwaysdata.net";
    $nom_de_la_base ="partagzic_projet";
    $nom_utilisateur ="partagzic";
    $passe ="stri1234";
 
    $dbconn = pg_connect("host=$nom_du_serveur port=5432 dbname=$nom_de_la_base user=$nom_utilisateur password=$passe") or die ('Erreur connexion impossible à la BDD : ');
}

function close_bd()
{
    pg_close();
}

//include("connexion.php");
		//connexion_bd();
		
?>

