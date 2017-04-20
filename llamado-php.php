<?php



    include'class/BD.php';
    $nb_m=new BD();    // llama la clase BD
           
     if( isset( $_GET[ 'cadena' ] ) )
    {     
        $valores=$_GET['cadena'];
        echo  $nb_m->consultar($valores);
        //echo $sql;

    }
     if( isset( $_GET[ 'busqueda' ] ) )//Recibe todo loq ue contiene busqueda y hace una busqueda en la base de datos mediante la función
    {  
        if ($_GET['busqueda']!="buscar.php") 
        {
           $valores=$_GET['busqueda'];
           echo  $nb_m->buscar($valores);//Se trae la función buscar que se encuentra en el BD.php
           echo $sql;
        }
        
    }

  ?>
