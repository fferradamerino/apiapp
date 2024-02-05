<?php

// La siguiente API se encarga de crear productos en la base de datos
/*
    Endpoint: /producto/crear.php
    - Método: POST
    - Descripción: crea un producto nuevo, retornando verdadero o falso según la operación sea exitosa o no
    - Parámetros:
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
    // Verificar si se recibieron los parámetros 'nombre', 'precio' y 'nombreCatalogo'
    if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['nombreCatalogo'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $nombreCatalogo = $_POST['nombreCatalogo'];

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

        // Obtenemos el ID del catálogo
        $idCatalogo = $resultado->fetch_assoc()['Id'];

        // Creamos el producto en la base de datos
        $sql = "INSERT INTO Productos (Nombre, Precio, IdCatalogo) VALUES ('$nombre', $precio, $idCatalogo)";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        exito();
    } else {
        // Si no se recibieron los parámetros 'nombre', 'precio' y 'nombreCatalogo', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}