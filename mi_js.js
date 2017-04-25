var acumuladorApp = angular.module( 'acumuladorApp', [] );

    acumuladorApp.controller( "acumuladorAppCtrl",  


        [ "$scope", "$http",

            function( $scope, $http )
            {






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
		            			$http.get('llamado-php.php?chain=' + chain)
    							.then(
    								function (response) 
    									{
    										$scope.campos = response.data.records;
    									}
									);
		            			 
		                            console.log("valor que deberia llegar al php  "   + chain);  
		            		}             
                    }
                    $scope.buscar = function(b)
                {
                    var buscar = $scope.text_busqueda;    
                    console.log(buscar);
                    //Aquí se hace el llamado a un php con conexión a MySQL.
                     $http.get( 'llamado-php.php?busqueda=' + buscar ).success
                     (
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
	
