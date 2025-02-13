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
        <!<!-- la barra de navegacion cambia correctamente para que el usuario solo pueda iniciar o registrarse ya que se ha cerrado sesion -->
        <nav class="navbar">
            <a href="index.php">Inicio sesion</a>
            <a href="mostrar.php">registro</a>
        </nav>
        <?php
        /* la sesion se inicia y seguidamente se destruye */
        session_start();
        session_destroy();
        /* se muestra el mensaje de que se ha cerrado sesion */
        echo "se ha cerrado sesion";

        ?>
    </body>
</html>
