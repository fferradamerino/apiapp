<?php

// La siguiente API se encarga de editar sucursales en la base de datos del servidor
/*
    Endpoint: /sucursal/editar.php
    - Método: POST
    - Descripción: edita una sucursal ya existente
    - Parámetros:
        - id: ID de la sucursal (int, obligatorio)
        - nombre (string, obligatorio): nombre de la sucursal
        - direccion (string, obligatorio): dirección de la sucursal
        - telefono (string, obligatorio): teléfono de la sucursal
        - codigopostal (string, obligatorio): código postal de la sucursal
        - horarioinicio (string, obligatorio): inicio del horario laboral de la sucursal
        - horariofin (string, obligatorio): fin del horario laboral de la sucursal
*/

// Definimos la clase Respuesta
class Respuesta {
    public $exito;
}

// Definimos la función error
function error() {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    echo json_encode($respuesta);
    exit;
}

// Definimos la función exito
function exito() {
    $respuesta = new Respuesta();
    $respuesta->exito = true;
    echo json_encode($respuesta);
    exit;
}

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibieron los parámetros 'id', 'nombre', 'direccion', 'telefono', 'codigopostal', 'horarioinicio' y 'horariofin'
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['codigopostal']) && isset($_POST['horarioinicio']) && isset($_POST['horariofin'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $codigopostal = $_POST['codigopostal'];
        $horarioinicio = $_POST['horarioinicio'];
        $horariofin = $_POST['horariofin'];

        // Iniciamos una conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'bd');

        // Verificamos que la conexión se haya realizado con éxito
        if ($conn->connect_error) {
            // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
            error();
        }

        // Actualizamos la sucursal en la base de datos
        $sql = "UPDATE Sucursales SET NombreSucursal = '$nombre', DireccionSucursal = '$direccion', Telefono = '$telefono', CodigoPostal = '$codigopostal', InicioHorario = '$horarioinicio', FinHorario = '$horariofin' WHERE Id = $id";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        exito();
    } else {
        // Si no se recibió el parámetro 'id', 'nombre', 'direccion', 'telefono', 'codigopostal', 'horarioinicio' o 'horariofin', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}