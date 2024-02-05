<?php

// La siguiente API se encarga de eliminar un producto de la base de datos
/*
    Endpoint: /producto/eliminar.php
    - Método: POST
    - Descripción: elimina un producto existente, retornando verdadero o falso según la operación sea exitosa o no
    - Parámetros:
        - id (int, obligatorio): ID del producto a eliminar
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
    // Verificar si se recibió el parámetro 'id'
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Iniciamos una conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'bd');

        // Verificamos que la conexión se haya realizado con éxito
        if ($conn->connect_error) {
            // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
            error();
        }

        // Eliminamos el producto de la base de datos
        $sql = "DELETE FROM Productos WHERE Id = $id";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        exito();
    } else {
        // Si no se recibió el parámetro 'id', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}