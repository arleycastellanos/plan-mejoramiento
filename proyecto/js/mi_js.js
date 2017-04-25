/*
*autores dubier perez/jeison salgado
*/

var acumuladorApp = angular.module( 'acumuladorApp', [] );

    acumuladorApp.controller( "acumuladorAppCtrl",  


        [ "$scope", "$http",
            /*
            *esta es la funcion es la que hace parte del estilo del prototipo
            */
            function( $scope, $http )
            {





                /*
                *esta es la funcion que sire para traer las enfermedades de la base de datos
                */
            	$scope.cargar_datos_php=function()
					                      
                    {          
		                    
		            		console.log( '' );
		            		
		            		//console.log($scope.lista.length);
		            		
		            		var lista=document.getElementById('sintomas');
		            		//console.log("esta es la seleccion  "+ lista);  		            		
		            		//&console.log("esta es la cantidad de sintomas seleccones  " +lista.length); 
		            		var exit="";
		            		var chain="";

		            		for (var i = 0; i < lista.length; i++)
		            		 {	
			            		   if (lista.item(i).selected) 
			            		   {
				            		   	if (exit!="") 
				            		   	{
				            		   		exit+=","+lista.item(i).value;
				            		   		

				            		   	}else{
				            		   		
				            		   		exit+=lista.item(i).value;
				            		   	}
				            		  

			            		   }                 	
		            		 } 
		            		console.log(' ' + exit);
		            		chain=exit;

		            		if(chain.length>0)
		            		{
		            			console.log(exit);
		            			//se hace el llamado a un php con una conexion MySQL
		            			$http.get('llamado-php.php?chain=' + chain)
    							.then(
    								/*
    								*esta es la funcion que se encarga de traer la respuesta de lo que solicitamos
    								*/
    								function (response) 
    									{
    										$scope.campos = response.data.records;
    									}
									);
		            			 
		                            console.log("valor que deberia llegar al php  "   + chain);  
		            		}             
                    }
                /* 
                *esta es la funcion es la que se encarga de buscar.
                */
                $scope.buscar = function(b)
                {
                    var buscar = $scope.text_busqueda;    
                    console.log(buscar);
                    //Aquí se hace el llamado a un php con conexión a MySQL.
                    $http.get( 'llamado-php.php?busqueda=' + buscar ).success
                    (

                    	/*
    					*esta es la funcion que se encarga de traer la respuesta de lo que solicitamos
    					*/
						function( response ) 
						{ 
						    console.log( 'response' );
						    $scope.campos = response.records;   
						}    
                        
					);                   
					
            	}
            }
            	
        ]
    );
	
