<?php
// Plantilla compartida por sedanes.php, suv.php, pickups.php y deportivos.php
// Cada página define: $id_categoria, $titulo_pagina, $pagina_actual y $descripcion
require "conexion.php";

// Formulario de marca (se manda por GET, sin JavaScript)
$marca = isset($_GET["marca"]) ? $_GET["marca"] : "";

// Marcas que hay en esta categoría
$consulta_marcas = $conexion->prepare("SELECT DISTINCT marca FROM autos WHERE id_categoria = ? ORDER BY marca");
$consulta_marcas->bind_param("i", $id_categoria);
$consulta_marcas->execute();
$marcas = $consulta_marcas->get_result();

// Autos de la categoría (todos o solo de la marca elegida)
if ($marca != "") {
    $consulta = $conexion->prepare("SELECT id, marca, modelo, anio, precio, imagen, imagen_url, enlace FROM autos WHERE id_categoria = ? AND marca = ? ORDER BY precio");
    $consulta->bind_param("is", $id_categoria, $marca);
} else {
    $consulta = $conexion->prepare("SELECT id, marca, modelo, anio, precio, imagen, imagen_url, enlace FROM autos WHERE id_categoria = ? ORDER BY precio");
    $consulta->bind_param("i", $id_categoria);
}
$consulta->execute();
$autos = $consulta->get_result();

include "header.php";
?>

  <main>
    <section class="caja">
      <h2><?php echo $titulo_pagina; ?></h2>
      <p><?php echo $descripcion; ?></p>

      <form action="<?php echo $pagina_actual; ?>" method="get">
        <label for="marca">Filtrar por marca</label>
        <select id="marca" name="marca">
          <option value="">Todas las marcas</option>
          <?php while ($m = $marcas->fetch_assoc()) { ?>
            <option value="<?php echo htmlspecialchars($m["marca"]); ?>"
              <?php if ($m["marca"] == $marca) echo "selected"; ?>>
              <?php echo htmlspecialchars($m["marca"]); ?>
            </option>
          <?php } ?>
        </select>
        <button type="submit">Filtrar</button>
      </form>
    </section>

    <div class="tarjetas">
      <?php while ($a = $autos->fetch_assoc()) { ?>
        <div class="tarjeta">
          <?php $foto = ruta_foto($a["imagen"], $a["imagen_url"]); ?>
          <?php if ($foto != "") { ?>
            <img class="foto" referrerpolicy="no-referrer" src="<?php echo htmlspecialchars($foto); ?>" alt="<?php echo htmlspecialchars($a["marca"] . " " . $a["modelo"]); ?>">
          <?php } else { ?>
            <div class="foto sin-foto">Sin imagen</div>
          <?php } ?>
          <p class="marca"><?php echo htmlspecialchars($a["marca"]); ?></p>
          <h3><?php echo htmlspecialchars($a["modelo"]); ?></h3>
          <p>Modelo <?php echo $a["anio"]; ?></p>
          <p class="precio">$<?php echo number_format($a["precio"], 2); ?></p>
          <?php if ($a["enlace"] != "") { ?>
            <p class="enlace-sitio"><a href="<?php echo htmlspecialchars($a["enlace"]); ?>" target="_blank" rel="noopener">Ver sitio oficial</a></p>
          <?php } ?>
          <form action="agregar_carrito.php" method="post">
            <input type="hidden" name="id" value="<?php echo $a["id"]; ?>">
            <input type="hidden" name="volver" value="<?php echo $pagina_actual; ?>">
            <label for="color<?php echo $a["id"]; ?>">Color</label>
            <select id="color<?php echo $a["id"]; ?>" name="color">
              <option>Blanco</option><option>Negro</option><option>Gris</option>
              <option>Rojo</option><option>Azul</option><option>Plata</option>
            </select>
            <button type="submit">Agregar al carrito</button>
          </form>
        </div>
      <?php } ?>
    </div>
  </main>

<?php include "footer.php"; ?>
