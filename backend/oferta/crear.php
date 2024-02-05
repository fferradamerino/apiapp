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

// Validamos que los valores obligatorios estén presentes
if (!isset($_POST['titulo']) || !isset($_POST['subtitulo']) || !isset($_POST['contenido']) || !isset($_POST['descuento']) || !isset($_POST['idProducto'])) {
    $respuesta = new Respuesta();
    $respuesta->exito = false;
    echo json_encode($respuesta);
    $conn->close();
    return;
}

// Obtener los parámetros de la solicitud
$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$contenido = $_POST['contenido'];
$descuento = $_POST['descuento'];
$idProducto = $_POST['idProducto'];

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
