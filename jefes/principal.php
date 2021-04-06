<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //idica que el usuario inicio sesion
    session_start();
    //si el usuario no se encontro
    if (!isset($_SESSION['usuario'])) {
        //lo redirecciona a iniciar sesion
        header('Location:login.php');
    } 
    ?>
    <h3>
        <?php
            echo "hola {$_SESSION['usuario']}<br>";
        ?>
    </h3>
    <h1>Hola bienvenido usuario a Labs</h1>

    <tr>
        <!-- link a pagina de cerra sesion -->
        <th colspan="3"><a href="cerrar_sesion.php">Cerrar sesion</a></th>
    </tr>

</body>
</html>