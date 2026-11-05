<?php
session_start();
require "conexion.php";

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$consulta = $conexion->prepare(
  "SELECT a.marca, a.modelo, a.anio, a.precio, c.nombre AS categoria, d.color, d.forma_pago, d.fecha
   FROM pedidos d
   INNER JOIN autos a ON d.id_auto = a.id
   INNER JOIN categorias c ON a.id_categoria = c.id
   WHERE d.id_usuario = ? ORDER BY d.fecha DESC"
);
$consulta->bind_param("i", $_SESSION["id_usuario"]);
$consulta->execute();
$pedidos = $consulta->get_result();

$pagina_actual = "mis_pedidos.php";
$titulo_pagina = "Mis pedidos";
include "header.php";
?>

  <main>
    <section class="caja">
      <h2>Mis autos apartados</h2>
      <table>
        <tr>
          <th>Auto</th><th>Categoría</th><th>Color</th><th>Pago</th><th>Precio</th><th>Fecha</th>
        </tr>
        <?php while ($d = $pedidos->fetch_assoc()) { ?>
          <tr>
            <td><?php echo htmlspecialchars($d["marca"] . " " . $d["modelo"] . " " . $d["anio"]); ?></td>
            <td><?php echo htmlspecialchars($d["categoria"]); ?></td>
            <td><?php echo $d["color"]; ?></td>
            <td><?php echo $d["forma_pago"]; ?></td>
            <td>$<?php echo number_format($d["precio"], 2); ?></td>
            <td><?php echo $d["fecha"]; ?></td>
          </tr>
        <?php } ?>
      </table>
    </section>
  </main>

<?php include "footer.php"; ?>
