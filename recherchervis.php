<?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Rechercher"
 * @package default
 * @todo  RAS
 */
 
$repInclude = './include/';
$repVues = './vues/';

require($repInclude . "_init.inc.php");
 
if (count($_POST) == 0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  $visiteur = rechercher($_POST['nom']);
}
 
// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues."vRechercherFormvis.php") ;

if ($etape == 2)
{
  include($repVues."vVisiteurvis.php");
} 
include($repVues."pied.php") ;
?>
    
