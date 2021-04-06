<?php
        //se crea el objeto de conexion PDO
        $base = new PDO('mysql:host=localhost; dbname=lab_quimico;','root','');
        //se establecen atributos al objeto(reporte errores,reporte de fallos)
        $base->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //ejecuta la sentecia para manejar los carcateres español
        $base->exec('SET CHARACTER SET utf8');
        // echo 'conexion ok';
?>