<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<?php if($mensaje) : ?>
    <div class="alertas exito">
        <?php mensaje($mensaje); ?>
    </div>
<?php endif; ?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="form">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date" 
                name="fecha" 
                id="fecha"
                value="<?php echo $fecha; ?>"
            />
        </div>
    </form>
</div>

<div id="citas-admin">
    <?php
        if(count($citas) === 0){
            echo '<h3>No hay Citas Asignadas</h3>';
        }
    ?>
    <ul class="citas">
        <?php $idCita = 0; ?>
        <?php foreach($citas as $key => $cita): ?>
            <?php 
                if($idCita !== $cita->id): 
                    $total = 0;
            ?>
                <li>
                        <p>Id: <span><?php echo $cita->id; ?></span></p>
                        <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                        <p>Nombre: <span><?php echo $cita->cliente; ?></span></p>
                        <p>Email: <span><?php echo $cita->email; ?></span></p>
                        <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

                        <h3>Servicios</h3>
                        <?php $idCita = $cita->id; ?>
                    
                <?php endif; ?>
                        <p class="servicio">
                            <?php echo $cita->servicio . ' $' . $cita->precio; ?>
                        </p>
                        <?php $total += $cita->precio;?>
                <?php
                    $actual = $cita->id;        //es igual al id del database
                    $proximo = $citas[$key +1]->id ?? 0;    //igual al valor del id de la data base
                    ?>
                <?php
                    if(isLast($actual, $proximo)) :      //Sí es ultimo entonces imprime esto
                        echo '<p class="servicio-total">Valor total: <span>$' . $total . '</span></p>';
                    ?>
                        <form action="/api/eliminar" method="POST" >
                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                            <input type="submit" value="Eliminar" class="boton-eliminar">
                        </form>
                    <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<?php
    echo $script = "
                <script src='build/js/buscador.js'></script>
    ";
?>