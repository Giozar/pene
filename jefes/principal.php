<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal jefe</title>
</head>
<body>
    <?php
        //se llama al metodo sesion
        session_start();
        //si el usuario no se encontro
        if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo_jefe']) ) {
            //lo redirecciona a iniciar sesion
            header('Location:formulario_login.html');
        } 
        ?>

    <header>
        <h3>
            <?php
                echo "! Hola {$_SESSION['usuario']}!<br>";
                //si la cookie esta creada o aactiva
                if (isset($_COOKIE['nombre_usuario'])) {
                    //muetra nuestro nombre con el parametro nombre_usuario
                    echo '¡ Hola '.$_COOKIE['nombre_usuario'].' !';
                }
            ?>
        </h3>
        
        <tr>
            <!-- link a pagina de cerra sesion -->
            <th colspan="3"><a href="cerrar_sesion.php">Cerrar sesion</a></th>
        </tr>
    
        <nav>
            <ul>
                <li>
                    <p>Control de usuarios</p>
                    <!-- tendras una opcion de filtrado, ya sea en orden alfabetico o por zona etc -->
                    <!-- modificar datos -->
                    <!-- mandar resultados y mesnajes -->
                </li>
                <li>
                    <a href="control_empleado/formulario_empleado.php">Registro de empleados</a>
                </li>
                <li>
                    <a href="formulario_registro.php">Registrar encargados</a>
                </li>
                <li>
                    <p>Comunicacion</p>
                    <!-- especie de mensajeria -->
                </li>
                <li>
                    <p>Ver actividad por zona</p>
                </li>
            </ul>

        </nav>
    </header>

    <section>
        <h1>Hola Labs</h1>

    </section>

    <footer>
        <p>Acerca de nosotros</p>
    </footer>


    
    



    

</body>
</html>