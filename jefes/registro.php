<?php
//se llama al metodo sesion
session_start();
echo '<a href="formulario_registro.php">Regresar</a> <br>'; 
// si no hay una sesion iniciada de un jefe
if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo_jefe']) ) {
    //lo redirecciona a iniciar sesion
    echo '<a href="formulario_login.html">Iniciar sesion</a> <br>'; 
}else{
    echo '<a href="principal.php">Principal</a> <br>'; 
}
    $jefe = [
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
    

    function dato_repetido($datos, $jefe)
        {
            $es = false;
            if ( 
                $datos['nombre'] == $jefe[1]            &&  
                $datos['apellido_paterno'] == $jefe[2]  && 
                $datos['apellido_materno'] == $jefe[3] 
                ) {
                    echo 'el nombre ya existe'; 
                    $es = true; 
                }
            return $es;
        }

        function registra_datos($resultado, $base, $jefe){
            $registra = 'INSERT INTO jefes (id, nombre, apellido_paterno, apellido_materno, area_encargado, tipo_jefe, correo, contrasena) 
            VALUES (:id,:nom,:apep,:apem,:area,:tipo,:correo,:contra)';
            $resultado = $base->prepare($registra);
            $resultado->execute(array(':id'=>$jefe[0],
            ':nom'=>$jefe[1],
            ':apep'=>$jefe[2],
            ':apem'=>$jefe[3],
            ':area'=>$jefe[4],
            ':tipo'=>$jefe[5],
            ':correo'=>$jefe[6],
            ':contra'=>$jefe[7]
            ));
            echo 'registro guardado';
        }

    try{ 
        require("../conexion/conexion.php");

        $busqueda = "SELECT nombre, apellido_paterno, apellido_materno, area_encargado, tipo_jefe, correo, contrasena FROM jefes 
        WHERE  nombre = :nom AND apellido_paterno = :apep AND apellido_materno = :apem AND area_encargado = :area AND tipo_jefe = :tipo AND correo = :correo AND contrasena = :contra";
        
        $resultado = $base->prepare($busqueda);
        
        $resultado->execute(array(':nom'=>$jefe[1],':apep'=>$jefe[2],':apem'=>$jefe[3],':area'=>$jefe[4],':tipo'=>$jefe[5],':correo'=>$jefe[6],':contra'=>$jefe[7]));
        
        if ( $resultado->rowCount()>0 ) {
            
            while ($datos = $resultado->fetch(PDO::FETCH_ASSOC)) { 

                if ( (dato_repetido($datos,$jefe))  ) {  
                    exit();
                } 
            }
            
            registra_datos($resultado, $base, $jefe);
        }else { 
            
            registra_datos($resultado, $base, $jefe);
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