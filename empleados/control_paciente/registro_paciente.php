<?php
        //indica que el usuario inicio sesion
        session_start();
        //si el usuario no se encontro
        if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo_empleado'])) {
            //lo redirecciona a iniciar sesion
            header('Location:../formulario_login.html');
        }
?>
<?php
    $paciente = [
            $_POST['id'], 
            $_POST['nom'],
            $_POST['apep'],
            $_POST['apem'],
            $_POST['fecha'],
            $_POST['edad'],
            $_POST['deficiencia'],
            $_POST['alergia'],
            $_POST['area'],
            $_POST['correo'],
            $_POST['contra'],
            $_POST['tel']
            //password_hash($_POST['contra'],PASSWORD_DEFAULT, array('cost'=>12)) <------contraseña con hash(contra encriptada)
        ];
    
    echo '<a href="formulario_paciente.php">Registrar paciente</a> <br>'; 
    echo '<a href="../principal.php">Principal</a> <br>'; 

    function dato_repetido($datos, $paciente)
        {
            $es = false;
            if ( 
                $datos['nombre'] == $paciente[1]            &&  
                $datos['apellido_paterno'] == $paciente[2]  && 
                $datos['apellido_materno'] == $paciente[3] 
                ) {
                    echo 'el nombre ya existe'; 
                    $es = true; 
                }
            return $es;
        }

        function registra_datos($resultado, $base, $paciente){
            $registra = 'INSERT INTO paciente (id, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, edad, deficiencia, alergia, area, correo, contrasena, telefono) 
            VALUES (:id,:nom,:apep,:apem,:fecha,:edad,:deficiencia,:alergia,:area,:correo,:contra,:tel)';
            $resultado = $base->prepare($registra);
            $resultado->execute(array(
            ':id'=>$paciente[0],
            ':nom'=>$paciente[1],
            ':apep'=>$paciente[2],
            ':apem'=>$paciente[3],
            ':fecha'=>$paciente[4],
            ':edad'=>$paciente[5],
            ':deficiencia'=>$paciente[6],
            ':alergia'=>$paciente[7],
            ':area'=>$paciente[8],
            ':correo'=>$paciente[9],
            ':contra'=>$paciente[10],
            ':tel'=>$paciente[11]
            ));
            echo 'registro guardado';
        }

    try{ 
        require("../../conexion/conexion.php");

        $busqueda = "SELECT id, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, edad, deficiencia, alergia, area, correo, contrasena, telefono FROM paciente 
        WHERE  nombre = :nom AND apellido_paterno = :apep AND apellido_materno = :apem AND fecha_nacimiento = :fecha AND edad = :edad AND deficiencia = :deficiencia AND alergia = :alergia AND area = :area  AND correo = :correo AND contrasena = :contra AND telefono = :tel";
        
        $resultado = $base->prepare($busqueda);
        
        $resultado->execute(array(':id'=>$paciente[0],
            ':nom'=>$paciente[1],
            ':apep'=>$paciente[2],
            ':apem'=>$paciente[3],
            ':fecha'=>$paciente[4],
            ':edad'=>$paciente[5],
            ':deficiencia'=>$paciente[6],
            ':alergia'=>$paciente[7],
            ':area'=>$paciente[8],
            ':correo'=>$paciente[9],
            ':contra'=>$paciente[10],
            ':tel'=>$paciente[11]
            ));
        
        if ( $resultado->rowCount()>0 ) {
            
            while ($datos = $resultado->fetch(PDO::FETCH_ASSOC)) { 

                if ( (dato_repetido($datos,$paciente))  ) {  
                    exit();
                } 
            }
            
            registra_datos($resultado, $base, $paciente);
        }else { 
            
            registra_datos($resultado, $base, $paciente);
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