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
    $objet=$_POST['objet'];
}
else {
    $objet="";
}

if(isset($_POST['message'])) {
    $message=$_POST['message'];
}
else {
    $message="";
}
include("connexionbd.php");
$dbcon = connexion_bd();

//on recupere le max des id_contact dans la table contact
$nb = pg_query($dbcon, "SELECT max(id_contact) AS nb FROM contact;");
$nb_contact = pg_fetch_all($nb);

//On défini l'id du formulaire de contact
$id_contact = ((int)$nb_contact[0]["nb"]) + 1;

$query = "INSERT INTO contact (id_contact, email, objet, message) VALUES ('{$id_contact}', '{$email}', '{$objet}', '{$message}')";
if (pg_query($dbcon, $query)) {
    echo "Votre demande a été prise en compte";
} else echo "erreur lors de l'envoie de votre demande";

