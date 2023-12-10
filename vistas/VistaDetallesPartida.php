<?php

namespace Padalea\vistas;

class VistaDetallesPartida
{
    public static function render($partida, $jugadores, $error = "")
    {
        include("cabecera.php");


        //contenido principal
        echo ' <main class="container ">';

        if ($error != "") {
            echo '
            <div>
                <h4 class="text-center text-danger">' . $error . '</h4>
            </div> 
            ';
        }


        echo '
          <div class="d-flex justify-content-center p-4 gap-2">
        ';
        if (strcmp($partida->getEstado(), "abierta") == 0) {
            echo '
            <a href="./index.php?accion=incribirse&idJugador=' . unserialize($_SESSION["usuario"])->getId() . '&idPartida=' . $partida->getId() . '"><button class="btn btn-success">Inscribirse</button> </a>
            <a href="./index.php?accion=desapuntarse&idJugador=' . unserialize($_SESSION["usuario"])->getId() . '&idPartida=' . $partida->getId() . '"><button class="btn btn-warning">Desapuntarse</button> </a>
            ';
        }

        echo '    <a href="./index.php?accion=borrarPartida&idPartida=' . $partida->getId() . '"><button class="btn btn-danger">¡Borrar partida!</button> </a>
          </div>
        <div>
        <h3 class="text-center text-info">Informacion de la partida del dia ' . $partida->getFecha() . ' a las ' . $partida->getHora() . ':00 en ' . $partida->getCiudad() . ' - ' . $partida->getLugar() . '</h3>
        </div>
          
          ';
?>



        <div class="cotainer-fluid" id="contenedorPartidas">
            <div class="d-flex flex-row flex-wrap justify-content-center">

                <?php
                if ($jugadores == null) {
                    echo '
        <h3 class="text-center text-danger">No hay jugadores en la partida</h3>
        ';
                } else {

                    echo '
        <table class="table table-hover table-striped table-bordered">
          <tr class="table-dark text-center">
            <th>Nombre</th>
            <th>Apodo</th>
            <th>Nivel</th>
            <th>Edad</th>
          </tr>
          ';

                    foreach ($jugadores as $jugador) {

                        echo '<tr>';
                        echo ' <td>' . $jugador->getNombre() . '</td>';
                        echo ' <td>' . $jugador->getApodo() . '</td>';
                        echo ' <td>' . $jugador->getNivel() . '</td>';
                        echo ' <td>' . $jugador->getEdad() . '</td>';

                        echo '</tr>';
                    }


                    echo '
        </table>';
                }
                ?>







            </div>
        </div>



<?php
        echo '</main>';
        //fin contenido principal
    }
}
?>