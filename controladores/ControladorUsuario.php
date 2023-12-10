<?php

namespace Padalea\controladores;

use Padalea\modelos\ModeloJugador;
use Padalea\vistas\VistaLogin;

class ControladorUsuario
{
    public static function gestionarLogin($email, $password)
    {
        $jugador = ModeloJugador::buscarJugador($email);
        $loginCorrecto = false;

        if ($jugador != null) {

            if (strcmp($jugador->getPassword(), $password)  == 0) {
                $loginCorrecto = true;
            }
        }

        if ($loginCorrecto == true) {
            $_SESSION["usuario"] = serialize($jugador);
            header("Location: index.php");
            die;
        } else {
            VistaLogin::render("DATOS ERRONEOS");
        }
    }

    //borra la sesion
    public static function cerrarSesion()
    {
        session_destroy();

        header("Location: index.php");
        die();
    }
}
