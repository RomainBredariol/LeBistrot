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
    echo "<center>Votre demande a été prise en compte</center>";
} else echo "erreur lors de l'envoie de votre demande";

?>

<html>
<head>
    <?php
    session_start();
    session_destroy();
    ?>
    <script type="text/javascript">
        function RedirectionJavascript()
        {
            document.location.href="http://partagzic.alwaysdata.net/LeBistrot/PHP/accueil.php";
        }
    </script>

</head>

<body onLoad="setTimeout('RedirectionJavascript()', 5000)">
<center>Vous allez être redirigé vers l'accueil dans quelques instants<center>
</body>

</html>
