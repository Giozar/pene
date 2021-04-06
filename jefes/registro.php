<?php
    $jefe = [
            $_POST['id'], 
            $_POST['nomJ'],
            $_POST['apepJ'],
            $_POST['apemJ'],
            $_POST['areaJ'],
            $_POST['tipoJ'],
            $_POST['correoJ'],
            $_POST['contraJ']
            //password_hash($_POST['contraJ'],PASSWORD_DEFAULT, array('cost'=>12)) <------contraseña con hash(contra encriptada)
        ];
    
    echo '<a href="formulario_registro.php">Regresar</a> <br>'; 
    echo '<a href="login.php">Iniciar sesion</a> <br>'; 

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
            VALUES (:id,:nomJ,:apepJ,:apemJ,:areaJ,:tipoJ,:correoJ,:contraJ)';
            $resultado = $base->prepare($registra);
            $resultado->execute(array(':id'=>$jefe[0],
            ':nomJ'=>$jefe[1],
            ':apepJ'=>$jefe[2],
            ':apemJ'=>$jefe[3],
            ':areaJ'=>$jefe[4],
            ':tipoJ'=>$jefe[5],
            ':correoJ'=>$jefe[6],
            ':contraJ'=>$jefe[7]
            ));
            echo 'registro guardado';
        }

    try{ 
        require("../conexion/conexion.php");

        $busqueda = "SELECT nombre, apellido_paterno, apellido_materno, area_encargado, tipo_jefe, correo, contrasena FROM jefes 
        WHERE  nombre = :nomJ AND apellido_paterno = :apepJ AND apellido_materno = :apemJ AND area_encargado = :areaJ AND tipo_jefe = :tipoJ AND correo = :correoJ AND contrasena = :contraJ";
        
        $resultado = $base->prepare($busqueda);
        
        $resultado->execute(array(':nomJ'=>$jefe[1],':apepJ'=>$jefe[2],':apemJ'=>$jefe[3],':areaJ'=>$jefe[4],':tipoJ'=>$jefe[5],':correoJ'=>$jefe[6],':contraJ'=>$jefe[7]));
        
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