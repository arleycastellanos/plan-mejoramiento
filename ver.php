<!--
*dubier perez/jeison salgado
-->
<?php 

$values            = "";
$caracter_separador = ",";
$total_campos=$_GET['contador'];
echo $total_campos."<br>";
for( $i = 0; $i <= $total_campos; $i ++ )       

        {
              if (isset($_GET['sintoma'.$i]))
               {
                  if ($value!="") 
                   {
                     $value+=",".$_GET['sintoma'.$i];
                   }else{
                         $value+=$_GET['sintoma'];
                        }   
      	       }
   			}
        
        echo $values;
       include ('BD.php');
    $nuevo_obj=new BD();
      echo $nuevo_obj->leer_campo( $nuevo_obj->consultar($values),"<th>Id_enfermedad</th> <th>Enfermedad</th><th>Id_sintoma</th><th>Sintoma</th><th>Id_Informe</th><th>Id_enfermedad</th><th>Id_Sintoma</th>");
      echo $nuevo_obj->Styles("bootstrap"); //trae la función estilos de bootstrap de la clase

?>


<?php

    include('BD.php');
    $nuevo_obj=new BD();    // llama la clase BD
           
     if( isset( $_GET[ 'chain' ] ) )
    {     
        $values=$_GET['chain'];
        echo  $nuevo_obj->consultar($values);
        //echo $sql;
    }
  ?>
