<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <?php
    //variable que auntentifica si el usuario entra o inicia sesión// al principio es falso
    $autenticar = false;
    $nombre;//<----variable nueva creada
    //se se mandoa el formulario hace lo siguiente
        if (isset($_POST['btn'])) {
            try {
                //adquiere el nombre en entidat html con barras invertidas
                //$login adquiere el nombre del usuario
                //$pasword adquiere la contraseña ingresada
                $password=htmlentities(addslashes($_POST['pass']));
                $login=htmlentities(addslashes($_POST['nombre']));
                $contador = 0;
                require("../conexion/conexion.php");
                //se declara la instruccion mysql
                $sql='SELECT * FROM jefes WHERE id = :login';
                //se guarda en variable la instruccion preparada
                $resultado=$base->prepare($sql);
                //se busca en la tabla el valor y los compara para verificar que ya esta registrado y si son iguales 
                //$resultado->bindValue(':login',$login);
                //$resultado->bindValue(':password',$password);
                //entra y ejecuta
                $resultado->execute(array(':login'=>$login));
                //si hay datos en la fila de la base de datos que coincidan con los datos introducidos
                while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    if (password_verify($password, $registro['contrasena'])) {
                        $contador++;
                        $nombre = $registro['nombre']; 
                        $autenticar = true;
                        echo 'econtrado'; 
                    }
                }

                if ($contador>0) {//si hay datos encontrados entonces

                    //autentifica que el usuario inicie sesion y es verdadero
                    //si el checkbox de recordar es verdadero//marcado para recordar, se crea la cookie, de lo contrario sigue el codigo
                    if (isset($_POST['recordar'])) {
                        //a la cookie se le da un parametro, que contendra el nombre del usuario dado por el formulario
                        setcookie('nombre_usuario',$nombre,time()+86400);//<-------------------cambio por el nombre
                    }
                }else {
                    //de lo contrario que vuevla a interntar a entrar a la sesion
                    echo 'usuario y contraseña incorrecta';
                }
                //si nada de lo anterior funciona guardame el error en $e
            } catch (Exception $e) {
                //si se cae todo, muetrame el error en mensaje
                die('error: '.$e->getMessage());
            }
            
        };
        
    ?>
    <?php
    //si auntetificar es falso o no inicia sesion, sigue codigo
        if ($autenticar==false) {
            //si la cookie no está activa, muestra el formulario de nuevo
            if (!isset($_COOKIE['nombre_usuario'])) {
                include('formulario_login.html');
            }//de lo contrario ya habias inicado sesion
        }
        //si la cookie esta creada o aactiva
        if (isset($_COOKIE['nombre_usuario'])) {
            //muetra nuestro nombre con el parametro nombre_usuario
            echo '¡ Hola '.$_COOKIE['nombre_usuario'].' !';
            //si no esta creada la cookie pero el usuario inicia sesion desde el formulario/ se activa antenticar
        }elseif ($autenticar==true) {//si autenticar es verdadero
            //muestra el nombre del usuario
            echo '¡ Hola '.$nombre.' !';//<----------cambio por el nombre
            //
        }
    ?>
    <table>
        <h4></h4>
        <tr>
            <td><img src="imagenes/1.svg" alt=""></td>
            <td><img src="imagenes/1.svg" alt=""></td>
        </tr>
        <tr>
            <td><img src="imagenes/1.svg" alt=""></td>
            <td><img src="imagenes/1.svg" alt=""></td>
        </tr>
    </table>
    <?php
        if ($autenticar == true || isset($_COOKIE['nombre_usuario'])) {
            include("principal.html");
        }
    ?>
</body>
</html>