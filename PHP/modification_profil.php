<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 17/05/2019
 * Time: 20:06
 */


if(isset($_POST['password'])) {
    $newPassword=$_POST['password'];
}
else {
    $newPassword="";
}

if(isset($_POST['oldPassword'])) {
    $oldPassword=$_POST['oldPassword'];
}
else {
    $oldPassword="";
}

if(isset($_POST['password_confirm'])) {
    $newPassword_confirm=$_POST['password_confirm'];
}
else {
    $newPassword_confirm="";
}

if(isset($_POST['email'])) {
    $newEmail=$_POST['email'];
}
else {
    $newEmail="";
}

if(isset($_POST['datenaissance'])) {
    $newDatenaissance=$_POST['datenaissance'];
}
else {
    $newDatenaissance="";
}

if(isset($_POST['nom'])) {
    $newNom=$_POST['nom'];
}
else {
    $newNom="";
}

if(isset($_POST['prenom'])) {
    $newPrenom=$_POST['prenom'];
}
else {
    $newPrenom="";
}

if(isset($_POST['adresse'])) {
    $newAdresse=$_POST['adresse'];
}
else {
    $newAdresse = "";
}

if(isset($_POST['cp'])) {
    $newCp=$_POST['cp'];
}
else {
    $newCp="";
}

if(isset($_POST['ville'])) {
    $newVille=$_POST['ville'];
}
else {
    $newVille="";
}

if(isset($_POST['prof'])) {
    $newProfes=$_POST['prof'];
}
else {
    $newProfes="";
}

include("connexionbd.php");
connexion_bd();
$query = "SELECT * FROM utilisateur WHERE mail = '{$email}'";
$res = pg_query($dbconn, $query);
$res = pg_fetch_row($res);

if($oldPassword == $res[6] and ( ($newPassword == $newPassword_confirm and $newPassword != "") or $newPrenom !="" or $newProfes != $res[3] or $newEmail != $res[0] or $newDatenaissance != $res[7] or  $newVille != $res[8] or $newNom != $res[2] or $newPrenom != $res[1]  or $newAdresse != $res[6] or $newCp != $res[5]))
{
    $query = "UPDATE utilisateur SET  mail =  WHERE mail='{$email}'";
    pg_query($dbconn, $query);
}
else
{
    echo "Les mots de passes ne correspondent pas";//mauvais mot de passe
}
