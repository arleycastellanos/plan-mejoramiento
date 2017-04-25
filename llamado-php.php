<?php



    include ('BD.php');
    $nb_m=new BD();    // llama la clase BD
           
    //$nb_m->probando();


    if( isset( $_GET[ 'chain' ] ) )
    {     
        $values=$_GET['chain'];
        //echo  $nb_m->consultar($values);
        //echo $sql;
       echo  $nb_m->consulta($values);
   

    }
     if( isset( $_GET[ 'busqueda' ] ) )//Recibe todo loq ue contiene busqueda y hace una busqueda en la base de datos mediante la función
    {  
        if ($_GET['busqueda']!="") 
        {
           $values=$_GET['busqueda'];
           echo  $nb_m->buscar($values);//Se trae la función buscar que se encuentra en el BD.php
           echo $sql;
           echo $values;
        }
        
    }

  ?>
