<?php
session_start();
require "conexion.php";

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

// Compras del usuario
$consulta = $conexion->prepare("SELECT id, total, forma_pago, fecha FROM ventas WHERE id_usuario = ? ORDER BY fecha DESC, id DESC");
$consulta->bind_param("i", $_SESSION["id_usuario"]);
$consulta->execute();
$ventas = $consulta->get_result();

// Detalle de cada compra
$detalle = $conexion->prepare(
    "SELECT a.marca, a.modelo, a.anio, d.color, d.cantidad, d.precio_unitario
     FROM venta_detalle d INNER JOIN autos a ON d.id_auto = a.id
     WHERE d.id_venta = ?"
);

$pagina_actual = "mis_pedidos.php";
$titulo_pagina = "Mis compras";
include "header.php";
?>

  <main>
    <?php if (isset($_GET["ok"])) { ?>
      <p class="mensaje-ok">¡Compra realizada con éxito!</p>
    <?php } ?>

    <?php if ($ventas->num_rows == 0) { ?>
      <section class="caja">
        <h2>Mis compras</h2>
        <p>Todavía no has hecho ninguna compra.</p>
      </section>
    <?php } ?>

    <?php while ($v = $ventas->fetch_assoc()) { ?>
      <section class="caja">
        <h2>Compra #<?php echo $v["id"]; ?></h2>
        <p>Fecha: <?php echo $v["fecha"]; ?> | Pago: <?php echo $v["forma_pago"]; ?></p>

        <table>
          <tr><th>Auto</th><th>Color</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr>
          <?php
            $detalle->bind_param("i", $v["id"]);
            $detalle->execute();
            $filas = $detalle->get_result();
            while ($d = $filas->fetch_assoc()) { ?>
            <tr>
              <td><?php echo htmlspecialchars($d["marca"] . " " . $d["modelo"] . " " . $d["anio"]); ?></td>
              <td><?php echo $d["color"]; ?></td>
              <td><?php echo $d["cantidad"]; ?></td>
              <td>$<?php echo number_format($d["precio_unitario"], 2); ?></td>
              <td>$<?php echo number_format($d["precio_unitario"] * $d["cantidad"], 2); ?></td>
            </tr>
          <?php } ?>
        </table>

        <p class="total">Total: $<?php echo number_format($v["total"], 2); ?></p>
      </section>
    <?php } ?>
  </main>

<?php include "footer.php"; ?>
