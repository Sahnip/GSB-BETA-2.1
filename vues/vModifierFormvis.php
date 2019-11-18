<?php 
if (isset($message))
  {
?>
    <div class="container"><?php echo $message ?> </div>
<?php
  }
?>
<!--Saisir les informations dans un formulaire!-->
<div class="container">
  <form action="" method=post>
    <fieldset>
      <legend>Entrez les données sur le visiteur a modifier </legend>

      <label> Matricule :</label>
          <input type="hidden" name="mat" value="<?php echo $visiteur["mat"]; ?>" /><br /> 

          <label>Nom :</label>
      <input type="text" name="nom" value="<?php echo $visiteur["nom"]; ?>" size="20" /><br />

          <label>Prenom :</label>
       <input type="text" name="prenom" value="<?php echo $visiteur["prenom"]; ?>" size="10" /><br />
    </fieldset>

    <button type="submit" class="btn btn-primary">Modifier</button>
    <button type="reset" class="btn">Annuler</button>
    <p />
  </form> 
</div>
 




