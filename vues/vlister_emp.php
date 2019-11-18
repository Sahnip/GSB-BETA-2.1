<!-- Affichage des informations sur les visiteurs-->

<div class="container">

    <table class="table table-bordered table-striped table-condensed">

      <thead>
        <tr>
          <th>Materiel</th>
          <th>Visiteur</th>
          <th>Date d'emprunt</th>
        </tr>
      </thead>
      <tbody>  
        <br>
        <br>
<?php

    $i = 0;
    while($i < count($visiteur))
    { 
 ?>     

        <tr>

            <td><?php echo $visiteur[$i]["idMateriel"]?></td>
            <td><?php echo $visiteur[$i]["idVisiteur"]?></td>
            <td><?php echo $visiteur[$i]["dateEmprunt"]?></td>
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>

 