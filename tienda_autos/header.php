<?php
// Requiere que session_start() ya se haya llamado antes de incluir este archivo
if (!isset($pagina_actual)) { $pagina_actual = ""; }
function activo($archivo, $pagina_actual) {
    return ($archivo == $pagina_actual) ? 'class="activo"' : '';
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
      <?php if (isset($_SESSION["id_usuario"])) { ?>
        <a href="mis_pedidos.php" <?php echo activo("mis_pedidos.php", $pagina_actual); ?>>Mis pedidos</a>
        <a href="logout.php">Cerrar sesión (<?php echo htmlspecialchars($_SESSION["nombre"]); ?>)</a>
      <?php } else { ?>
        <a href="login.php">Iniciar sesión</a>
        <a href="registro.php">Registrarme</a>
      <?php } ?>
    </nav>
  </header>
