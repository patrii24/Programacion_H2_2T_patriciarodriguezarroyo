<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel='stylesheet' href="estiilos.css">
    </head>
    <body>
        <!<!-- la barra de navegacion cambia porque ya ha iniciado sesion por tanto puede crear y ver tareas y cerrar sesion -->
        <nav class="navbar">
            <a href="tareas.php">tareas</a>
            <a href="vertareas1.php">ver tareas</a>
            <a href="cerrarsesion.php">cerrar sesion</a>
        </nav>
        <!<!-- formulario para crear una tarea  -->
        <form action='' method='GET'>
            <p>añade nombre a la tarea</p>
            <input type='text' name='nombre'>
            <p>descripcion</p>
            <input type="text" name='descripcion'>
            <p>estado de la tarea</p>
            <label><input type="checkbox" name="completada" value="completado">completado</label>
            <label><input type="checkbox" name="en_proceso" value="en_proceso">en proceso</label>
            <input type='submit' value='enviar'>
        </form>
        <?php
        /* se inicia sesion y se crea la conexion */
        session_start();
        $conexion=new mysqli("127.0.0.1","root","campusfp","tareas");
        /* pasamos a bolleano los datos de el esatdo para qeu solo pueda seleccionar uno */
        $completado = isset($_GET["completada"])? 1:0;
        $proceso = isset($_GET["en_proceso"])? 1:0;
        /* si el formulario se rellena entonces */
        if (!empty($_GET)){
            /* si completado y proceso suman mas de uno mostrara error */
            if ($completado + $proceso >1){
                echo "error, solo se puede seleccionar un estado para cada tarea";
            }
            /* si completado mas proceso son igual a 1 entonces*/
            if ($completado + $proceso ==1){
                /* se muestra que la tarea se ha añadido con exito */
                echo "se ha añadido la tarea con exito";
                $correo=$_SESSION['correo'];
                $nombre=$_GET['nombre'];
                $descripcion=$_GET['descripcion'];
                $estadocomple=$completado;
                $estadoproce=$proceso;
                /* si completado es igual a uno a la tarea se añadde el estado de completado */
                if($estadocomple==1){
                $insertar="insert into tarea (correo,nombretarea,descripcion,estado) values ('$correo','$nombre','$descripcion','completada')";
                $resultad = $conexion -> query($insertar);
                header("Location: vertareas1.php");
                }
                /*  si a la el esatdo proceso es igual a uno entonces se añade el esatdo de en proceso */
                if($estadoproce==1){
                $insertar="insert into tarea (correo,nombretarea,descripcion,estado) values ('$correo','$nombre','$descripcion','en proceso')";
                $resultad = $conexion -> query($insertar);
                header("Location: vertareas1.php");
                }
        }
        /* si no se rellena el formulario */
        if(empty($_GET)){
            echo"no se ha rellenado el formulario";
        }
        }
        ?>
    </body>
</html>
