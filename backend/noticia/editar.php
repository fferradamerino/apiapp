<?php

// La siguiente API se encarga de editar noticias en la base de datos del servidor
/*
    Endpoint: /noticia/editar.php
    - Método: POST
    - Descripción: edita una noticia existente, retornando verdadero o falso si la operación fue exitosa
    - Parámetros:
        - idNoticia (int, obligatorio): ID de la noticia
        - imagen1 (blob, obligatorio): la primera imagen a mostrar de la noticia
        - imagen2 (blob, opcional): la segunda imagen a mostrar de la noticia
        - imagen3 (blob, opcional): la tercera imagen a mostrar de la noticia
        - titulo (string, obligatorio): título de la noticia
        - subtitulo (string, opcional): subtítulo de la noticia
        - contenido (string, obligatorio): contenido de la noticia
        - seccion (string, obligatorio): seccion de la noticia. Si esta no existe, se crea una nueva
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
    // Verificar si se recibieron los parámetros 'idNoticia', 'imagen1', 'titulo', 'contenido' y 'seccion'
    if (isset($_POST['idNoticia']) && isset($_POST['titulo']) && isset($_POST['contenido']) && isset($_POST['seccion'])) {
        $idNoticia = $_POST['idNoticia'];
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $seccion = $_POST['seccion'];

        // Iniciamos una conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'bd');

        // Verificamos que la conexión se haya realizado con éxito
        if ($conn->connect_error) {
            // Si hubo un error al conectarse a la base de datos, devolver un mensaje de error
            error();
        }

        // Editamos la noticia en la base de datos
        $sql = "UPDATE Noticias SET Titulo = '$titulo', Contenido = '$contenido', Seccion = '$seccion' WHERE Id = $idNoticia";
        $resultado = $conn->query($sql);

        // Verificamos que la solicitud haya sido exitosa
        if ($resultado === false) {
            // Si la operación no fue exitosa, devolver un mensaje de error
            error();
        }

        exito();
    } else {
        // Si no se recibieron los parámetros 'idNoticia', 'imagen1', 'titulo', 'contenido' y 'seccion', devolver un mensaje de error
        error();
    }
} else {
    // Si no se recibió una solicitud POST, devolver un mensaje de error
    error();
}