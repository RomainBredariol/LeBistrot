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
	 <center>Vous avez été déconnecté ...</center>
     <center>Dans 5 secondes vous allez être redirigé vers l'accueil<center>
  </body>
  
</html>
