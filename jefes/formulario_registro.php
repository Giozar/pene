<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de jefe</title>
</head>
<body>
    
    <header>
        <div>
            <h3>
                Registro de jefes
            </h3>
        </div>
        <?php
            //se llama al metodo sesion
            session_start();
            // si no existe una sesion inicada de un jefe
            if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo_jefe']) ) {
                //lo redirecciona a iniciar sesion
                header('Location:formulario_login.html');
            }else{
                echo '<a href="principal.php">Regresar</a> <br>'; 
                
            }
        ?>
    </header>

    <div>
        <form action="registro.php" method="POST">

        <div>
                <label for="id">Id</label>
                <input type="number" name="id" id="id">
            </div>

            <div>
                <label for="nom">Nombres</label>
                <input type="text" name="nom" id="nom">
            </div>

            <div>
                <label for="apep">Apellido paterno</label>
                <input type="text" name="apep" id="apep">
            </div>

            <div>
                <label for="apem">Apellido materno</label>
                <input type="text" name="apem" id="apem">
            </div>

            <div>
                <label for="area">Area encargado</label>
                <input type="text" name="area" id="area">
            </div>

            <div>
                <label for="tipo">Tipo de jefe</label>
                <input type="text" name="tipo" id="tipo">
            </div>

            <div>
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo">
            </div>

            <div>
                <label for="contra">Contraseña</label>
                <input type="password" name="contra" id="contra">
            </div>

            <input type="submit" value="Enviar datos">

        </form>
    </div>
    
</body>
<script src="../src/js/script.js"></script>
</html>