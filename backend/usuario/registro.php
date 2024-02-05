<?php
/*
    Endpoint: /usuario/registro.php
    - Método: POST
    - Descripción: crea una cuenta en el servidor para el usuario, retornando el id del usuario creado.
    - Parámetros:
        - foto (blob, opcional): foto de perfil del usuario.
        - nombredeusuario (string, obligatorio): nombre completo del usuario.
        - correo (string, obligatorio): correo electrónico del usuario.
        - contrasena (string, obligatorio): contraseña de la cuenta del usuario.
    La solicitud debe estar en formato JSON
*/

class Respuesta {
    public $exito;
    public $id;
}

// Obtener los datos enviados en la solicitud
$datos = json_decode(file_get_contents('php://input'));

// Revisar que los parámetros obligatorios estén presentes
if (!isset($datos->nombredeusuario) || !isset($datos->correo) || !isset($datos->contrasena)) {
    http_response_code(400); // Bad request
    echo json_encode("Error: Faltan parámetros obligatorios.");
    return;
}

// Obtener los parámetros enviados en la solicitud
$foto = $datos->foto;
$nombredeusuario = $datos->nombredeusuario;
$correo = $datos->correo;
$contrasena = $datos->contrasena;

$conn = new mysqli("localhost", "root", "", "bd");
if ($conn->connect_error) {
    die("Connection failed");
}

// Revisar si el usuario ya existe en la base de datos
$sql = "SELECT * FROM Usuarios WHERE Correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $operacionExitosa = new Respuesta();
    $operacionExitosa->exito = false;
    echo json_encode($operacionExitosa);
    return;
} else {
    // Crear el usuario en la base de datos
    $sql = "INSERT INTO Usuarios (NombreUsuario, Correo, Contrasena) VALUES ('$nombredeusuario', '$correo', '$contrasena')";
    $conn->query($sql);

    // Obtener el id del usuario creado
    $sql = "SELECT Id FROM Usuarios WHERE Correo = '$correo'";
    $result = $conn->query($sql);

    // Revisar si la solicitud SQL fue exitosa
    if ($result->num_rows === 0) {
        $operacionExitosa = new Respuesta();
        $operacionExitosa->exito = false;
        echo json_encode($operacionExitosa);
        return;
    }

    $row = $result->fetch_assoc();
    $id = $row['Id'];

    // Retornar el id del usuario creado
    $operacionExitosa = new Respuesta();
    $operacionExitosa->exito = true;
    $operacionExitosa->id = $id;
    echo json_encode($operacionExitosa);
}