<?php

// La siguiente API entrega al usuario una lista de los x productos más recientes en la base de datos
/*
    Endpoint: /producto/obtener.php
    - Método: GET
    - Descripción: obtiene una lista de los x productos más recientes
    - Parámetros:
        - x (int, obligatorio): cantidad de productos a retornar.
*/

// Definimos la clase Respuesta
class Respuesta {
    public $exito;
    public $productos;
}

// Definimos la función error
function error() {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    $respuesta->productos = [];
    echo json_encode($respuesta);
    exit;
}

// Definimos la función exito
function exito($productos) {
    $respuesta = new Respuesta();
    $respuesta->exito = true;
    $respuesta->productos = $productos;
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

        // Obtenemos la lista de productos de la base de datos
        $sql = "SELECT * FROM Productos ORDER BY Id DESC LIMIT $x";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            echo $conn->error;
            error();
        }

        // Convertimos el resultado de la consulta a un arreglo
        $productos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }

        exito($productos);
    } else {
        // Si no se recibió el parámetro 'x', devolver un mensaje de error
        echo "No se recibió el parámetro x";
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    echo "Esta API usa el método POST";
    error();
}