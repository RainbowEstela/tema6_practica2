<?php

namespace Padalea\modelos;


use Padalea\modelos\ConexionBaseDeDatos;
use Padalea\modelos\Partida;

class ModeloPartida
{
    public static function addPartida($partida)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $idMasAlta = $conexion->partidas->findOne(
            [],
            [
                'sort' => ['id' => -1]
            ]
        );

        $id = 0;

        if (isset($idMasAlta)) {
            $id = $idMasAlta["id"] + 1;
        }

        $consulta = $conexion->partidas->insertOne([
            'id' => intval($id),
            'fecha' => $partida->getFecha(),
            'hora' => intval($partida->getHora()),
            'ciudad' => $partida->getCiudad(),
            'lugar' => $partida->getLugar(),
            'cubierto' => boolval($partida->getCubierto()),
            'estado' =>  $partida->getEstado()
        ]);

        $conexionObjet->cerrarConexion();

        return $id;
    }

    public static function getPartidas()
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();



        $valores = $conexion->partidas->find(
            ['fecha' => ['$gte' => date("Y-m-d")]],
            [
                'sort' => ['fecha' => -1]
            ]
        );


        $partidas = [];

        foreach ($valores as $data) {
            array_push($partidas, new Partida($data["id"], $data["fecha"], $data["hora"], $data["ciudad"], $data["lugar"], $data["cubierto"], $data["estado"]));
        }

        $conexionObjet->cerrarConexion();

        return $partidas;
    }

    public static function getPartidaById($id)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $resultado = $conexion->partidas->findOne(["id" => intval($id)]);

        $partida = null;

        if (isset($resultado["id"])) {
            $partida = new Partida($resultado["id"], $resultado["fecha"], $resultado["hora"], $resultado["ciudad"], $resultado["lugar"], $resultado["cubierto"], $resultado["estado"]);
        }

        return $partida;
    }

    public static function deletePartida($id)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->partidas->deleteOne(['id' => intval($id)]);

        $conexionObjet->cerrarConexion();
    }

    public static function updateEstado($partida)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->partidas->updateOne(
            ['id' => intval($partida->getId())],
            [
                '$set' => ['estado' => $partida->getEstado()],

            ],
        );;

        $conexionObjet->cerrarConexion();
    }
}
