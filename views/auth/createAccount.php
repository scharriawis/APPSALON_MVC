<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">
    LLena el siguiente formulario para crear una cuenta
</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/create-account" method="post" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
        type="text" 
        name="nombre" 
        id="nombre"
        placeholder="Tu nombre"
        value="<?php echo s($user->nombre); ?>"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
        type="text" 
        name="apellido" 
        id="apellido"
        placeholder="Tu apellido"
        value="<?php echo s($user->apellido); ?>"
        />
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
        type="tel" 
        name="telefono" 
        id="telefono"
        placeholder="Tu telefono"
        value="<?php echo s($user->telefono); ?>"
        />
    </div>
    <div class="campo">
        <label for="email">E-mail</label>
        <input 
        type="text" 
        name="email" 
        id="email"
        placeholder="Tu e-mail"
        value="<?php echo s($user->email); ?>"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
        type="password" 
        name="password" 
        id="password"
        placeholder="Tu password"
        />
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? inicia sesión</a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>