<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel='stylesheet' href="estiilos.css">
    </head>
    <body>
        <!<!-- barra de navegacion esta varia dependiendo de si el usuario esta registrado o no -->
        <nav class="navbar">
            <a href="index.php">Inicio sesion</a>
            <a href="registro.php">registro</a>
        </nav>
        <!<!-- el formulario con los campos correo y contraseña  -->
        <form action='' method='GET'>
            <p>inicia sesion con tu correo electronico y contraseña</p>
            <p>correo electronico</p>
            <input type='email' name='email' required>
            </br>
            <p>contraseña</p>
            <input type="password" id='password' name='password' required>
            <input type='submit' value='enviar'>
        </form>
        <?php
        /* abrimos la conexion con la base de datos */
        $conexion=new mysqli("127.0.0.1","root","campusfp","tareas");
        /*ahora si el formulario se entrega rellenado */
        if (!empty($_GET)){
            /* pasasmos la variables del formulario a varibles para que nos sea mas facil su manipulacion*/
            $email=$_GET['email'];
            $contrasena=$_GET['password'];
            /* ahora crearemos un select en la base de datos donde buscaremos el correo */
            $userregistrado="select * from usuarios where correo ='$email';";
            $resultado = $conexion -> query($userregistrado);
            /* si el resultado de la bsuqueda en la base de datos nos da una linea entonces */
            if ($resultado-> num_rows==1){
                $fila = $resultado->fetch_assoc();
                /*entonces crearemos otra busqueda en la base de datos para comprobar la contraseña */
                /* ya que la contraseña esta encriptada usaremos el password verify para desencriptarla y comprobar que sean iguales */
                if(password_verify($_GET['password'],$fila['contrasena'])){
                    /* si la contraseña y el correo son iguales entonces entonces se inicia sesion con el correo */
                    session_start();
                    $_SESSION['correo']=$email;
                    /* mostraremos un mensaje para que el usuario sepa que se ha iniciado sesion  */
                    echo "usuario registrado anteriormente";
                    echo "</br>";
                    echo "se ha iniciado sesion con: ". $_SESSION['correo'];
                    /* lo llevaremos a la pagina de tareas ya que ahora el usuario solo prodra mirar y crear tareas y cerrar sesion */
                    header("Location: tareas.php");
                }
            }
            else{
                /* si la contraseña o el correo no coninciden se mostrara un mensaje  */
                    echo"el correo o la contraseña son incorrectos";
                }
         }

        ?>
    </body>
</html>
