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
        <!<!-- para la pagina de registro la barra de navegacion sera la misma ya que no pueden ver ni crear tareas ni cerrar sesion -->
        <nav class="navbar">
            <a href="index.php">Inicio sesion</a>
            <a href="registro.php">registro</a>
        </nav>
        <!<!-- el formulario es parecido al de inicio sesion  -->
        <form action='' method='GET'>
            <p>correo electronico</p>
            <input type='email' name='email' required>
            </br>
            <p>contraseña</p>
            <input type="password" id='password' name='password' required>
            <input type='submit' value='enviar'>
        </form>
        <?php
        /* una vez el formulario se rellena*/
        if(!empty($_GET)){
            /* se crea la conexion con la base de datos */
            $conexion=new mysqli("127.0.0.1","root","campusfp","tareas");
            /* las variables se pasan a variables mas simples para que su manejo sea mas facil */
            $email=$_GET['email'];
            $contrasena=$_GET['password'];
            /* encriptamos la contrasela con password_hash */
            $contraseña_encript= password_hash($contrasena, PASSWORD_DEFAULT);
            /* seleccionamos el correo de la base de datos para ver si existe */
            $userregistrado="select * from usuarios where correo ='$email'";
            $resultado = $conexion -> query($userregistrado);
            /* si el correo existe en la base de datos se mostrara un mensaje de que el usuario ya esta registrado y nso mandara a la pagina de inicio sesion*/
            if ($resultado-> num_rows>0){
                echo "usuario registrado anteriormente";
                echo "</br>";
                header("Location: index.php");
            }
            /* si el usuario no existe en la base de datos creaamos un insert para añadirlo */
            if ($resultado ->num_rows <=0){
                echo "el usuario se ha registrado";
                echo "</br>";
                echo "nombre usuario : ". $email;
                echo "</br>";
                echo "ve a la pagina de inicio sesion";
                $registro="insert into usuarios(correo,contrasena) values ('$email','$contraseña_encript')";
                $add = $conexion -> query($registro);
            }
        }
        ?>
    </body>
</html>
