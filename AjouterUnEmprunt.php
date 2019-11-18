 <?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Ajouter"
 * @package default
 * @todo  RAS
 */
 
$repInclude = './include/';
$repVues = './vues/';

require($repInclude . "_init.inc.php");

if (isset($_POST["idMateriel"]) and isset($_POST["idEmprunteur"]) and isset($_POST["dateD"]))
{
	$unidMateriel = $_POST["idMateriel"];
	$unidEmprunteur = $_POST["idEmprunteur"];
	$undateD = $_POST["dateD"];
}

if (count($_POST) == 0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  ajouterUnEmprunt($unidMateriel, $unidEmprunteur, $undateD,$tabErreurs);
}

// Construction de la page Rechercher
// pour l'affichage (appel des vues)
include($repVues."entete.php") ;
require($repVues."menu.php") ;
include($repVues ."erreur.php");
require($repVues."vAjouterUnEmprunt.php") ;
include($repVues."pied.php") ;
?>
  
