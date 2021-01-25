<?php 


 $sql_code = "SELECT * FROM indicadordepartamental WHERE anob = 2017";
  $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
  $linha = $sql_query->fetch_assoc();

 ?>

 <table border=1 cellpadding=10 class="table">
 <tr class= titulo>
   <td>departamental</td>
   <td>empresarial</td>
   <td>ano base</td>
   <td>Melhor traj</td>
  	<td>und medida</td>
  	<td>form</td>
  	<td>obs</td>

   
   
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     
 </tr>  
 </div> </center>


 <?php
 do{
 ?>
 <tr>
  <td><?php echo $linha['id_inddep'];?></td> 
  <td><?php echo $linha['id_indempre'];?></td> 
  <td><?php echo $linha['anob'];?></td> 
  <td><?php echo $linha['melhor_traj'];?></td> 
  <td><?php echo $linha['und_med'];?></td> 
  <td><?php echo $linha['formula'];?></td> 
  <td><?php echo $linha['obs'];?></td> 
   
  
  
 </tr>
 <?php } while($linha = $sql_query->fetch_assoc()); ?>
  </table>  