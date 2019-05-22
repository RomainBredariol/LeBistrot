<?php

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
    $newProfes=FALSE;
}

$email = $_SESSION['username']; //recupère le contenu de la variable de session
include("connexionbd.php");
$dbcon = connexion_bd();
$query = "SELECT * FROM utilisateur WHERE mail = '{$email}'";
$res = pg_query($dbcon, $query);
$res = pg_fetch_row($res, 0);
if($oldPassword == $res[6]) {

    if ($newEmail !="" and $newEmail != $res[0] ){
        $query = "UPDATE utilisateur SET  mail='{$newEmail}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
    if ( $newPrenom != "" and $newPrenom != $res[1]) {
        $query = "UPDATE utilisateur SET  prenom='{$newPrenom}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
    if ( $newNom !="" and  $newNom != $res[2]){
        $query = "UPDATE utilisateur SET  nom='{$newNom}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
   /* if ($newProfes != $res[3]) {
        $query = "UPDATE utilisateur SET  professionnel  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }*/
    if ($newCp != 0  and $newCp != $res[4]){
        $query = "UPDATE utilisateur SET  cp='{$newCp}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
    if ( $newAdresse != ""  and $newAdresse != $res[5]) {
        $query = "UPDATE utilisateur SET  adresse='{$newAdresse}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
    if ($newDatenaissance != "" and  $newDatenaissance != $res[7]) {
        $query = "UPDATE utilisateur SET  date_de_naissance='{$newDatenaissance}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
    if ( $newVille !="" and $newVille != $res[8]){
        $query = "UPDATE utilisateur SET  ville='{$newVille}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
    if($newPassword == $newPassword_confirm) {
        $query = "UPDATE utilisateur SET  mdp='{$newPassword}'  WHERE mail='{$email}'";
        pg_query($dbcon, $query);
    }
    //REDIRECTION PAGE PROFIL
} else  echo "
	 <center><h2><font color='red'>Le mot de passe est incorrect ou aucun champs n'a été modifié</font></h2></center>
	 <center><a href='profil.php'>retourner sur votre Profil</a></center>";