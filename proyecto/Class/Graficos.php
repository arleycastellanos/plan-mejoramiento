<?php 
	class Graficos
	 {
		/*
		*autores dubier perez/jeison salgado
        *esta el funcion que contiene todos los link de bootstrap
        */
		function estilos($carpeta=null)
			{
				$salida="";

				$salida=" <link rel='stylesheet'  type='text/css' href='$carpeta/css/bootstrap.css'>
						 <script src='$carpeta/js/jquerymin.js'></script>
						 <script src='$carpeta/js/bootstrap.min.js'></script>";
				return $salida;		 
			}
			function imagen()
			{/*funciones de la imagen del prototipo
			 */	
			
				$salida="<img class='img img-responsive' src='img/Captura.png'>";
				
			}


		
		
	 }




 ?>
