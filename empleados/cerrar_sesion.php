<?php
        //le indica que inicie sesion de la ya iniciada para asegurar
        session_start();
        //se destruye la sesion iniciada
        session_destroy();
        //lo direcciona a iniciar sesion
        header('Location: formulario_login.html');
?>