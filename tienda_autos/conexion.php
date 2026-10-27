<?php
// Datos de conexión (XAMPP por defecto: usuario root y sin contraseña)
$servidor = "localhost";
$usuario  = "root";
$clave    = "";
$bd       = "tienda_autos";

$conexion = new mysqli($servidor, $usuario, $clave, $bd);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8mb4");
