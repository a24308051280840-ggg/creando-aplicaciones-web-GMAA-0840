<?php
session_start();
require "conexion.php";

// Para apartar hay que iniciar sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$id = isset($_REQUEST["id"]) ? (int) $_REQUEST["id"] : 0;

// Buscar el auto elegido
$consulta = $conexion->prepare(
  "SELECT a.id, a.marca, a.modelo, a.anio, a.precio, c.nombre AS categoria
   FROM autos a INNER JOIN categorias c ON a.id_categoria = c.id WHERE a.id = ?"
);
$consulta->bind_param("i", $id);
$consulta->execute();
$auto = $consulta->get_result()->fetch_assoc();

$mensaje = "";
$apartado = false;

// Guardar el pedido
if ($auto && $_SERVER["REQUEST_METHOD"] == "POST") {
    $color      = $_POST["color"];
    $forma_pago = $_POST["forma_pago"];

    $insertar = $conexion->prepare("INSERT INTO pedidos (id_usuario, id_auto, color, forma_pago) VALUES (?, ?, ?, ?)");
    $insertar->bind_param("iiss", $_SESSION["id_usuario"], $id, $color, $forma_pago);
    $insertar->execute();
    $mensaje = "Tu auto fue apartado correctamente.";
    $apartado = true;
}

$pagina_actual = "";
$titulo_pagina = "Apartar auto";
include "header.php";
?>

  <main>
    <?php if (!$auto) { ?>
      <p class="mensaje-error">No se encontró el auto. Regresa a una categoría y elige uno.</p>
    <?php } else { ?>

      <?php if ($mensaje != "") { ?>
        <p class="mensaje-ok"><?php echo $mensaje; ?> <a href="mis_pedidos.php">Ver mis pedidos</a></p>
      <?php } ?>

      <section class="caja">
        <h2>Apartar <?php echo htmlspecialchars($auto["marca"] . " " . $auto["modelo"]); ?></h2>
        <p>Categoría: <?php echo htmlspecialchars($auto["categoria"]); ?> | Modelo <?php echo $auto["anio"]; ?></p>
        <p class="precio">$<?php echo number_format($auto["precio"], 2); ?></p>

        <?php if (!$apartado) { ?>
        <form action="apartar.php" method="post">
          <input type="hidden" name="id" value="<?php echo $auto["id"]; ?>">

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
        <?php } ?>
      </section>

    <?php } ?>
  </main>

<?php include "footer.php"; ?>
