<?php

namespace Padalea\controladores;

use Padalea\modelos\ModeloJugador;
use Padalea\modelos\ModeloPartida;
use Padalea\modelos\ModeloRelacion;
use Padalea\vistas\VistaDetallesPartida;
use Padalea\vistas\VistaMenuPrincipal;

class ControladorPartida
{
    public static function addPartida($partida, $idJugador)
    {
        $idPartida = ModeloPartida::addPartida($partida);

        ModeloRelacion::addRelacion($idPartida, $idJugador);

        header("Location: index.php");
        die;
    }

    public static function mostrarPartidas()
    {
        $partidas = ModeloPartida::getPartidas();

        VistaMenuPrincipal::render($partidas);
    }

    public static function detallesPartida($idPartida, $error = "")
    {
        $partida = ModeloPartida::getPartidaById($idPartida);

        $idJugadores = ModeloRelacion::getJugadoresPartida($idPartida);

        $jugadores = [];

        foreach ($idJugadores as $id) {
            array_push($jugadores, ModeloJugador::getUsuarioById($id));
        }

        VistaDetallesPartida::render($partida, $jugadores, $error);
    }

    public static function borrarPartida($idPartida, $idJugador)
    {
        //buscar jugadores de la partida
        $idJugadores = ModeloRelacion::getJugadoresPartida($idPartida);

        $indice = array_search($idJugador, $idJugadores);

        if ($indice !== false) {
            //borro la partida
            ModeloPartida::deletePartida($idPartida);

            //borro las relaciones partida-jugador donde este la idPartida
            ModeloRelacion::deleteRelacionesByIdPartida($idPartida);

            //vuelvo a index.php
            header("Location: index.php");
            die;
        } else {
            ControladorPartida::detallesPartida($idPartida, "No puede borrar la partida si no esta incrito/a");
        }
    }

    public static function desapuntarJugador($idJugador, $idPartida)
    {
        //buscar jugadores de la partida
        $idJugadores = ModeloRelacion::getJugadoresPartida($idPartida);

        $indice = array_search($idJugador, $idJugadores);

        if ($indice !== false) {
            ModeloRelacion::deleteRelacionByIdJugadorAndIdPartida($idJugador, $idPartida);


            ControladorPartida::detallesPartida($idPartida);
            die;
        } else {
            ControladorPartida::detallesPartida($idPartida, "No puede desapuntarse de una partida si no esta incrito/a");
            die;
        }
    }

    public static function apuntarJugador($idJugador, $idPartida)
    {
        $error = "";

        //buscar jugadores de la partida
        $idJugadores = ModeloRelacion::getJugadoresPartida($idPartida);

        //comprobar que no hayan 4 jugadores ya
        if (sizeof($idJugadores) < 4) {
            $indice = array_search($idJugador, $idJugadores);


            if ($indice === false) {
                ModeloRelacion::addRelacion($idPartida, $idJugador);
            } else {
                $error = "No puede inscribirse a una partida donde ha se ha inscrito";
            }
        }


        $idJugadores = ModeloRelacion::getJugadoresPartida($idPartida);
        //comporbar si despues de las operaciones se ha llenado el grupo
        if (sizeof($idJugadores) == 4) {
            $partida = ModeloPartida::getPartidaById($idPartida);

            $error = "La partida está llena";
            $partida->setEstado("cerrada");

            ModeloPartida::updateEstado($partida);
        }


        //redirigir a detalles
        ControladorPartida::detallesPartida($idPartida, $error);
        die;
    }
}
