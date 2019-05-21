<?php
/* Script compteur  */
function compteur()
{
    $fichier="cpt.txt";
	$fd=fopen($fichier,"r+");
	$ligne=fgets($fd,10);

	$ligne=$ligne+1;
	fseek($fd,0);
	fputs($fd,$ligne);
	fclose($fd);
	
	return $ligne;
}
?>
