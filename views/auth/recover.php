<h1 class="nombre-pagina">Reestablece tu password</h1>
<p class="descripcion-pagina">
    Escribe el nuevo password
</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php"
?>

<?php if($error) return; ?>

<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Password</label>
        <input 
        type="password" 
        name="password" 
        id="password"
        placeholder="Tu nuevo password"
        />
    </div>

    <input type="submit" value="Nuevo Password" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? inicia sesión</a>
    <a href="/create-account">¿No tienes una cuenta? crea una</a>
</div>