<?php

// La siguiente API se encarga de obtener una lista de ofertas de la base de datos
/*
    Endpoint: /oferta/obtener.php
    - Método: POST
    - Descripción: retorna las primeras x ofertas más recientes
    - Parámetros:
        - x (int, obligatorio): la cantidad de ofertas a adquirir
*/

// Definimos la clase respuesta
class Respuesta {
    public $exito;
    public $ofertas;
}

// Definimos la función error
function error() {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    $respuesta->ofertas = [];
    echo json_encode($respuesta);
    exit;
}

// Definimos la función exito
function exito($ofertas) {
    $respuesta = new Respuesta();
    $respuesta->exito = true;
    $respuesta->ofertas = $ofertas;
    echo json_encode($respuesta);
    exit;
}

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = json_decode(file_get_contents('php://input'));

    // Verificar si se recibió el parámetro 'x'
    if (isset($datos->x)) {
        $x = $datos->x;

        // Iniciamos una conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'bd');

        // Verificamos que la conexión se haya realizado con éxito
        if ($conn->connect_error) {
            // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
            error();
        }

        // Obtenemos la lista de ofertas de la base de datos
        $sql = "SELECT * FROM Ofertas ORDER BY Id DESC LIMIT $x";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        // Convertimos el resultado de la consulta a un arreglo
        $ofertas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $ofertas[] = $fila;
        }

        exito($ofertas);
    } else {
        // Si no se recibió el parámetro 'x', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}