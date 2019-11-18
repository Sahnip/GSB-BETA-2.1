<?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Rechercher"
 * @package default
 * @todo  RAS
 */
 
  $repInclude = './include/';
  $repVues = './vues/';
  
  require($repInclude . "_init.inc.php");
  $visiteur = lister_emprunt();
  
  // Construction de la page Rechercher
  // pour l'affichage (appel des vues)
  require($repVues."entete.php") ;
  require($repVues."menu.php") ;
  require($repVues."vlister_emp.php");
  require($repVues."pied.php") ;
  ?>