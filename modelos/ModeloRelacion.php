<?php

namespace Padalea\modelos;

class ModeloRelacion
{
    public static function addRelacion($idPartida, $idJugador)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->relacion->insertOne([
            'idPartida' => intval($idPartida),
            'idJugador' => intval($idJugador)
        ]);

        $conexionObjet->cerrarConexion();
    }

    public static function getJugadoresPartida($idPartida)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $resultado = $conexion->relacion->find(["idPartida" => intval($idPartida)]);

        $idJugadores = [];

        foreach ($resultado as $relacion) {
            array_push($idJugadores, $relacion["idJugador"]);
        }

        return $idJugadores;
    }

    public static function deleteRelacionesByIdPartida($idPartida)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->relacion->deleteMany(['idPartida' => intval($idPartida)]);

        $conexionObjet->cerrarConexion();
    }

    public static function deleteRelacionByIdJugadorAndIdPartida($idJugador, $idPartida)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->relacion->deleteOne(['idPartida' => intval($idPartida), 'idJugador' => intval($idJugador)]);

        $conexionObjet->cerrarConexion();
    }
}
