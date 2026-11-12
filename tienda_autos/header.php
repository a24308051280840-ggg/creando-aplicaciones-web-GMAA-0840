<?php
// Requiere que session_start() ya se haya llamado antes de incluir este archivo
require_once "conexion.php";
if (!isset($pagina_actual)) { $pagina_actual = ""; }
function activo($archivo, $pagina_actual) {
    return ($archivo == $pagina_actual) ? 'class="activo"' : '';
}

// Devuelve la foto de un auto: primero el enlace (imagen_url) y si no hay,
// la carpeta imagenes y sus subcarpetas por categoría (jpg, jpeg, png o webp)
function ruta_foto($imagen, $url = "") {
    // Si el auto tiene un enlace directo a su imagen, se usa ese
    if (substr($url, 0, 4) == "http") { return $url; }
    if ($imagen == "") { return ""; }
    $carpetas = array("", "Sedanes/", "SUV/", "Pickups/", "Deportivos/");
    foreach ($carpetas as $carpeta) {
        foreach (array("jpg", "jpeg", "png", "webp") as $ext) {
            $ruta = "imagenes/" . $carpeta . $imagen . "." . $ext;
            if (file_exists($ruta)) { return $ruta; }
        }
    }
    return "";
}

// Cantidad de autos en el carrito del usuario
$num_carrito = 0;
if (isset($_SESSION["id_usuario"])) {
    $q = $conexion->prepare("SELECT COALESCE(SUM(cantidad), 0) FROM carrito WHERE id_usuario = ?");
    $q->bind_param("i", $_SESSION["id_usuario"]);
    $q->execute();
    $q->bind_result($num_carrito);
    $q->fetch();
    $q->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $titulo_pagina; ?> | AutoVenta</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <header>
    <h1>AutoVenta</h1>
    <nav>
      <a href="inicio.php" <?php echo activo("inicio.php", $pagina_actual); ?>>Inicio</a>
      <a href="sedanes.php" <?php echo activo("sedanes.php", $pagina_actual); ?>>Sedanes</a>
      <a href="suv.php" <?php echo activo("suv.php", $pagina_actual); ?>>SUV</a>
      <a href="pickups.php" <?php echo activo("pickups.php", $pagina_actual); ?>>Pickups</a>
      <a href="deportivos.php" <?php echo activo("deportivos.php", $pagina_actual); ?>>Deportivos</a>
      <a href="carrito.php" <?php echo activo("carrito.php", $pagina_actual); ?>>Carrito (<?php echo $num_carrito; ?>)</a>
      <?php if (isset($_SESSION["id_usuario"])) { ?>
        <a href="mis_pedidos.php" <?php echo activo("mis_pedidos.php", $pagina_actual); ?>>Mis compras</a>
        <a href="logout.php">Cerrar sesión (<?php echo htmlspecialchars($_SESSION["nombre"]); ?>)</a>
      <?php } else { ?>
        <a href="login.php">Iniciar sesión</a>
        <a href="registro.php">Registrarme</a>
      <?php } ?>
    </nav>
  </header>
