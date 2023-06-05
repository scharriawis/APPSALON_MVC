<div class="barra">
    <p>Hola: <?php echo $nombre . ' ' . $apellido ?? ''; ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['admin'])) : ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">Citas</a>
        <a class="boton" href="/servicios">Servicios</a>
        <a class="boton" href="/servicios/crear">Crear Servicios</a>
    </div>
<?php endif; ?>