<?php
session_start();
require "conexion.php";

// Si no ha iniciado sesión, lo mandamos al login
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$mensaje = "";

// Guardar el pedido en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_auto    = (int) $_POST["auto"];
    $color      = $_POST["color"];
    $forma_pago = $_POST["forma_pago"];

    if ($id_auto > 0) {
        $insertar = $conexion->prepare("INSERT INTO pedidos (id_usuario, id_auto, color, forma_pago) VALUES (?, ?, ?, ?)");
        $insertar->bind_param("iiss", $_SESSION["id_usuario"], $id_auto, $color, $forma_pago);
        $insertar->execute();
        $mensaje = "Tu auto fue apartado correctamente.";
    }
}

// Marca elegida para filtrar (formulario 1)
$marca = isset($_GET["marca"]) ? $_GET["marca"] : "";

// Lista de marcas
$marcas = $conexion->query("SELECT DISTINCT marca FROM autos ORDER BY marca");

// Autos (todos o de la marca elegida)
if ($marca != "") {
    $consulta = $conexion->prepare("SELECT id, marca, modelo, anio, precio FROM autos WHERE marca = ?");
    $consulta->bind_param("s", $marca);
    $consulta->execute();
    $autos = $consulta->get_result();
} else {
    $autos = $conexion->query("SELECT id, marca, modelo, anio, precio FROM autos");
}

// Pedidos del usuario
$mis_pedidos = $conexion->prepare(
  "SELECT a.marca, a.modelo, a.anio, a.precio, d.color, d.forma_pago, d.fecha
   FROM pedidos d INNER JOIN autos a ON d.id_auto = a.id
   WHERE d.id_usuario = ? ORDER BY d.fecha DESC"
);
$mis_pedidos->bind_param("i", $_SESSION["id_usuario"]);
$mis_pedidos->execute();
$pedidos = $mis_pedidos->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AutoVenta</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <header>
    <h1>AutoVenta</h1>
    <nav>
      Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?>
      <a href="logout.php">Cerrar sesión</a>
    </nav>
  </header>

  <main>
    <?php if ($mensaje != "") { ?>
      <p class="mensaje-ok"><?php echo $mensaje; ?></p>
    <?php } ?>

    <!-- Formulario 1: elegir marca -->
    <section class="caja">
      <h2>1. Elige una marca</h2>
      <form action="index.php" method="get">
        <label for="marca">Marca</label>
        <select id="marca" name="marca">
          <option value="">Todas las marcas</option>
          <?php while ($m = $marcas->fetch_assoc()) { ?>
            <option value="<?php echo htmlspecialchars($m["marca"]); ?>"
              <?php if ($m["marca"] == $marca) echo "selected"; ?>>
              <?php echo htmlspecialchars($m["marca"]); ?>
            </option>
          <?php } ?>
        </select>
        <button type="submit">Ver autos</button>
      </form>
    </section>

    <!-- Formulario 2: apartar auto -->
    <section class="caja">
      <h2>2. Aparta tu auto</h2>
      <form action="index.php" method="post">
        <label for="auto">Auto</label>
        <select id="auto" name="auto" required>
          <?php while ($a = $autos->fetch_assoc()) { ?>
            <option value="<?php echo $a["id"]; ?>">
              <?php echo htmlspecialchars($a["marca"] . " " . $a["modelo"] . " " . $a["anio"]) . " - $" . number_format($a["precio"], 2); ?>
            </option>
          <?php } ?>
        </select>

        <label for="color">Color</label>
        <select id="color" name="color" required>
          <option>Blanco</option><option>Negro</option><option>Gris</option>
          <option>Rojo</option><option>Azul</option><option>Plata</option>
        </select>

        <label for="forma_pago">Forma de pago</label>
        <select id="forma_pago" name="forma_pago" required>
          <option>Contado</option>
          <option>Financiamiento</option>
          <option>Tarjeta de crédito</option>
        </select>

        <button type="submit">Apartar auto</button>
      </form>
    </section>

    <!-- Mis pedidos -->
    <section class="caja">
      <h2>Mis autos apartados</h2>
      <table>
        <tr>
          <th>Auto</th><th>Color</th><th>Pago</th><th>Precio</th><th>Fecha</th>
        </tr>
        <?php while ($d = $pedidos->fetch_assoc()) { ?>
          <tr>
            <td><?php echo htmlspecialchars($d["marca"] . " " . $d["modelo"] . " " . $d["anio"]); ?></td>
            <td><?php echo $d["color"]; ?></td>
            <td><?php echo $d["forma_pago"]; ?></td>
            <td>$<?php echo number_format($d["precio"], 2); ?></td>
            <td><?php echo $d["fecha"]; ?></td>
          </tr>
        <?php } ?>
      </table>
    </section>
  </main>

  <footer>
    <p>Práctica 1 - Formulario | Construye Aplicaciones Web</p>
  </footer>
</body>
</html>
