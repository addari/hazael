<h1>Datos Cargados</h1>
<?php
echo "La URL Cargada es: " . $url."<br>";
echo "El Lote de Datos Cargado es: " . $lote. "<br><br>";
 ?>
 <h3>Guardar Datos Cargados</h3> 
 <?php echo CHtml::submitButton('Guardar', array('submit'=>'index.php?r=trackTrTracking/add_url','class'=>"btn btn-success")); //llama a la accion add_url?>


 <table>
 	<?php echo $title; //muestra el contenido de la url contenida en la variable title ?>
 </table>

 
 
 
 

 