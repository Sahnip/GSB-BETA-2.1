<!-- Affichage des informations sur les visiteurs-->

<div class="container">

    <table class="table table-bordered table-striped table-condensed">

      <thead>
        <tr>
          <th>Matricule</th>
          <th>Nom</th>
          <th>Prenom</th>
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

            <td><?php echo $visiteur[$i]["VIS_MATRICULE"]?></td>
            <td><?php echo $visiteur[$i]["VIS_NOM"]?></td>
            <td><?php echo $visiteur[$i]["VIS_PRENOM"]?></td>
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>

 
