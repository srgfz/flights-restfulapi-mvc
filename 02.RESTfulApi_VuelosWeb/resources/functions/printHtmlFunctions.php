<?php

function showHeader($vuelos, $vueloSelected = null) {
    echo '<header class=" sticky-lg-top border-4 border-bottom header sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3 py-0">
        <div class=" bg-light  d-flex d-lg-none d-block justify-content-between">
            <h1><a href="' . $_SERVER["PHP_SELF"] . '">UT7.3 Vuelos</a></h1>
        </div>
        <div class="d-flex d-lg-none">
            <button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="container-fluid justify-content-center justify-content-lg-between align-items-center">
            <h2 class="navbar-brand d-flex d-lg-block d-none"><a href="' . $_SERVER["PHP_SELF"] . '">UT7.3 Vuelos</a></h2>
            <div class="">
                <div class="collapse navbar-collapse gap-5 mx-3 justify-content-evenly align-items-center" id="navbarTogglerDemo03">
                    <a href="' . $_SERVER["PHP_SELF"] . '?controller=Vuelos&action=listVuelos" class="btn btn-secondary my-2 fw-bold px-3 col-3">Vuelos</a>
                    <a href="' . $_SERVER["PHP_SELF"] . '?controller=Pasajes&action=listPasajes" class="btn btn-secondary my-2 fw-bold px-3 col-3">Pasajes</a>
                    <a href="' . $_SERVER["PHP_SELF"] . '?controller=Pasajes&action=addPasajeForm" class="btn btn-secondary my-2 fw-bold px-3 col-3">Añadir Pasaje</a>
                    <form class="col-6 d-flex" method="POST" action="' . $_SERVER["PHP_SELF"] . '?controller=Vuelos&action=infoVuelo">
                        <select class="mx-auto px-3 py-1 bg-opacity-25 bg-secondary my-5 rounded" name="vueloSelected">
                            <option disabled selected>Seleccionar Vuelo</option>';
    foreach ($vuelos as $vuelo) {//Recorro los vuelos
        showOptions($vuelo->identificador, "Vuelo $vuelo->identificador", $vueloSelected);
    }
    echo '</select>
                        <div class="d-flex gap-2 flex-column">                
                            <input type="submit" value="Información del Vuelo" class="btn btn-outline-dark my-2 fw-bold">
                            <input type="submit" value="Pasajes del Vuelo" formaction="' . $_SERVER["PHP_SELF"] . '?controller=Pasajes&action=pasajesVuelo" class="btn btn-outline-dark my-2 fw-bold">
                        </div>  
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center d-none d-lg-flex">
                <div class="align-items-center d-none d-md-flex gap-3">
                </div>
            </div>
        </div>
    </nav>
</header>';
}

function showOptions($optionValue, $optionText, $selected = null) {
    echo "<option value='$optionValue'";
    if ($selected == $optionValue) {
        echo " selected";
    }
    echo">$optionText</option>";
}

function listVuelos($vuelos, $idVuelo = null) {
    if (count($vuelos) > 1) {
        echo "<h2 class='bg-primary bg-opacity-25 text-light p-4 m-0 text-center border-bottom'>Vuelos</h2>";
    } else {
        echo "<h2 class='bg-primary bg-opacity-25 text-light p-4 m-0 text-center border-bottom'>Vuelo $idVuelo</h2>";
    }
    echo '<table class="table col-10 mx-auto text-light px-5 m-4 mt-0 text-center"><thead>
    <tr class="bg-primary p-5 bg-opacity-50">
      <th scope="col" class="border-end">Id Vuelo</th>
      <th scope="col" colspan="3" class="border-end border-start">Origen</th>
      <th scope="col" colspan="3" class="border-end border-start">Destino</th>
      <th scope="col" class="border-end border-start">Tipo de vuelo</th>
      <th scope="col" class="border-start">Número de pasajeros</th>
    </tr>
  </thead>
  <tbody>';
    foreach ($vuelos as $vuelo) {//Recorro los vuelos
        echo '<tr>';
        foreach ($vuelo as $key => $value) {
            if (str_contains($key, "aeropuerto_origen") || str_contains($key, "aeropuerto_destino") || str_contains($key, "pasajeros")) {
                echo "<td>";
            } else {
                echo "<td class='border-end'>";
            }
            echo $value . "</td>";
        }
        echo '</tr>';
    }
    echo "</tbody></table>";
}

function listPasajes($pasajes) {//Listarlo con ul y li para ponerlo en inputs y al lado un botón para borrar y otro para editar
    echo "<h2 class='bg-primary bg-opacity-25 text-light p-4 m-0 text-center border-bottom'>Pasajes</h2>";
    echo '<table class="table col-10 mx-auto text-light px-5 m-4 mt-0 text-center"><thead>
    <tr class="bg-primary p-5 bg-opacity-50">
      <th scope="col" class="border-end">Id Pasaje</th>
      <th scope="col" class="border-end">Id Pasajero</th>
      <th scope="col" class="border-end">Vuelo</th>
      <th scope="col" class="border-end">Núm. Asiento</th>
      <th scope="col" class="border-end">Clase Asiento</th>
      <th scope="col" class="border-end">Precio</th>
      <th scope="col" colspan="2" class="">Acciones</th>
    </tr>
  </thead>
  <tbody>';
    foreach ($pasajes as $pasaje) {//Recorro los vuelos
        echo '<tr>';
        foreach ($pasaje as $key => $value) {
            if ($key === "idpasaje") {
                $idPasaje = $value;
            }
            if ($key === "pvp") {
                echo "<td class='border-end'>$value €</td>";
            } else {
                echo "<td class='border-end'>$value</td>";
            }
        }
        echo '<td>';
        printModal($pasaje);
        echo '</td>';
        echo '<td><a href="./index.php?controller=Pasajes&action=addPasajeForm&idPasaje=' . $idPasaje . '" class="btn btn-light">Editar</a></td>';
        echo '</tr>';
    }
    echo "</tbody></table>";
}

function printModal($pasaje) {
    echo '<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalPasaje' . $pasaje->idpasaje . '">
  Eliminar
</button>

<!-- Modal -->
<div class="modal fade text-dark" id="modalPasaje' . $pasaje->idpasaje . '" tabindex="-1" aria-labelledby="modalLabel' . $pasaje->idpasaje . '" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabel' . $pasaje->idpasaje . '">Eliminar Pasaje ' . $pasaje->idpasaje . '</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <p class="fw-bold">¿Esta seguro que desea eliminar el Pasaje ' . $pasaje->idpasaje . '?</p>'
    . '<p>Pasajero cod: ' . $pasaje->pasajerocod . ' - Vuelo: ' . $pasaje->identificador . '</p>
      </div>
      <div class="modal-footer d-flex justify-content-center gap-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="./index.php?controller=Pasajes&action=deletePasaje&idPasaje=' . $pasaje->idpasaje . '" class="text-decoration-none text-light btn btn-danger">Eliminar</a>
      </div>
    </div>
  </div>
</div>';
}

function listPasajeros($pasajeros) {
    foreach ($pasajeros as $key => $pasaje) {
        echo "<h2 class='bg-primary bg-opacity-25 text-light p-4 m-0 text-center border-bottom'>$key</h2>";
        if (is_string($pasaje) && str_contains($pasaje, "No existe el pasaje")) {
            echo "<p class='text-center fs-5 p-3 text-light'>Actualmente no hay ningún pasaje para este vuelo</p>";
        } else {
            echo '<table class="table col-10 mx-auto text-light px-5 m-4 mt-0 text-center"><thead>
    <tr class="bg-primary p-5 bg-opacity-50">
      <th scope="col" class="border-end">Id Pasaje</th>
      <th scope="col" class="border-end">Id Pasajero</th>
      <th scope="col" class="border-end">Nombre Pasajero</th>
      <th scope="col" class="border-end">País Pasajero</th>
      <th scope="col" class="border-end">Núm. Asiento</th>
      <th scope="col" class="border-end">Clase Asiento</th>
      <th scope="col" class="">Precio</th>
    </tr>
  </thead>
  <tbody>';
            foreach ($pasaje as $key => $pasajero) {
                echo '<tr>';
                foreach ($pasajero as $key => $value) {
                    if ($key == "pvp") {
                        echo "<td>$value €</td>";
                    } else {
                        echo "<td class='border-end'>$value</td>";
                    }
                }
                echo '</tr>';
            }
            echo "</tbody></table>";
        }
    }
}

function showFormAddPasaje($vuelos, $pasajeros, $pasajeSelected) {
    echo '<form class="d-flex flex-column gap-4 justify-cotent-center col-10"  method="POST" action="' . $_SERVER["PHP_SELF"] . '?controller=Pasajes&action=addPasaje">
            <div class="d-flex gap-4 justify-content-evenly">
                <div class="form-floating col-4">
                  <select name="pasajerocod" class="form-select" id="floatingSelectPasajero" aria-label="Floating label select example" required>
                    <option disabled selected>Selecciona el Pasajero</option>';
    foreach ($pasajeros as $pasajero) {//Recorro los pasajeros
        if (isset($pasajeSelected)) {//Si es para editar
            showOptions($pasajero->pasajerocod, $pasajero->nombre, $pasajeSelected->pasajerocod);
        } else {//Si es para añadir
            showOptions($pasajero->pasajerocod, $pasajero->nombre);
        }
    }
    echo '</select>
                  <label for="floatingSelectPasajero">Pasajero</label>
                </div>   
                <div class="form-floating col-4">
                  <select name="identificador"  class="form-select" id="floatingSelectVuelo" aria-label="Floating label select example" required>
                    <option disabled selected>Selecciona el Vuelo</option>';
    foreach ($vuelos as $vuelo) {//Recorro los vuelos
        if (isset($pasajeSelected)) {//Si es para editar
            showOptions($vuelo->identificador, "Vuelo $vuelo->identificador", $pasajeSelected->identificador);
        } else {//Si es para añadir
            showOptions($vuelo->identificador, "Vuelo $vuelo->identificador");
        }
    }
    echo '</select>
                  <label for="floatingSelectVuelo">Vuelo</label>
                </div> 
            </div>
            <div class="d-flex gap-4 justify-content-evenly">
                <div class="form-floating col-4">';
    if (isset($pasajeSelected)) {//Si es para editar
        echo '<input  name="numasiento" type="number" class="form-control" id="floatingInputAsiento" placeholder="Núm. Asiento" required min="1" value="' . $pasajeSelected->numasiento . '">';
    } else {//Si es para añadir
        echo '<input name="numasiento"  type="number" class="form-control" id="floatingInputAsiento" placeholder="Núm. Asiento" required min="1">';
    }
    echo'<label for="floatingInputAsiento">Núm. Asiento</label>
                </div>
                <div class="form-floating col-4">';
    if (isset($pasajeSelected)) {//Si es para editar
        echo '<input name="pvp"  type="number" class="form-control" id="floatingInputPrecio" placeholder="Precio" required min="1" step="any" value="' . $pasajeSelected->pvp . '">';
    } else {//Si es para añadir
        echo '<input name="pvp"  type="number" class="form-control" id="floatingInputPrecio" placeholder="Precio" required min="1" step="any">';
    }
    echo '<label for="floatingInputPrecio">Precio (€)</label>
                </div>
            </div>
            <div class="text-light d-flex flex-column justify-content-center ms-5 px-5 fs-5">Tipo de Asiento</div>
            <div class ="d-flex  justify-content-evenly gap-4">';
    if (isset($pasajeSelected)) {//Si es para editar
        showInputRadios("clase", ["Turista", "Primera", "Business"], $pasajeSelected->clase);
    } else {//Si es para añadir
        showInputRadios("clase", ["Turista", "Primera", "Business"]);
    }
    echo '</div>';
    if (isset($pasajeSelected)) {//Si es para editar
        echo '<input type = "submit" class = "col-3 mx-auto py-2 rounded" value = "Editar Pasaje ' . $pasajeSelected->idpasaje . '"  formaction="' . $_SERVER["PHP_SELF"] . '?controller=Pasajes&action=updatePasaje&id=' . $pasajeSelected->idpasaje . '" >';
    } else {//Si es para añadir
        echo '<input type = "submit" class = "col-3 mx-auto py-2 rounded" value = "Añadir Pasaje">';
    }
    echo '</div>';

    echo '</form>';
}

/**
 * printAlert() --> Función para mostrar un alert para mostrar distintos mensajes de información al usuario
 * @param type $textContent --> Contenido del alert
 * @param type $alertType --> Tipo de alert
 */
function printAlert($textContent, $alertType) {
    echo '<div class = "alert ' . $alertType . ' alert-dismissible fade show col-11 mx-auto mt-3" role = "alert">
        ' . $textContent . '
        <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
        </div>';
}

function showInputRadios($nameInput, $inputs, $selected = null) {
    foreach ($inputs as $key => $value) {
        echo '<input type = "radio" class = "btn-check" name = "' . $nameInput . '" id = "' . $value . '" autocomplete = "off" required value="' . strtoupper($value) . '"';
        if (strtoupper($value) == strtoupper($selected)) {
            echo " checked";
        }
        echo '><label class = "btn btn-dark" for = "' . $value . '">' . $value . '</label>';
    }
}
