<?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Modifier"
 * @package default
 * @todo  RAS
 */
 
$repInclude = './include/';
$repVues = './vues/';
?>
<br>
<?php  
require($repInclude . "_init.inc.php");
  


// Déterminer l'étape et lire les données POST

$etape=1;
if (count($_POST) == 1)
{
  $etape = 2;
  $unmat = $_POST["mat"];

  if ($unmat == "")
  {
    $etape = 1;
  }
}
if (count($_POST) > 1)
{
  $etape = 3;
  $unmat = $_POST["mat"];
  $unnom = $_POST["nom"];
  $unprenom = $_POST["prenom"];
}

// Selon l'étape
switch ($etape)
{
  case 2 :
    $visiteur = rechercherMat($unmat,$tabErreurs);
    break;
   
  case 3 : 
    modifier($unmat, $unnom, $unprenom, $tabErreurs);
    break;
}


// Construction de la page Modifier
// pour l'affichage (appel des vues)

include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");

switch ($etape)
{
  case 1 :
   include($repVues."vModifierRefFormvis.php");
   break;
  case 2 :
   include($repVues."vModifierFormvis.php");
   break;
}
include($repVues."pied.php") ;
?>