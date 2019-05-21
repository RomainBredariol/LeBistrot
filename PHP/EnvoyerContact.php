<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 17/05/2019
 * Time: 20:06
 */


if(isset($_POST['email'])) {
    $email=$_POST['email'];
}
else {
    $email="";
}

if(isset($_POST['objet'])) {
    $objet=$_POST['oldPassword'];
}
else {
    $objet="";
}

if(isset($_POST['requeteContact'])) {
    $contenu=$_POST['requeteContact'];
}
else {
    $contenu="";
}

include("connexionbd.php");
$dbcon = connexion_bd();
$query = "INSERT INTO requete (origine, objet, contenu) VALUES ('{$email}', '{$objet}', '{$contenu}')";
if (pg_query($dbcon, $query)) {
    echo "Votre demande a été prise en compte";
} else echo "erreur lors de l'envoie de votre demande";

