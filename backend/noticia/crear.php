<?php

// La siguiente API se encarga de crear noticias en el servidor
/*
    - Método: POST
    - Descripción: crear una noticia nueva, retornando verdadero o falso si la operación fue exitosa
    - Parámetros:
        - imagen1 (blob, obligatorio): la primera imagen a mostrar de la noticia
        - imagen2 (blob, opcional): la segunda imagen a mostrar de la noticia
        - imagen3 (blob, opcional): la tercera imagen a mostrar de la noticia
        - titulo (string, obligatorio): título de la noticia
        - subtitulo (string, opcional): subtítulo de la noticia
        - contenido (string, obligatorio): contenido de la noticia
        - seccion (string, obligatorio): seccion de la noticia. Si esta no existe, se crea una nueva
*/

// Las imágenes se subirán posteriormente en una plataforma aparte

// El esquema de la base de datos para Noticias es el siguiente:
// - Id (int, autoincremental)
// - Contenido (string)
// - Sección (string)
// - Título (string)
// - Subtítulo (string)

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

    // Verificar si se recibieron los parámetros 'imagen1', 'titulo', 'contenido' y 'seccion'
    if (isset($datos->titulo) || isset($datos->contenido) || isset($datos->seccion)) {
        $titulo = $datos->titulo;
        $contenido = $datos->contenido;
        $seccion = $datos->seccion;

        // Iniciamos una conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'bd');

        // Verificamos que la conexión se haya realizado con éxito
        if ($conn->connect_error) {
            // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
            error();
        }

        // Insertamos la noticia en la base de datos
        $sql = "INSERT INTO Noticias (Contenido, Seccion, Titulo) VALUES ('$contenido', '$seccion', '$titulo')";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        exito();
    } else {
        // Si no se recibieron los parámetros 'imagen1', 'titulo', 'contenido' y 'seccion', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}