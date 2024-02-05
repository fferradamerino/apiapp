<?php

// La siguiente API se encarga de obtener una lista de sucursales de la base de datos
/*
    Endpoint: /sucursal/obtener.php
    - Método: GET
    - Descripción: obtiene una lista de las sucursales almacenadas
    - Parámetros: (sin parámetros)
*/

// Definimos la clase respuesta
class Respuesta {
    public $exito;
    public $sucursales;
}

// Definimos la función error
function error() {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    $respuesta->sucursales = [];
    echo json_encode($respuesta);
    exit;
}

// Definimos la función exito
function exito($sucursales) {
    $respuesta = new Respuesta();
    $respuesta->exito = true;
    $respuesta->sucursales = $sucursales;
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

    // Obtenemos la lista de sucursales de la base de datos
    $sql = "SELECT * FROM Sucursales";
    $resultado = $conn->query($sql);

    // Verificamos que la solicitud haya sido exitosa
    if ($resultado === false) {
        // Si la operación no fue exitosa, devolver un mensaje de error
        error();
    }

    // Convertimos el resultado de la consulta a un arreglo
    $sucursales = [];
    while ($fila = $resultado->fetch_assoc()) {
        $sucursales[] = $fila;
    }

    exito($sucursales);
} else {
    // Si no se recibió una solicitud GET, devolver un mensaje de error
    error();
}