<?php

namespace Padalea\vistas;

class VistaMenuPrincipal
{
  public static function render($partidas = null)
  {

    include("cabecera.php");


    //contenido principal
    echo ' <main class="container ">';
    echo '
          <div class="d-flex justify-content-center p-4">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear partida</button>  
          </div>
          ';
?>


    <div class="cotainer-fluid" id="contenedorPartidas">
      <div class="d-flex flex-row flex-wrap justify-content-center">

        <?php
        if ($partidas == null) {
          echo '
        <h3 class="text-center text-info">No hay partidas para mostrar</h3>
        ';
        } else {

          echo '
        <table class="table table-hover table-striped table-bordered">
          <tr class="table-dark text-center">
            <th>fecha</th>
            <th>hora</th>
            <th>ciudad</th>
            <th>lugar</th>
            <th>Cubierto</th>
            <th>estado</th>
            <th>detalles</th>
          </tr>
          ';

          foreach ($partidas as $partida) {

            echo '<tr>';
            echo ' <td>' . $partida->getFecha() . '</td>';
            echo ' <td>' . $partida->getHora() . ':00</td>';
            echo ' <td>' . $partida->getCiudad() . '</td>';
            echo ' <td>' . $partida->getLugar() . '</td>';

            if ($partida->getCubierto()) {
              echo ' <td>Sí</td>';
            } else {
              echo ' <td>No</td>';
            }
            echo ' <td>' . $partida->getEstado() . '</td>';


            echo ' <td class="d-flex justify-content-center">
                <a href="index.php?accion=mostrarDetalles&idPartida=' . $partida->getId() . '"><button class="btn btn-primary">@</button></a>
            </td>
            ';
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

    //modal
    echo '
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Parámetros de busqueda</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                <form id="crearForm" action="index.php" method="POST">

                  <div class="form-floating">
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                    <label for="fecha">fecha</label>
                  </div>

                  <div class="form-floating">
                    <span class="fs-5">hora</span>
                    <input type="number" name="hora" id="hora" max="23" min="0" required>
                    
                  </div>

                  <div class="form-floating">
                    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Dodo" required>
                    <label for="ciudad">ciudad</label>
                  </div>

                  <div class="form-floating">
                    <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Dodo" required>
                    <label for="lugar">lugar</label>
                  </div>

                  <div class="form-floating">
                    <select class="form-select py-3" id="cubierto" name="cubierto" aria-label="Default select example">
                      <option value="true" selected>Cubierto</option>
                      <option value="false" >Sin Cubrir</option>
                    </select>
                  </div>

                </form>



                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" name="accion" value="crearPartida" form="crearForm" id="crearPartida">Crear</button>
                </div>
              </div>
            </div>
          </div>
          ';
    //fin modal
    ?>

    <script>
      window.onload = llamarInicio();

      async function llamarInicio() {

      }

      document.getElementById("contenedorPartidas").onclick = async function(e) {


      };
    </script>

<?php


    include("pie.php");
  }
}

?>