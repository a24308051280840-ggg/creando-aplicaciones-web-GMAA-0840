<?php
session_start();
require "conexion.php";

// Para usar el carrito hay que iniciar sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id    = (int) $_POST["id"];
    $color = $_POST["color"];
    $colores = array("Blanco", "Negro", "Gris", "Rojo", "Azul", "Plata");

    // Revisar que el auto exista y que el color sea válido
    $buscar = $conexion->prepare("SELECT id FROM autos WHERE id = ?");
    $buscar->bind_param("i", $id);
    $buscar->execute();
    $buscar->store_result();

    if ($buscar->num_rows > 0 && in_array($color, $colores)) {
        // Si ya estaba en el carrito con ese color, suma 1; si no, lo agrega
        $agregar = $conexion->prepare(
            "INSERT INTO carrito (id_usuario, id_auto, color, cantidad) VALUES (?, ?, ?, 1)
             ON DUPLICATE KEY UPDATE cantidad = LEAST(cantidad + 1, 10)"
        );
        $agregar->bind_param("iis", $_SESSION["id_usuario"], $id, $color);
        $agregar->execute();
    }
}

header("Location: carrito.php");
exit;
