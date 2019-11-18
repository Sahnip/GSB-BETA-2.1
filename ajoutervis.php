 <?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Ajouter"
 * @package default
 * @todo  RAS
 */
 
$repInclude = './include/';
$repVues = './vues/';

require($repInclude . "_init.inc.php");

if (isset($_POST["mat"]) and isset($_POST["nom"]) and isset($_POST["prenom"]))
{
	$unmat = $_POST["mat"];
	$unnom = $_POST["nom"];
	$unprenom = $_POST["prenom"];
}

if (count($_POST) == 0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  ajouter($unmat, $unnom, $unprenom,$tabErreurs);
}

// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");
include($repVues."vAjouterFormvis.php") ;
include($repVues."pied.php") ;
?>
  
