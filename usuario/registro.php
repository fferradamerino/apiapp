<?php
class Response {
    public $idUsuario;
}
class Usuario {
    public $id;
    public $nombredeusuario;
    public $correo;
    public $contrasena;
    public $foto;

    function guardar() {
        // Guardar el usuario en la base de datos.
        $conn = new mysqli("localhost", "root", "", "bd");

        if ($conn->connect_error) {
            die("Connection failed");
        }

        $sql = "INSERT INTO Usuarios (NombreUsuario, Correo, Contrasena) VALUES ('$this->nombredeusuario', '$this->correo', '$this->contrasena')";
        $conn->query($sql);

        // Obtener el ID del usuario
        $sql = "SELECT Id FROM Usuarios WHERE Correo = '$this->correo'";
        $this->id = $conn->query($sql)->fetch_assoc()['Id'];

        // Cierre de la conexión a la base de datos
        $conn->close();
    }
}

// Validar que los parámetros obligatorios estén presentes.
if (!isset($_POST['nombredeusuario']) || !isset($_POST['correo']) || !isset($_POST['contrasena'])) {
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

// Validar que la foto sea válida.
if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(array('error' => 'La foto no es válida.'));
    return;
}

// Verificar si la cuenta ya existe
$conn = new mysqli("localhost", "root", "", "bd");

if ($conn->connect_error) {
    die("Conexión fallida a la base de datos");
}

$sql = "SELECT Id FROM Usuarios WHERE Correo = '$_POST[correo]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    http_response_code(400);
    echo json_encode(array('error' => 'El correo ya está en uso.'));
    return;
}

// Crear el usuario.
$usuario = new Usuario();
$usuario->nombredeusuario = $_POST['nombredeusuario'];
$usuario->correo = $_POST['correo'];
$usuario->contrasena = $_POST['contrasena'];
$usuario->foto = isset($_FILES['foto']) ? file_get_contents($_FILES['foto']['tmp_name']) : null;
$usuario->guardar();

$respuesta = new Response();
$respuesta->idUsuario = intval($usuario->id, 10);

// Retornar el usuario creado.
echo json_encode($respuesta);