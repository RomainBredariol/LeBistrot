<?php
//verification si deja connecté
session_start();
if (isset($_SESSION['username']))
{
	header("Location:accueil.php");
}
	
if(isset($_POST['password'])) {
    $password=$_POST['password'];
}
else {
    $password="";
}

if(isset($_POST['password_confirm'])) {
    $password_confirm=$_POST['password_confirm'];
}
else {
    $password_confirm="";
}

if(isset($_POST['email'])) {
    $email=$_POST['email'];
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
    $nom=$_POST['nom'];
}
else {
    $nom="";
}

if(isset($_POST['prenom'])) {
    $prenom=$_POST['prenom'];
}
else {
    $prenom="";
}

if(isset($_POST['adresse'])) {
    $adresse=$_POST['adresse'];
}
else {
    $adresse = "";
}

if(isset($_POST['cp'])) {
    $cp=$_POST['cp'];
}
else {
    $cp="";
}

if(isset($_POST['ville'])) {
    $ville=$_POST['ville'];
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


  if($password == $password_confirm)
  {
      include("connexionbd.php");
      connexion_bd();
	  $query = "SELECT mail FROM utilisateur WHERE mail = :email;";
	  $count= count($select);
	  if ($select > 0)
	  {
		  echo "Le mail existe deja";
	  }
	  else
	  {
		$insert = pg_query("INSERT INTO utilisateur (mail, prenom, nom, professionnel, cp, adresse, mdp, date_de_naissance, ville) VALUES ('$email', '$prenom', '$nom', '$profes', '$cp', '$adresse', '$password', '$datenaissance', '$ville')");
	  }
  }
  else
  {
	  echo "Les mots de passes ne correspondent pas";//mauvais mot de passe
  }
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
                </ul>
            </div>
        </nav>
    </div>
</header>

<div id="container">
    <!-- zone de connexion -->
    <form action="../PHP/verification.php" method="POST">
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
        <b>Date de naissance</b>
        <input type="text" placeholder="Entrer votre date de naissance" name="datenaissance" required>
        <br/>
        <b>Adresse</b>
        <input type="text" placeholder="Entrer votre adresse" name="adresse" required>
        <br/>
        <b>Code Postal</b>
        <input type="text" placeholder="Entrer votre code postal" name="cp" required>
        <br/>
        <b>Ville</b>
        <input type="text" placeholder="Entrer votre ville" name="ville" required>
        Etes-vous un profesionnel ? :<br/>
        <select name="prof" id="prof">
            <option value="false">non</option>
            <option value="true">oui</option>
            <p>Choisissez vos styles<br></p>
            <select multiple size = 2 id=select>
                <option value="Classique">Classique</option>
                <option value="Rock">Rock</option>
                <option value="Pop">Pop</option>
                <option value="Techno">Techno</option>
            </select>
            <input type="submit" id='submit' value='Inscription' >
    </form>
</div>
<footer id="footer">
    <div>
        <button> <a href="Contact.php" class ="active">Contact</a> </button>
        <button> <a href="Conditions.php" class ="active">Nos conditons</a> </button>
</footer>
</body>
</html>
