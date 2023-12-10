<?php

namespace Padalea\modelos;

class Partida
{
    private $id;
    private $fecha;
    private $hora;
    private $ciudad;
    private $lugar;
    private $cubierto;
    private $estado;
    private $jugadores;

    public function __construct($id = "", $fecha = "", $hora = "", $ciudad = "", $lugar = "", $cubierto = "", $estado = "")
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->ciudad = $ciudad;
        $this->lugar = $lugar;
        $this->cubierto = $cubierto;
        $this->estado = $estado;
        $this->jugadores = [];
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of lugar
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set the value of lugar
     *
     * @return  self
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get the value of cubierto
     */
    public function getCubierto()
    {
        return $this->cubierto;
    }

    /**
     * Set the value of cubierto
     *
     * @return  self
     */
    public function setCubierto($cubierto)
    {
        $this->cubierto = $cubierto;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of jugadores
     */
    public function getJugadores()
    {
        return $this->jugadores;
    }
}
