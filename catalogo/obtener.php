<?php

// Esta API es la encargada de devolver al usuario una lista de catálogos
// almacenados en el servidor.

// Definimos la clase Respuesta
class Respuesta {
    public $exito;
    public $catalogos;
}

// Definimos la función error
function error() {
    $respuesta = new Respuesta();
    $respuesta->exito =false;
    $respuesta->catalogos = [];
    echo json_encode($respuesta);
    exit;
}

// Definimos la función éxito
function exito($catalogos) {
    $respuesta = new Respuesta();
    $respuesta->exito = true;
    $respuesta->catalogos = $catalogos;
    echo json_encode($respuesta);
    exit;
}

// Verificar si se recibió una solicitud GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Iniciamos una conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'bd');

    // Verificamos que la conexión se haya realizado con éxito
    if ($conn->connect_error) {
        // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
        error();
    }

    // Obtenemos los catálogos de la base de datos
    $sql = "SELECT * FROM Catalogo";
    $resultado = $conn->query($sql);

    // Verificamos que la solicitud haya sido exitosa
    if ($resultado === false) {
        // Si la operación no fue exitosa, devolver un mensaje de error
        error();
    }

    // Extraemos los catálogos del resultado anterior
    $catalogos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $catalogos[] = $fila;
    }

    exito($catalogos);
} else {
    // Si no se recibió una solicitud GET, devolver un mensaje de error
    error();
}