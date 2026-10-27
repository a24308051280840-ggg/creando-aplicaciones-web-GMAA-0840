<?php
session_start();
require "conexion.php";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $clave  = $_POST["contrasena"];

    $consulta = $conexion->prepare("SELECT id, nombre, contrasena FROM usuarios WHERE correo = ?");
    $consulta->bind_param("s", $correo);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        if (password_verify($clave, $fila["contrasena"])) {
            $_SESSION["id_usuario"] = $fila["id"];
            $_SESSION["nombre"] = $fila["nombre"];
            header("Location: index.php");
            exit;
        }
    }
    $mensaje = "Correo o contraseña incorrectos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión | AutoVenta</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <header>
    <h1>AutoVenta</h1>
    <nav>
      <a href="registro.php">Registrarme</a>
    </nav>
  </header>

  <div class="caja caja-chica">
    <h2>Iniciar sesión</h2>

    <?php if ($mensaje != "") { ?>
      <p class="mensaje-error"><?php echo $mensaje; ?></p>
    <?php } ?>

    <form action="login.php" method="post">
      <label for="correo">Correo electrónico</label>
      <input type="email" id="correo" name="correo" required>

      <label for="contrasena">Contraseña</label>
      <input type="password" id="contrasena" name="contrasena" required>

      <button type="submit">Entrar</button>
    </form>

    <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
  </div>
</body>
