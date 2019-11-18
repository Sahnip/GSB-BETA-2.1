<?php

// MODIFs A FAIRE
// Ajouter en têtes 
// Voir : jeu de caractères à la connection

/** 
 * Se connecte au serveur de données                     
 * Se connecte au serveur de données à partir de valeurs
 * prédéfinies de connexion (hôte, compte utilisateur et mot de passe). 
 * Retourne l'identifiant de connexion si succès obtenu, le booléen false 
 * si problème de connexion.
 * @return resource identifiant de connexion
 */
function connecterServeurBD() 
{
    $PARAM_hote = 'localhost'; // le chemin vers le serveur
    $PARAM_port = '3306';
    $PARAM_nom_bd = 'gsb project'; // le nom de votre base de données
    $PARAM_utilisateur = 'root'; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe = ''; // mot de passe de l'utilisateur pour se connecter
    $connect = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
    return $connect;

    //$hote = "localhost";
    // $login = "root";
    // $mdp = "";
    // return mysql_connect($hote, $login, $mdp);
}


/** 
 * Ferme la connexion au serveur de données.
 * Ferme la connexion au serveur de données identifiée par l'identifiant de 
 * connexion $idCnx.
 * @param resource $idCnx identifiant de connexion
 * @return void  
 */
function deconnecterServeurBD($idCnx) {

}


function lister()
{
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
      
           
      $requete = "select * from visiteur";
     
      
      $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

      $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
      $i = 0;
      $ligne = $jeuResultat->fetch();
      while($ligne)
      {
          $visiteur[$i]['VIS_MATRICULE'] = $ligne->VIS_MATRICULE;
          $visiteur[$i]['VIS_NOM'] = $ligne->VIS_NOM;
          $visiteur[$i]['VIS_PRENOM'] = $ligne->VIS_PRENOM;
          $ligne = $jeuResultat->fetch();
          $i = $i + 1;
      }
  } 
  $jeuResultat->closeCursor();   // fermer le jeu de résultat
  // deconnecterServeurBD($idConnexion);
  return $visiteur;
}


function ajouter($unmat, $unnom, $unprenom,$tabErreurs)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
    
    // Vérifier que la référence saisie n'existe pas déja
    $requete = "select * from visiteur";
    $requete = $requete." where VIS_MATRICULE = '".$unmat."';"; 
    $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if (isset($ligne))
    {
      $message = "Echec de l'ajout : la référence existe déjà !";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      // Créer la requête d'ajout 
       $requete = "insert into visiteur"
       ."(VIS_MATRICULE,VIS_NOM,VIS_PRENOM) values ('"
       .$unmat."','"
       .$unnom."','"
       .$unprenom."');";
       
       echo $requete;
        // Lancer la requête d'ajout 
        $ok = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
       
        // Si la requête a réussi
        if ($ok)
        {
          $message = "L'employé a été correctement ajoutée";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, l'ajout de l'employé a échoué !!!";
          ajouterErreur($tabErr, $message);
        } 

    }
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "problème à la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}

function supprimer($unmat, &$tabErr)
{
    $connexion = connecterServeurBD();
    
    $fleur = array();
    $requete = "select * from visiteur";
      $requete = $requete." where VIS_MATRICULE = '".$unmat."';"; 
      $jeuResultat = $connexion->query($requete);
     $ligne = $jeuResultat->fetch();
     if ($ligne)
     { 
          
    $requete = "delete from visiteur";
    $requete = $requete." where VIS_MATRICULE = '".$unmat."';"; 
    
    // Lancer la requête supprimer
        $ok = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
          
        // Si la requête a réussi
        if ($ok)
        {
          $message = "L'employé a été correctement supprimée";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la suppression de l'employé a échoué !!!";
          ajouterErreur($tabErr, $message);
        }
       }
       else
       {
        $message ="Echec de la suppression : le matricule n'existe pas";
        ajouterErreur($tabErr, $message);
       } 

}

function rechercherMat($unmat, &$tabErr)
{
    $connexion = connecterServeurBD();
    
    $vis = array();
   
    $requete = "select * from visiteur";
    $requete = $requete." where VIS_MATRICULE = '".$unmat."';"; 
    
    $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    if ($ligne)
    {
        $vis['mat'] = $ligne['VIS_MATRICULE'];
        $vis['nom'] = $ligne['VIS_NOM'];
        $vis['prenom'] = $ligne['VIS_PRENOM'];
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   
      
    if ($i == 0)
    {
      $message = "Aucun employé ne correspond à ce matricule";
      ajouterErreur($tabErr, $message);
    }
  
  return $vis;
}

function modifier($unmat, $unnom, $unprenom,&$tabErr)
{
  
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
    
    // Vérifier que la référence saisie n'existe pas déja
    $requete = "select * from visiteur";
    $requete = $requete." where VIS_MATRICULE = '".$unmat."';";
              
   
    $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    //$jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    // Créer la requête de modification 
  
    $requete = "UPDATE visiteur SET VIS_MATRICULE = '".$unmat."',VIS_NOM = '".$unnom."',
    VIS_PRENOM = '".$unprenom."'
     WHERE VIS_MATRICULE ='".$unmat."';";
         
        // Lancer la requête d'ajout 
        $ok = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
          
        // Si la requête a réussi
        if ($ok)
        {
          $message = "L'employé a été correctement modifié";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la modification de l'employé a échoué !!!";
          ajouterErreur($tabErr, $message);
        } 
    }

function rechercher($nom)
{
    $connexion = connecterServeurBD();
    
    $visiteur = array();
   
    $requete = "select * from visiteur";
      $requete = $requete." where VIS_NOM='".$nom."';";
    
    $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $visiteur[$i]['VIS_MATRICULE'] = $ligne['VIS_MATRICULE'];
        $visiteur[$i]['VIS_NOM'] = $ligne['VIS_NOM'];
        $visiteur[$i]['VIS_PRENOM'] = $ligne['VIS_PRENOM'];
        $ligne = $jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de résultat
  
  return $visiteur;
}

//    ///////////////////
//   ///////////////////
//  ///////////////////
//Gestion des matériels
//  \\\\\\\\\\\\\\\\\\\
//   \\\\\\\\\\\\\\\\\\\
//    \\\\\\\\\\\\\\\\\\\

function lister_materiel()
{
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
      
           
      $requete = "select * from materiel";
     
      
      $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

      $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
      $i = 0;
      $ligne = $jeuResultat->fetch();
      while($ligne)
      {
          $visiteur[$i]['ID'] = $ligne->ID;
          $visiteur[$i]['Marque'] = $ligne->Marque;
          $visiteur[$i]['Modele'] = $ligne->Modele;
          $visiteur[$i]['Prix'] = $ligne->Prix;
          $ligne = $jeuResultat->fetch();
          $i = $i + 1;
      }
  } 
  $jeuResultat->closeCursor();   // fermer le jeu de résultat
  // deconnecterServeurBD($idConnexion);
  return $visiteur;
}

function supprimer_materiel($lemat, &$tabErr)
{
    $connexion = connecterServeurBD();
    
    $fleur = array();
    $requete = "select * from materiel";
      $requete = $requete." where ID = '".$lemat."';"; 
      $jeuResultat = $connexion->query($requete);
     $ligne = $jeuResultat->fetch();
     if ($ligne)
     { 
          
    $requete = "delete from materiel";
    $requete = $requete." where ID = '".$lemat."';"; 
    
    // Lancer la requête supprimer
        $ok = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
          
        // Si la requête a réussi
        if ($ok)
        {
          $message = "Le mteriel a été correctement supprimée";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la suppression du materiel a échoué !!!";
          ajouterErreur($tabErr, $message);
        }
       }
       else
       {
        $message ="Echec de la suppression : le matricule n'existe pas";
        ajouterErreur($tabErr, $message);
       } 

}



//    ///////////////////
//   ///////////////////
//  ///////////////////
//Gestion des emprunts
//  \\\\\\\\\\\\\\\\\\\
//   \\\\\\\\\\\\\\\\\\\
//    \\\\\\\\\\\\\\\\\\\


function lister_emprunt()
{
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
      
           
      $requete = "select * from emprunt";
     
      
      $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

      $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
      $i = 0;
      $ligne = $jeuResultat->fetch();
      while($ligne)
      {
          $visiteur[$i]['idMateriel'] = $ligne->idMateriel;
          $visiteur[$i]['idVisiteur'] = $ligne->idVisiteur;
          $visiteur[$i]['dateEmprunt'] = $ligne->dateEmprunt;
          $ligne = $jeuResultat->fetch();
          $i = $i + 1;
      }
  } 
  $jeuResultat->closeCursor();   // fermer le jeu de résultat
  // deconnecterServeurBD($idConnexion);
  return $visiteur;
}


function restituer($unmat, &$tabErr)
{
    $connexion = connecterServeurBD();
    
    $fleur = array();
    $requete = "select * from emprunt";
      $requete = $requete." where ID = '".$unmat."';"; 
      $jeuResultat = $connexion->query($srequete);
     $ligne = $jeuResultat->fetch();
     if ($ligne)
     { 
          
    $requete = "delete from emprunt";
    $requete = $requete." where ID = '".$unmat."';"; 
    
    // Lancer la requête supprimer
        $ok = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
          
        // Si la requête a réussi
        if ($ok)
        {
          $message = "Le mteriel a été correctement supprimée";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, la suppression du materiel a échoué !!!";
          ajouterErreur($tabErr, $message);
        }
       }
       else
       {
        $message ="Echec de la suppression : le matricule n'existe pas";
        ajouterErreur($tabErr, $message);
       } 

}
function ajouterUnEmprunt($unidMateriel, $unidEmprunteur, $undateD,$tabErreurs)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  
  // Si la connexion au SGBD à réussi
  if (TRUE) 
  {
    // Vérifier que la référence saisie n'existe pas déja
    $requete = "select * from emprunt";
    $requete = $requete." where idMateriel = '".$unidMateriel."';"; 
    $jeuResultat = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant

    $jeuResultat->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet     
    
    $ligne = $jeuResultat->fetch();
    if (isset($ligne))
    {
      $message = "Echec de l'ajout : le produit est e cours d'emprunt!";
      ajouterErreur($tabErr, $message);
    }
    else
    {
      // Créer la requête d'ajout 
       $requete = "insert into visiteur"
       ."(VIS_MATRICULE,VIS_NOM,VIS_PRENOM) values ('"
       .$unmat."','"
       .$unnom."','"
       .$unprenom."');";
       
       echo $requete;
        // Lancer la requête d'ajout 
        $ok = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
       
        // Si la requête a réussi
        if ($ok)
        {
          $message = "L'employé a été correctement ajoutée";
          ajouterErreur($tabErr, $message);
        }
        else
        {
          $message = "Attention, l'ajout de l'employé a échoué !!!";
          ajouterErreur($tabErr, $message);
        } 

    }
    // fermer la connexion
    // deconnecterServeurBD($idConnexion);
  }
  else
  {
    $message = "problème à la connexion <br />";
    ajouterErreur($tabErr, $message);
  }
}

?>
