<?php
// Especificación de la función
// Endpoint: /usuario/login.php
// - Método: POST
// - Descripción: verifica las credenciales del usuario retornando verdadero o falso según la operación sea exitosa o no.
// - Parámetros:
// - correo (string, obligatorio): Correo electrónico del usuario.
// - contrasena (string, obligatorio): Contraseña del usuario.

class Respuesta {
    public $exito;
}

// Validar que los parámetros obligatorios estén presentes.
if (!isset($_POST['correo']) || !isset($_POST['contrasena'])) {
    http_response_code(400);
    echo json_encode(array('error' => 'Faltan parámetros obligatorios.'));
    return;
}

// Validar que el correo sea válido.
if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(array('error' => 'El correo no es válido.'));
    return;
}

// Validar que la contraseña tenga al menos 8 caracteres.
if (strlen($_POST['contrasena']) < 8) {
    http_response_code(400);
    echo json_encode(array('error' => 'La contraseña debe tener al menos 8 caracteres.'));
    return;
}

// Verficar credenciales
$conn = new mysqli("localhost", "root", "", "bd");
if ($conn->connect_error) {
    die("Connection failed");
}

$sql = "SELECT Id, NombreUsuario, Correo, Contrasena, IdFotoPerfil FROM Usuarios WHERE Correo = '$_POST[correo]' AND Contrasena = '$_POST[contrasena]'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $resultado = new Respuesta();
    $resultado->exito = true;
    echo json_encode($resultado);
} else {
    http_response_code(401);
    echo json_encode(array('error' => 'Credenciales inválidas.'));
}