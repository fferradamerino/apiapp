<?php

class Respuesta {
    public $exito;
}

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = json_decode(file_get_contents('php://input'));

    // Revisamos que los parámetros obligatorios estén presentes. Recordemos que la solicitud viene en formato JSON.
    if (!isset($datos->id) || !isset($datos->nombreusuario) || !isset($datos->correo) || !isset($datos->contrasena)) {
        http_response_code(400); // Bad request
        echo json_encode("Error: Faltan parámetros obligatorios.");
        return;
    }

    // Obtener los parámetros enviados en la solicitud
    $id = $datos->id;
    $nombreusuario = $datos->nombreusuario;
    $correo = $datos->correo;
    $contrasena = $datos->contrasena;
    $foto = $datos->foto;

    $conn = new mysqli("localhost", "root", "", "bd");

    if ($conn->connect_error) {
        die("Connection failed");
    }

    // Revisamos si el usuario existe en la base de datos
    $sql = "SELECT * FROM Usuarios WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        $operacionExitosa = new Respuesta();
        $operacionExitosa->exito = false;
        echo json_encode($operacionExitosa);
        return;
    }

    // Actualizamos el usuario en la base de datos
    $sql = "UPDATE Usuarios SET NombreUsuario = '$nombreusuario', Correo = '$correo', Contrasena = '$contrasena' WHERE Id = $id";
    $conn->query($sql);

    // Retornar verdadero o falso dependiendo si la operación fue exitosa
    $operacionExitosa = new Respuesta();
    $operacionExitosa->exito = true;
    echo json_encode($operacionExitosa);
} else {
    // Retornar un error si la solicitud no es de tipo POST
    http_response_code(405); // Método no permitido
    echo json_encode("Error: Método no permitido");
}
