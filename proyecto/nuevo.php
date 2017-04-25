<!DOCTYPE html>
<html ng-app="acumuladorApp">
     <head>
	       <title></title>
	 <?php 
		include 'BD.php'; 
		$nuevo_obj=new BD(); 
	 ?>
	      <script src="js/angular.min.js"></script>

     </head>
     <body>
	 <div ng-controller="acumuladorAppCtrl">
			<?php 	

			
				//echo $nuevo_obj->traer_informacion("sintoma","tb_sintomas","id_sintomas","sintoma","get","ver.php"); // trae la información a mostrar.
				echo $nuevo_obj->bring_information("sintoma","tb_sintomas","id_sintomas","sintoma","get","ver.php"); // trae la información a mostrar.
		
			 ?>
			 <div ng-repeat="x in campos">		
	            	Enfermedad: {{ x.Enfermedad }} Sintomas Encontrados: {{ x.conteo_sintomas }}  Sintomas en total: {{ x.conteo_total }} Recomendaciones: {{x.Recomendaciones}}				       
			 </div>
	 </div>
	 <script type="text/javascript" src="js/mi_js.js"></script>
     </body>
</html>
