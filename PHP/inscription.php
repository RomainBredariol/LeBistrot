<?php
include("fonctions.php");
//verification si deja connecté
session_start();
if (isset($_SESSION['username']))
{
	header("Location:accueil.php");
}

if(isset($_POST['password'])) {
    $password=enleverCaracteresSpeciaux($_POST['password']);
	$password= sha1($password);
}
else {
    $password="";
}

if(isset($_POST['password_confirm'])) {
    $password_confirm=enleverCaracteresSpeciaux($_POST['password_confirm']);
	$password_confirm= sha1($password_confirm);
}
else {
    $password_confirm="";
}

if(isset($_POST['email'])) {
    $email=enleverCaracteresSpeciaux($_POST['email']);
}
else {
    $email="";
}

if(isset($_POST['datenaissance'])) {
    $datenaissance=$_POST['datenaissance'];
}
else {
    $datenaissance="";
}

if(isset($_POST['nom'])) {
    $nom=enleverCaracteresSpeciaux($_POST['nom']);
}
else {
    $nom="";
}

if(isset($_POST['prenom'])) {
    $prenom=enleverCaracteresSpeciaux($_POST['prenom']);
}
else {
    $prenom="";
}

if(isset($_POST['adresse'])) {
    $adresse=enleverCaracteresSpeciaux($_POST['adresse']);
}
else {
    $adresse = "";
}

if(isset($_POST['cp'])) {
    $cp=enleverCaracteresSpeciaux($_POST['cp']);
}
else {
    $cp="";
}

if(isset($_POST['ville'])) {
    $ville=enleverCaracteresSpeciaux($_POST['ville']);
}
else {
    $ville="";
}

if(isset($_POST['prof'])) {
    $profes=$_POST['prof'];
}
else {
    $profes="";
}
//verifie si le formulaire à deja été validé ou non
$retour = $_POST['retour'];

//récupération des variables de style
$classique = $_POST['classique'];
$pop = $_POST['pop'];
$rap = $_POST['rap'];
$electro = $_POST['electro'];
$rock = $_POST['rock'];
$jazz = $_POST['jazz'];
$funk = $_POST['funk'];

?>

<html>
<meta charset="utf-8">
<link rel="stylesheet" href="../CSS/style_inscription.css" type="text/css" />

<title>Partag'Zic</title>

<head>

</head>

<body>
<header id="header">
    <!--	<span class="elem">header</span> -->
    <div id="hautheader">
        <img src="..//IMAGES/favicon.png" id="favicon" />
		<a href="connexion.php">
        <input type="submit" id='btnConnexion' value='CONNEXION'>
		</a>
        <h1 id="titre">Le bistrot musical, la référence en critique musicale</h1>
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
                </ul>
            </div>
        </nav>
    </div>
</header>

<div id="container">
<form action="../PHP/inscription.php" method="POST">
<?php
//verification que le mail n'existe pas
if($retour == 1){
  if($password == $password_confirm)
  {
      include("connexionbd.php");
      $dbcon = connexion_bd();
	  $requete = "SELECT count(mail) as id FROM utilisateur WHERE mail='$email'";
	  $resultat = pg_query($dbcon, $requete);
	  $select = pg_fetch_array($resultat);
	  
	  if ($select["id"] > 0)
	  {
		  echo "<center><h4><font color='red'>L'adresse mail entrée est deja enregistré sur le site</font></h4></center>";
	  }
	  else
	  {
		  //insertion categorie aimé par les utilisateur
		$insert = pg_query("INSERT INTO utilisateur (mail, prenom, nom, professionnel, cp, adresse, mdp, date_de_naissance, ville, admin) VALUES ('$email', '$prenom', '$nom', '$profes', '$cp', '$adresse', '$password', '$datenaissance', '$ville', 'FALSE')");
		if(isset($pop)) 
		{
			$insert = pg_query("INSERT INTO aimer (mail, nom_categorie) VALUES ('$email', 'Pop')");
		}
		
		if(isset($rock)) 
		{
			$insert = pg_query("INSERT INTO aimer (mail, nom_categorie) VALUES ('$email', 'Rock')");
		}
		
		if(isset($classique)) 
		{
			$insert = pg_query("INSERT INTO aimer (mail, nom_categorie) VALUES ('$email', 'Classique')");
		}
		
		if(isset($rap)) 
		{
			$insert = pg_query("INSERT INTO aimer (mail, nom_categorie) VALUES ('$email', 'Rap')");
		}
		
		if(isset($jazz)) 
		{
			$insert = pg_query("INSERT INTO aimer (mail, nom_categorie) VALUES ('$email', 'Jazz')");
		}
		
		if(isset($funk)) 
		{
			$insert = pg_query("INSERT INTO aimer (mail, nom_categorie) VALUES ('$email', 'Funk')");
		}
		header("Location:connexion.php");
	  }
	  
  }
  else
  {
	  echo "<center><h4><font color='red'>Les mots de passes ne correspondent pas</font></h4></center>";//mauvais mot de passe
  }
}

?>
    <!-- zone de connexion -->
    
	
        <h1>Inscription</h1>

        <b>E-mail</b>
        <input type="email" placeholder="Entrer votre email" name="email" required><br/>
        <b>Mot de passe</b>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
        <b>Confirmation du mot de passe</b>
        <input type="password" placeholder="Confirmer le mot de passe" name="password_confirm" required>
        <b>Nom</b>
        <input type="text" placeholder="Entrer votre nom" name="nom" required>
        <b>Prenom</b>
        <input type="text" placeholder="Entrer votre prénom" name="prenom" required>
        <br/>
        <b>Date de naissance</b></br>
        <input type="date" placeholder="Entrer votre date de naissance" name="datenaissance" required>
        <br/>
        <b>Adresse</b>
        <input type="text" placeholder="Entrer votre adresse" name="adresse" required>
        <br/>
        <b>Code Postal</b>
        <input type="text" placeholder="Entrer votre code postal" name="cp" required>
        <br/>
        <b>Ville</b>
        <input type="text" placeholder="Entrer votre ville" name="ville" required>
		</br>
		</br>
        <b>Etes-vous un profesionnel ? :</b><br/>
        <select name="prof" id="prof">
            <option value='FALSE'>non</option>
            <option value='TRUE'>oui</option>
		</select>
			</br>
			</br>
            <b>Choisissez vos styles :</b> </br></br>
            <input type="checkbox" name="classique" id="classique" /><label for="classique">Classique</label>&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="rock" id="rock" /><label for="rock">Rock</label>&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="pop" id="pop" /><label for="pop">Pop</label>&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="electro" id="electro" /><label for="electro">Electro</label>&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="rap" id="rap" /><label for="rap">Rap</label>&nbsp;&nbsp;&nbsp;</br></br>
			<input type="checkbox" name="jazz" id="jazz" /><label for="jazz">Jazz</label>&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="funk" id="funk" /><label for="funk">Funk</label>&nbsp;&nbsp;&nbsp;
			<input type="hidden" name="retour" value="1" >
			</br>
			</br>
            <input type="submit" id='submit' value='Inscription' >
    </form>
</div>
</body>
</html>
