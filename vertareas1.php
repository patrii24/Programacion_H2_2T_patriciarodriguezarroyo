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
        <!<!-- la barra de navegacion es la misma que en tareas ya que el usuario esat registrado e iniciado sesion -->
        <nav class="navbar">
            <a href="tareas.php">tareas</a>
            <a href="vertareas1.php">ver tareas</a>
            <a href="cerrarsesion.php">cerrar sesion</a>
        </nav>
        <?php
        /* para mostar las tareas solo puede ver las tareas donde el correo sea el mismo con el que se ha creado la tarea */
        session_start();
        $correo=$_SESSION['correo'];
        $conexion=new mysqli("127.0.0.1","root","campusfp","tareas");
        $mostrar="select * from tarea where correo='$correo';";
        $resul = $conexion -> query($mostrar);
        /*  se muestra la tabla de las tareas */
         echo "<table border=1";
                    echo"<tr>
                        <th>id tarea</th>
                        <th>correo</th>
                        <th>nombre</th>
                        <th>descripcion</th>
                        <th>estado</th>
                        <th>eliminar tarea</th>
                    </tr>";
            while ($row=$resul ->fetch_assoc()){
                echo"<tr>";
                $id=$row['id_tarea'];
                    echo "<td>". $row['id_tarea']."</td>";
                    echo "<td>". $row['correo']."</td>";
                    echo "<td>". $row['nombretarea']."</td>";
                    echo "<td>". $row['descripcion']."</td>";
                    echo "<td>". $row['estado']."</td>";
                    echo "<td><a href='vertareas1.php?eliminar=$id' name='eleiminar'>eliminar</a></td>";
                echo "</tr>";
             }
             /*  para elimar la tarea el usuario debe seleccionar el boton eliminar de la tabla y se eliminara la tarea */
            if (!empty($_GET['eliminar'])){
                $eliminado=$_GET['eliminar'];
                $elim="delete from tarea where id_tarea='$eliminado'";
                if($conexion -> query($elim)=== TRUE){
                    header("Location: vertareas1.php");
                    echo "se ha eliminado la tarea: ". $eliminado;
                    }
            } 
        ?>
    </body>
</html>
