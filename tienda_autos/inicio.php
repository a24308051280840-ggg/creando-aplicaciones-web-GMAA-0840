<?php
session_start();
$pagina_actual = "inicio.php";
$titulo_pagina = "Inicio";
include "header.php";
?>

  <main>
    <section class="intro">
      <h2>Bienvenido a AutoVenta</h2>
      <p>Somos una tienda en línea de autos nuevos. Aquí puedes conocer los modelos de las marcas más populares, comparar precios y apartar el auto que más te guste desde tu casa.</p>
    </section>

    <section class="caja">
      <h2>¿Cómo funciona?</h2>
      <p>1. Crea tu cuenta en la sección <strong>Registrarme</strong> e inicia sesión.</p>
      <p>2. Entra a la categoría que te interese: sedanes, SUV, pickups o deportivos.</p>
      <p>3. Elige el auto, da clic en <strong>Apartar</strong>, escoge el color y la forma de pago.</p>
      <p>4. Revisa tus autos apartados en la sección <strong>Mis pedidos</strong>.</p>
    </section>

    <section class="caja">
      <h2>Nuestras categorías</h2>
      <div class="tarjetas">
        <div class="tarjeta">
          <h3>Sedanes</h3>
          <p>Autos cómodos y económicos para el día a día y la familia.</p>
          <a class="boton-link" href="sedanes.php">Ver sedanes</a>
        </div>
        <div class="tarjeta">
          <h3>SUV</h3>
          <p>Más espacio, más altura y seguridad para la ciudad y la carretera.</p>
          <a class="boton-link" href="suv.php">Ver SUV</a>
        </div>
        <div class="tarjeta">
          <h3>Pickups</h3>
          <p>Fuerza y capacidad de carga para el trabajo y la aventura.</p>
          <a class="boton-link" href="pickups.php">Ver pickups</a>
        </div>
        <div class="tarjeta">
          <h3>Deportivos</h3>
          <p>Potencia y diseño para quienes buscan emociones al volante.</p>
          <a class="boton-link" href="deportivos.php">Ver deportivos</a>
        </div>
      </div>
    </section>
  </main>

<?php include "footer.php"; ?>
