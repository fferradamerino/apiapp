<?php
// Especificación de la función
// Endpoint: /usuario/login.php
// - Método: POST
// - Descripción: verifica las credenciales del usuario retornando verdadero o falso según la operación sea exitosa o no.
// - Parámetros:
// - correo (string, obligatorio): Correo electrónico del usuario.
// - contrasena (string, obligatorio): Contraseña del usuario.
// La solicitud debe estar en formato JSON

class Respuesta {
    public $exito;
}

// Obtener los datos enviados en la solicitud
$datos = json_decode(file_get_contents('php://input'));

// Revisar que los parámetros obligatorios estén presentes
if (!isset($datos->correo) || !isset($datos->contrasena)) {
    http_response_code(400); // Bad request
    echo json_encode("Error: Faltan parámetros obligatorios.");
    return;
}

// Obtener los parámetros enviados en la solicitud
$correo = $datos->correo;
$contrasena = $datos->contrasena;

$conn = new mysqli("localhost", "root", "", "bd");

if ($conn->connect_error) {
    die("Connection failed");
}

// Revisar si el usuario existe en la base de datos
$sql = "SELECT * FROM Usuarios WHERE Correo = '$correo' AND Contrasena = '$contrasena'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    $operacionExitosa = new Respuesta();
    $operacionExitosa->exito = false;
    echo json_encode($operacionExitosa);
    return;
} else {
    $operacionExitosa = new Respuesta();
    $operacionExitosa->exito = true;
    echo json_encode($operacionExitosa);
}