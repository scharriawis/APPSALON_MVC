<div class="campo">
    <label for="nombre">Nombre: </label>
    <input 
        type="text" 
        name="nombre"
        placeholder="Nombre servicio"
        id="nombre"
        value="<?php echo s($servicio->nombre); ?>"
    />
</div>
<div class="campo">
<label for="precio">Precio: </label>
    <input 
        type="number" 
        name="precio"
        id="precio"
        placeholder="Precio servicio"
        value="<?php echo s($servicio->precio); ?>"

    />
</div>