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
        <a href="login.php">Iniciar sesion</a> <br><br>
    </header>

    <div>
        <form action="registro.php" method="POST">

        <div>
                <label for="id">Id</label>
                <input type="number" name="id" id="id">
            </div>

            <div>
                <label for="nomJ">Nombres</label>
                <input type="text" name="nomJ" id="nomJ">
            </div>

            <div>
                <label for="apepJ">Apellido paterno</label>
                <input type="text" name="apepJ" id="apepJ">
            </div>

            <div>
                <label for="apemJ">Apellido materno</label>
                <input type="text" name="apemJ" id="apemJ">
            </div>

            <div>
                <label for="areaJ">Area encargado</label>
                <input type="text" name="areaJ" id="areaJ">
            </div>

            <div>
                <label for="tipoJ">Tipo de jefe</label>
                <input type="text" name="tipoJ" id="tipoJ">
            </div>

            <div>
                <label for="correJ">Correo</label>
                <input type="email" name="correoJ" id="correoJ">
            </div>

            <div>
                <label for="contraJ">Contraseña</label>
                <input type="password" name="contraJ" id="contraJ">
            </div>

            <input type="submit" value="Enviar datos">

        </form>
    </div>
    
</body>
<script src="src/js/script.js"></script>
</html>