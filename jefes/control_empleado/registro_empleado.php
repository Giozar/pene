<?php
        //se llama al metodo sesion
        session_start();
        //si el usuario no se encontro
        if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo_jefe'])) {
            //lo redirecciona a iniciar sesion
            header('Location:../formulario_login.html');
        }
?>
<?php
    $empleados = [
            $_POST['id'], 
            $_POST['nom'],
            $_POST['apep'],
            $_POST['apem'],
            $_POST['area'],
            $_POST['tipo'],
            $_POST['correo'],
            $_POST['contra']
            //password_hash($_POST['contra'],PASSWORD_DEFAULT, array('cost'=>12)) <------contraseña con hash(contra encriptada)
        ];
    
    echo '<a href="formulario_empleado.php">Registrar empleado</a> <br>'; 
    echo '<a href="../principal.php">Principal</a> <br>'; 

    function dato_repetido($datos, $empleados)
        {
            $es = false;
            if ( 
                $datos['nombre'] == $empleados[1]            &&  
                $datos['apellido_paterno'] == $empleados[2]  && 
                $datos['apellido_materno'] == $empleados[3] 
                ) {
                    echo 'el nombre ya existe'; 
                    $es = true; 
                }
            return $es;
        }

        function registra_datos($resultado, $base, $empleados){
            $registra = 'INSERT INTO empleados (id, nombre, apellido_paterno, apellido_materno, area, tipo_empleado, correo, contrasena) 
            VALUES (:id,:nom,:apep,:apem,:area,:tipo,:correo,:contra)';
            $resultado = $base->prepare($registra);
            $resultado->execute(array(':id'=>$empleados[0],
            ':nom'=>$empleados[1],
            ':apep'=>$empleados[2],
            ':apem'=>$empleados[3],
            ':area'=>$empleados[4],
            ':tipo'=>$empleados[5],
            ':correo'=>$empleados[6],
            ':contra'=>$empleados[7]
            ));
            echo 'registro guardado';
        }

    try{ 
        require("../../conexion/conexion.php");

        $busqueda = "SELECT nombre, apellido_paterno, apellido_materno, area, tipo_empleado, correo, contrasena FROM empleados 
        WHERE  nombre = :nom AND apellido_paterno = :apep AND apellido_materno = :apem AND area = :area AND tipo_empleado = :tipo AND correo = :correo AND contrasena = :contra";
        
        $resultado = $base->prepare($busqueda);
        
        $resultado->execute(array(':nom'=>$empleados[1],':apep'=>$empleados[2],':apem'=>$empleados[3],':area'=>$empleados[4],':tipo'=>$empleados[5],':correo'=>$empleados[6],':contra'=>$empleados[7]));
        
        if ( $resultado->rowCount()>0 ) {
            
            while ($datos = $resultado->fetch(PDO::FETCH_ASSOC)) { 

                if ( (dato_repetido($datos,$empleados))  ) {  
                    exit();
                } 
            }
            
            registra_datos($resultado, $base, $empleados);
        }else { 
            
            registra_datos($resultado, $base, $empleados);
        }

        $resultado->closeCursor();

    }catch(Exception $e){
        if ($e->getCode() == 23000) {

            echo 'El Id ya existe' ;
            exit();
        }
        //nos dice el error
        die('error:' . $e->getMessage());

        //finaliza o cierra la base de datos
    }finally{
        $base = null;
    } 
?>