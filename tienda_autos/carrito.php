<?php
session_start();
require "conexion.php";

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION["id_usuario"];
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"];

    // Cambiar la cantidad de un auto del carrito
    if ($accion == "actualizar") {
        $id_item  = (int) $_POST["id_item"];
        $cantidad = (int) $_POST["cantidad"];
        if ($cantidad < 1) { $cantidad = 1; }
        if ($cantidad > 10) { $cantidad = 10; }
        $q = $conexion->prepare("UPDATE carrito SET cantidad = ? WHERE id = ? AND id_usuario = ?");
        $q->bind_param("iii", $cantidad, $id_item, $id_usuario);
        $q->execute();
    }

    // Quitar un auto del carrito
    if ($accion == "quitar") {
        $id_item = (int) $_POST["id_item"];
        $q = $conexion->prepare("DELETE FROM carrito WHERE id = ? AND id_usuario = ?");
        $q->bind_param("ii", $id_item, $id_usuario);
        $q->execute();
    }

    // Vaciar todo el carrito
    if ($accion == "vaciar") {
        $q = $conexion->prepare("DELETE FROM carrito WHERE id_usuario = ?");
        $q->bind_param("i", $id_usuario);
        $q->execute();
    }

    // Finalizar la compra: pasa el carrito a ventas y venta_detalle
    if ($accion == "finalizar") {
        $forma_pago = $_POST["forma_pago"];

        $q = $conexion->prepare(
            "SELECT c.id_auto, c.color, c.cantidad, a.precio
             FROM carrito c INNER JOIN autos a ON c.id_auto = a.id
             WHERE c.id_usuario = ?"
        );
        $q->bind_param("i", $id_usuario);
        $q->execute();
        $items = $q->get_result()->fetch_all(MYSQLI_ASSOC);

        if (count($items) == 0) {
            $mensaje = "Tu carrito está vacío.";
        } else {
            $total = 0;
            foreach ($items as $it) {
                $total = $total + ($it["precio"] * $it["cantidad"]);
            }

            $conexion->begin_transaction();
            try {
                $venta = $conexion->prepare("INSERT INTO ventas (id_usuario, total, forma_pago) VALUES (?, ?, ?)");
                $venta->bind_param("ids", $id_usuario, $total, $forma_pago);
                $venta->execute();
                $id_venta = $conexion->insert_id;

                $detalle = $conexion->prepare(
                    "INSERT INTO venta_detalle (id_venta, id_auto, color, cantidad, precio_unitario) VALUES (?, ?, ?, ?, ?)"
                );
                foreach ($items as $it) {
                    $detalle->bind_param("iisid", $id_venta, $it["id_auto"], $it["color"], $it["cantidad"], $it["precio"]);
                    $detalle->execute();
                }

                $vaciar = $conexion->prepare("DELETE FROM carrito WHERE id_usuario = ?");
                $vaciar->bind_param("i", $id_usuario);
                $vaciar->execute();

                $conexion->commit();
                header("Location: mis_pedidos.php?ok=1");
                exit;
            } catch (Exception $e) {
                $conexion->rollback();
                $mensaje = "No se pudo completar la compra. Intenta de nuevo.";
            }
        }
    } else {
        // Después de cualquier otra acción se recarga la página
        header("Location: carrito.php");
        exit;
    }
}

// Autos que hay en el carrito
$consulta = $conexion->prepare(
    "SELECT c.id, c.color, c.cantidad, a.marca, a.modelo, a.anio, a.precio, a.imagen, a.imagen_url
     FROM carrito c INNER JOIN autos a ON c.id_auto = a.id
     WHERE c.id_usuario = ? ORDER BY c.id"
);
$consulta->bind_param("i", $id_usuario);
$consulta->execute();
$carrito = $consulta->get_result();

$total = 0;
$pagina_actual = "carrito.php";
$titulo_pagina = "Carrito";
include "header.php";
?>

  <main>
    <section class="caja">
      <h2>Mi carrito</h2>

      <?php if ($mensaje != "") { ?>
        <p class="mensaje-error"><?php echo $mensaje; ?></p>
      <?php } ?>

      <?php if ($carrito->num_rows == 0) { ?>
        <p>Tu carrito está vacío. Elige un auto en alguna de las categorías.</p>
        <a class="boton-link" href="sedanes.php">Ver autos</a>
      <?php } else { ?>

        <table>
          <tr>
            <th>Auto</th><th>Color</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th></th>
          </tr>
          <?php while ($c = $carrito->fetch_assoc()) {
              $subtotal = $c["precio"] * $c["cantidad"];
              $total = $total + $subtotal;
          ?>
            <tr>
              <td>
                <?php $foto = ruta_foto($c["imagen"], $c["imagen_url"]); ?>
                <?php if ($foto != "") { ?>
                  <img class="mini" referrerpolicy="no-referrer" src="<?php echo htmlspecialchars($foto); ?>" alt="">
                <?php } ?>
                <?php echo htmlspecialchars($c["marca"] . " " . $c["modelo"] . " " . $c["anio"]); ?>
              </td>
              <td><?php echo $c["color"]; ?></td>
              <td>$<?php echo number_format($c["precio"], 2); ?></td>
              <td>
                <form action="carrito.php" method="post" class="en-linea">
                  <input type="hidden" name="accion" value="actualizar">
                  <input type="hidden" name="id_item" value="<?php echo $c["id"]; ?>">
                  <input class="cant" type="number" name="cantidad" min="1" max="10" value="<?php echo $c["cantidad"]; ?>">
                  <button class="btn-chico" type="submit">Actualizar</button>
                </form>
              </td>
              <td>$<?php echo number_format($subtotal, 2); ?></td>
              <td>
                <form action="carrito.php" method="post" class="en-linea">
                  <input type="hidden" name="accion" value="quitar">
                  <input type="hidden" name="id_item" value="<?php echo $c["id"]; ?>">
                  <button class="btn-chico btn-gris" type="submit">Quitar</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </table>

        <p class="total">Total: $<?php echo number_format($total, 2); ?></p>

        <form action="carrito.php" method="post">
          <input type="hidden" name="accion" value="finalizar">
          <label for="forma_pago">Forma de pago</label>
          <select id="forma_pago" name="forma_pago" required>
            <option>Contado</option>
            <option>Financiamiento</option>
            <option>Tarjeta de crédito</option>
          </select>
          <button type="submit">Finalizar compra</button>
        </form>

        <form action="carrito.php" method="post">
          <input type="hidden" name="accion" value="vaciar">
          <button class="btn-gris" type="submit">Vaciar carrito</button>
        </form>

      <?php } ?>
    </section>
  </main>

<?php include "footer.php"; ?>
