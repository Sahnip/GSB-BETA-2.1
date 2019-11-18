<?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Supprimer"
 * @package default
 * @todo  RAS
 */
 
$repInclude = './include/';
$repVues = './vues/';

require($repInclude . "_init.inc.php");

if (isset($_POST["mat"]))
{
  $unmat = $_POST["mat"];
}

if (count($_POST) == 0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  supprimer($unmat,$tabErreurs);
}

// Construction de la page Supprimer
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
include($repVues."vSupprimerFormvis.php") ;
include($repVues."pied.php") ;
?>
  
