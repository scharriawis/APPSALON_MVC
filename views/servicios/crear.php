<h1 class="nombre-pagina">Crear Servicio</h1>
<p class="descripcion-pagina">LLena el siguiente formulario para añadir un nuevo servicio</p>
<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input class="boton" type="submit" value="Crear Servicio">
</form>