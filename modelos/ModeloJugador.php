<?php

namespace Padalea\modelos;

use Padalea\modelos\ConexionBaseDeDatos;
use Padalea\modelos\Jugador;

class ModeloJugador
{
    public static function buscarJugador($email)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $valor = $conexion->jugadores->findOne(["email" => $email]);

        $jugador = null;

        if (isset($valor["id"])) {
            $jugador = new Jugador($valor["id"], $valor["email"], $valor["password"], $valor["nombre"], $valor["apodo"], $valor["nivel"], $valor["edad"]);
        }

        $conexionObjet->cerrarConexion();

        return $jugador;
    }

    public static function getUsuarioById($id)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $valor = $conexion->jugadores->findOne(["id" => $id]);

        $jugador = null;

        if (isset($valor["id"])) {
            $jugador = new Jugador($valor["id"], $valor["email"], $valor["password"], $valor["nombre"], $valor["apodo"], $valor["nivel"], $valor["edad"]);
        }

        $conexionObjet->cerrarConexion();

        return $jugador;
    }
}
