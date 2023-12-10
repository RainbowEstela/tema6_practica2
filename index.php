<?php

namespace Padalea;

use Padalea\controladores\ControladorPartida;
use Padalea\controladores\ControladorUsuario;
use Padalea\modelos\Partida;
use Padalea\vistas\VistaLogin;
use TripleTriad\vistas\VistaMenuPrincipal;

require_once './vendor/autoload.php';

//empezar la sesion
session_start();


//Autocargar las clases --------------------------
spl_autoload_register(function ($class) {
    //echo substr($class, strpos($class,"\\")+1);
    $ruta = substr($class, strpos($class, "\\") + 1);
    $ruta = str_replace("\\", "/", $ruta);
    include_once "./" . $ruta . ".php";
});
//Fin Autcargar --

if (isset($_REQUEST["accion"])) {
    if (strcmp($_REQUEST["accion"], "peticionLogin") == 0) {


        $nombre = $_REQUEST["nombre"];
        $password = $_REQUEST["password"];

        ControladorUsuario::gestionarLogin($nombre, $password);
        die;
    }
}

if (!isset($_SESSION["usuario"])) {
    VistaLogin::render();
    die;
}

if (isset($_REQUEST["accion"])) {
    //cierra la sesion del usuario
    if (strcmp($_REQUEST["accion"], "cerrarSesion") == 0) {

        ControladorUsuario::cerrarSesion();
        die;
    }

    //añade una nueva partida
    if (strcmp($_REQUEST["accion"], "crearPartida") == 0) {


        $cubierta = false;

        if (strcmp($_REQUEST["cubierto"], "true") == 0) {
            $cubierta = true;
        }

        $partida = new Partida("", $_REQUEST["fecha"], $_REQUEST["hora"], $_REQUEST["ciudad"], $_REQUEST["lugar"], $cubierta, "abierta");

        ControladorPartida::addPartida($partida, unserialize($_SESSION["usuario"])->getId());
        die;
    }

    //mostrar detalles pertida
    if (strcmp($_REQUEST["accion"], "mostrarDetalles") == 0) {
        $idPartida = $_REQUEST["idPartida"];

        ControladorPartida::detallesPartida($idPartida);
        die;
    }

    //borrar una partida
    if (strcmp($_REQUEST["accion"], "borrarPartida") == 0) {
        $idPartida = $_REQUEST["idPartida"];
        $idUsuario = unserialize($_SESSION["usuario"])->getId();

        ControladorPartida::borrarPartida($idPartida, $idUsuario);
        die;
    }

    //desapuntar jugador
    if (strcmp($_REQUEST["accion"], "desapuntarse") == 0) {
        $idJugador = $_REQUEST["idJugador"];
        $idPartida = $_REQUEST["idPartida"];

        ControladorPartida::desapuntarJugador($idJugador, $idPartida);
        die;
    }

    //apuntar jugador
    if (strcmp($_REQUEST["accion"], "incribirse") == 0) {
        $idJugador = $_REQUEST["idJugador"];
        $idPartida = $_REQUEST["idPartida"];

        ControladorPartida::apuntarJugador($idJugador, $idPartida);
        die;
    }
} else {
    ControladorPartida::mostrarPartidas();
}
