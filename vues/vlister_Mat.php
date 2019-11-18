<!-- Affichage des informations sur les visiteurs-->

<div class="container">

    <table class="table table-bordered table-striped table-condensed">

      <thead>
        <tr>
          <th>Matricule</th>
          <th>Marque</th>
          <th>Model</th>
          <th>Prix</th>
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

            <td><?php echo $visiteur[$i]["ID"]?></td>
            <td><?php echo $visiteur[$i]["Marque"]?></td>
            <td><?php echo $visiteur[$i]["Modele"]?></td>
            <td><?php echo $visiteur[$i]["Prix"]?></td>
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>

 
