<?php
// Verificar si el usuario está logueado
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: Menu.php");
    exit;
}

// Obtener el nombre de usuario actual
$nombre_usuario = $_SESSION['username'];

// Obtener el contenido del comentario enviado por el formulario
$contenido = $_POST['comentario'];

// Insertar el comentario en la base de datos
include("php/config.php");
$query = "INSERT INTO comentarios (nombre_usuario, contenido) VALUES ('$nombre_usuario', '$contenido')";
mysqli_query($con, $query);

// Redirigir de regreso al foro
header("Location: Menu.php#Foro");
?>
