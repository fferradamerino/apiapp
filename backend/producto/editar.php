<?php

// La siguiente API se encarga de editar productos en la base de datos
/*
    Endpoint: /producto/editar.php
    - Método: POST
    - Descripción: edita un producto ya existente, retornando verdadero o falso según la operación sea exitosa o no
    - Parámetros:
        - id (string, obligatorio): ID del producto
        - nombre (string, obligatorio): nombre del producto
        - precio (int, obligatorio): precio del producto
        - nombreCatalogo (string, obligatorio): nombre del catálogo al que el producto está asociado
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
    $datos = json_decode(file_get_contents('php://input'));

    // Verificar si se recibieron los parámetros 'id', 'nombre', 'precio' y 'nombreCatalogo'
    if (isset($datos->id) && isset($datos->nombre) && isset($datos->precio) && isset($datos->nombreCatalogo)) {
        $id = $datos->id;
        $nombre = $datos->nombre;
        $precio = $datos->precio;
        $nombreCatalogo = $datos->nombreCatalogo;

        // Iniciamos una conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'bd');

        // Verificamos que la conexión se haya realizado con éxito
        if ($conn->connect_error) {
            // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
            error();
        }

        // Obtenemos el ID del catálogo al que el producto está asociado
        $sql = "SELECT Id FROM Catalogo WHERE Nombre = '$nombreCatalogo'";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        // Obtenemos el ID del catálogo al que el producto está asociado
        $idCatalogo = $resultado->fetch_assoc()['Id'];

        // Actualizamos el producto en la base de datos
        $sql = "UPDATE Productos SET Nombre = '$nombre', Precio = $precio, IdCatalogo = $idCatalogo WHERE Id = $id";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        exito();
    } else {
        // Si no se recibieron los parámetros 'id', 'nombre', 'precio' y 'nombreCatalogo', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}