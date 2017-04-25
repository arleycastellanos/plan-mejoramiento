<html ng-app="acumuladorApp">
	<head> 

		<title>buscador</title>
			<?php
				include ('llamado-php.php');
				/*Se nombra una variable para crear un nuevo objeto*/
				$obj_o= new BD;
				/* trae la función estilos de bootstrap de la clase */
				echo $obj_o->estilos("bootstrap"); 
			?>
			<script type="text/javascript" src="js/angular.min.js"></script>
			
	</head>
	<body>
		<div ng-controller="acumuladorAppCtrl"><!--Super importante el controlador aquí-->

			<div class='row' >

			  	<br>

			  		<div class='col-xs-12 col-md-4 '>
			  		<label><h2>Buscar en manual tecnico angular js</h2></label>
						<input type="text" class="form-control" ng-model="text_busqueda" ng-change="busqueda();" placeholder="buscador"> 
						<div ng-repeat="x in row">
							<div class='row'>		
						<br>
						<br>
					</div>
				</div>
				<hr>
				

					 <strong><li>{{ x.nombres }}</li></strong><!--trae en pantalla el titulo de una consulta-->
						    {{ x.Descripcion }} <!--trae en pantalla la descripción de una consulta-->
						    {{ x.palabras_clave }}<!--palabras claves de la consiulta-->
						   	<img ng-src="{{ x.img }}">
					    </div>
			    	</div>
			    	<br><hr>
				</div>	



 
				 <script type="text/javascript" src="js/mi_js.js"></script><!--Se llama las funciones del AngularJs-->

			</div>
		</div>
		<a href="index.php"><button class="btn btn-success">VOLVER</button></a>
	</body>
</html>
