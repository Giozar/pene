<?php
        //indica que el usuario inicio sesion
        session_start();
        //si el usuario no se encontro
        if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo_empleado'])) {
            //lo redirecciona a iniciar sesion
            header('Location:../formulario_login.html');
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de pacientes</title>
</head>
<body>
    <header>
        <?php echo "! Hola, usted es {$_SESSION['tipo_empleado']}!<br>"; ?>
        <div>
            <h3>
                Registro de paciente
            </h3>
        </div>
        <a href="../principal.php">Regresar</a> <br><br>
    </header>

    <div>
        <form action="registro_paciente.php" method="POST">

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
                <label for="fecha">Fecha</label>
                <input type="text" name="fecha" id="fecha">
            </div>

            <div>
                <!-- <label for="edad">Edad</label> -->
                <input type="text" name="edad" id="edad" >
            </div>

            <div>
                <label for="deficiencia">Deficiencia</label>
                <input type="text" name="deficiencia" id="deficiencia">
            </div>

            <div>
                <label for="alergia">Alergia</label>
                <input type="text" name="alergia" id="alergia">
            </div>

            <div>
                <label for="area">Area mas cercana</label>
                <input type="text" name="area" id="area">
            </div>

            <div>
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo">
            </div>

            <div>
                <label for="contra">Contraseña</label>
                <input type="password" name="contra" id="contra">
            </div>

            <div>
                <label for="tel">Numero telefonico</label>
                <input type="tel" name="tel" id="tel">
            </div>

            <input type="submit" value="Enviar datos">

        </form>
    </div>
    
</body>
<script src="../../src/js/script.js"></script>
</html>