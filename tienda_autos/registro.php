<?php
require "conexion.php";
$mensaje = "";
$clase = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $clave1 = $_POST["contrasena"];
    $clave2 = $_POST["confirmar"];

    if ($nombre == "" || $correo == "" || $clave1 == "") {
        $mensaje = "Llena todos los campos.";
        $clase = "mensaje-error";
    } elseif ($clave1 != $clave2) {
        $mensaje = "Las contraseñas no coinciden.";
        $clase = "mensaje-error";
    } else {
        // Revisar si el correo ya existe
        $consulta = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $consulta->bind_param("s", $correo);
        $consulta->execute();
        $consulta->store_result();

        if ($consulta->num_rows > 0) {
            $mensaje = "Ese correo ya está registrado.";
            $clase = "mensaje-error";
        } else {
            $hash = password_hash($clave1, PASSWORD_DEFAULT);
            $insertar = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
            $insertar->bind_param("sss", $nombre, $correo, $hash);
            $insertar->execute();
            $mensaje = "Cuenta creada. Ya puedes iniciar sesión.";
            $clase = "mensaje-ok";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro | AutoVenta</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <header>
    <h1>AutoVenta</h1>
    <nav>
      <a href="login.php">Iniciar sesión</a>
    </nav>
  </header>

  <div class="caja caja-chica">
    <h2>Crear cuenta</h2>

    <?php if ($mensaje != "") { ?>
      <p class="<?php echo $clase; ?>"><?php echo $mensaje; ?></p>
    <?php } ?>

    <form action="registro.php" method="post">
      <label for="nombre">Nombre completo</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="correo">Correo electrónico</label>
      <input type="email" id="correo" name="correo" required>

      <label for="contrasena">Contraseña</label>
      <input type="password" id="contrasena" name="contrasena" required>

      <label for="confirmar">Confirmar contraseña</label>
      <input type="password" id="confirmar" name="confirmar" required>

      <button type="submit">Registrarme</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
  </div>
</body>
</html>
