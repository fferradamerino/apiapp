<?php

class Respuesta {
    public $exito;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    echo json_encode($respuesta);
    $conn->close();
    return;
}

$datos = json_decode(file_get_contents('php://input'));

// Validamos que los valores obligatorios estén presentes
if (!isset($datos->titulo) || !isset($datos->contenido) || !isset($datos->descuento) || !isset($datos->idProducto)) {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    echo json_encode($respuesta);
    $conn->close();
    return;
}

// Obtener los parámetros de la solicitud
$titulo = $datos->titulo;
$subtitulo = $datos->subtitulo;
$contenido = $datos->contenido;
$descuento = $datos->descuento;
$idProducto = $datos->idProducto;

// Insertar la oferta en la base de datos
$sql = "INSERT INTO Ofertas (Titulo, Subtitulo, Contenido, Descuento, IdProducto) VALUES ('$titulo', '$subtitulo', '$contenido', $descuento, $idProducto)";
if ($conn->query($sql) === TRUE) {
    $respuesta = new Respuesta();
    $respuesta->exito = true;
    echo json_encode($respuesta);
    $conn->close();
    return;
} else {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    echo json_encode($respuesta);
    $conn->close();
    return;
}
