<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">LLena el siguiente formulario para actualizar el servicio</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" method="POST">     <!--method="" se comenta en un formulario de tipo actualizar-->
    <?php
        include_once __DIR__ . '/formulario.php';
    ?>
    <input 
        type="submit" 
        value="Actualizar" 
        class="boton"
    />
</form>