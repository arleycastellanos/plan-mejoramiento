<?php 
/**
*dubier perez / jeison salgado
*/
/**
*esta clase contiene todas las funciones del proyecto
*/
include ('class/Graficos.php');

class BD extends Graficos

	{

		public $Connection; //variable publica
 		
		function BD ()/**funcion que cumple con el constructor*/
		{
			$this->Connection=$this->create_connecting();
		
		}
		
		/*@return       caracteres    retorna mysqli_connect.
		*/
		 function create_connecting ()/**esta funcion se encarga de crear la conexion con el seridor.*/
		 {
		 	include('config.php');
		 	return mysqli_connect($servidor,$usuario,$clave,$bd);
		 }



		 function see_tables($Field_to_show,$sql_antes=null)/**esta funcion se encarga de traer la información de las tablas de la base de datos.*/

		 {//esta funcion se encarga realizar la consulta en la tabla.		 	
		 	$sql = "SELECT $sql_antes $Field_to_show from tb_enfermedades ,tb_sintomas , tb_informe where tb_informe.id_enfermedad=tb_enfermedades.id_enfermedad and tb_informe.id_sintomas=tb_sintomas.id_sintomas";
		 	$result = $this->Connection->query( $sql );	
		 	return $result;
		 }


		 function read_field ($result,$th)//esta funcion se encarga de leer los datos de la tablas.
		   {
				 	$departure = 
				      "<table class='table-bordered table-striped'>
				        <thead>
		                 <tr>
		                  $th
		                 </tr>
		                </thead>";
		    $departure .= "<tr>";

		 	while( $row = mysqli_fetch_array( $result ) )
				{
					for( $i = 0; $i < mysqli_num_fields( $result ); $i ++ )
					$departure .="<td>".$row[ $i ]."</td>";
					$departure .= "</tr>";
				}
			$departure .= "</table>";

			return $departure;	
		 }


		 function bring_information( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar,$method,$action )//esta funcion se encarga de traer la informacion en pantalla
		 {
				$departure = "";
			    include 'config.php';

				$sql = "SELECT * FROM  $tabla ";
				               
				echo $sql;
				                          //este son los codigos del titulo//	
				if($sn_pruebas=="s") echo "<h2><b><p class='bg-success'>SELECT YOUR SYMPTOM</p></b></h2>";
				$result = $this->Connection->query( $sql );

			$departure = "<SELECT  id='sintomas' ng-model='lista' ng-change='cargar_datos_php()' multiple size='20' class='form-control'>";

								$contador=0;
							while( $row = mysqli_fetch_assoc( $result ) )
							{
									
									
								$departure .=
									 "<tr>
									 	<td>
										 
											<option value='".$row[ $campo_llave_primaria ]."'>".$row[ $campo_a_mostrar ]."</option>

										</td>
									 </tr>";
									
							}
							
							
		$departure .=" </tbody>
					</table>
					<input type='hidden'  >
					
				 ";

		return $departure;	


		} // ---------------------------------------------------------------


		 function consulta($values)//esta funcion se encarga realizar la consulta en la tabla.

		 {
		 	 	include( "config.php" );
        	
		        header("Access-Control-Allow-Origin: *");
		        header("Content-Type: application/json; charset=UTF-8");
		        
		        $conn = new mysqli( $servidor, $usuario, $clave, $bd );
		        

		     		$sql  = " SELECT tb_enfermedades.enfermedad , ";
		     		$sql .= " COUNT(tb_informe.id_enfermedad) as conteo_sintomas , ";

		     		$sql .= " ( SELECT COUNT(tb_informe.id_enfermedad) conteo_total ";
		     		$sql .= " FROM tb_informe where tb_enfermedades.id_enfermedad = tb_informe.id_enfermedad ";
		     		$sql .= " GROUP BY id_enfermedad) as conteo_total ";

		     		$sql .= " FROM tb_informe , tb_enfermedades ";
		     		$sql .= " WHERE tb_informe.id_enfermedad = tb_enfermedades.id_enfermedad ";
		     		$sql .= " AND tb_informe.id_sintomas in( $values ) ";
		     		$sql .= " GROUP BY tb_informe.id_enfermedad";
			        $result = $this->Connection->query( $sql );	
		        
			        //echo $sql."<br>";

		            $outp = "";
		       
		        
		        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
		        {
		            if ($outp != "") {$outp .= ",";}
		            $outp .= '{"Enfermedad":"'.utf8_encode($rs["enfermedad"]).'",';            
		            $outp .= '"conteo_sintomas":"'.$rs["conteo_sintomas"].'",';         
		           	$outp .= '"abc":"'.$sql.'",';
		            $outp .= '"conteo_total":"'.$rs["conteo_total"].'"}';
		            
		          
		        }
		        
		        $outp ='{"records":['.$outp.']}';
		        $conn->close();
		        
		        return $outp; 

		 }	 // fin consulta --------------------------- 

		 	/**
		 	* Esta era la anterior función de consulta. 
		 	* @param 		texto  		El valor de la consulta.
		 	*
		 	*/

	        function search($values)//esta funcion se encarga realizar la consulta en la tabla.
			{
				
				    //COnexión a la base de datos.
			        include( "config.php" ); 
			        
			        //Esta conexión se realiza para la prueba con angularjs
			        header("Access-Control-Allow-Origin: *");
			        header("Content-Type: application/json; charset=UTF-8");
			        
			        $conn = new mysqli( $servidor, $usuario, $clave, $bd );
			        
			        //Se busca principalmente por alias.
			        
			        $consulta = explode(",", $values);
			        //echo $consulta;
			       
			        if ($values == "manual técnico") {
			        	
			        	$sql  = " SELECT * FROM tb_manuales";
			       	}else{
					$sql  = " SELECT * FROM tb_buscador WHERE ";
				        for ($i=0; $i < count($consulta); $i ++) { 
				        	
				        	$sql .= " Manual LIKE '%".$consulta[$i]."%'";
				        	$sql .= " OR descripcion LIKE '%".$consulta[$i]."%'";
				        	$sql .= " OR url LIKE '%".$consulta[$i]."%'";
				        	if ($i < (count($consulta)-1)) $sql.=" or ";
				        	echo $sql;
				        }
			        }
			       

			        
			        
			        //echo $sql;
			        //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
			        $result = $conn->query( $sql );
			        
			        $outp = "";
			        
			        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
			        {
			            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
			            if ($outp != "") {$outp .= ",";}
			            
			            $outp .= '{"Manual":"'.utf8_encode($rs["manual"]).'",';
			            $outp .= '"Descripcion":"'.utf8_encode($rs["descripcion"]).'",';     // <-- La tabla MySQL debe tener este campo.
			            $outp .= '"Img":"'.$rs["url"].'"}';            // <-- La tabla MySQL debe tener este campo.
			        }
			        
			        $outp ='{"records":['.$outp.']}';
			        $conn->close();
			        
			        echo($outp);
				
			} 
	
		function probando()
		{

		}		 

	} // FIn de la clase ...  class BD extends Graficos ------------------------ No tocar Do not touch ..


 ?>
