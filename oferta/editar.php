<?php

// La siguiente API se encarga de editar una oferta de la base de datos
/*
    Endpoint: /oferta/editar.php
    - Método: POST
    - Descripción: permite la edición de una oferta existente, retornando verdadero o falso si la operación fue exitosa
    - Parámetros:
        - idOferta (int, obligatorio): ID de la oferta en la base de datos
        - titulo (string, obligatorio): título de la oferta
        - subtitulo (string, opcional): subtítulo de la oferta
        - contenido (string, obligatorio): descripción de la oferta
        - descuento (float, obligatorio): descuento a aplicar al producto
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
    // Verificar si se recibieron los parámetros 'idOferta', 'titulo', 'contenido' y 'descuento'
    if (isset($_POST['idOferta']) && isset($_POST['titulo']) && isset($_POST['contenido']) && isset($_POST['descuento'])) {
        $idOferta = $_POST['idOferta'];
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $descuento = $_POST['descuento'];

        // Iniciamos una conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'bd');

        // Verificamos que la conexión se haya realizado con éxito
        if ($conn->connect_error) {
            // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
            error();
        }

        // Editamos la oferta en la base de datos
        $sql = "UPDATE Ofertas SET Titulo = '$titulo', Contenido = '$contenido', Descuento = $descuento WHERE Id = $idOferta";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        exito();
    } else {
        // Si no se recibieron los parámetros 'idOferta', 'titulo', 'contenido' y 'descuento', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}