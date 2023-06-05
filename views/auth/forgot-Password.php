<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">
    Reestablece tu password escribiendo tu email a continiacion
</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form action="/forgot" method="post" class="formulario">
    <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email" 
            name="email" 
            id="email"
            placeholder="Tu e-mail"
        />
    </div>
    <input type="submit" value="Enviar Instrucciones" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? inicia sesión</a>
    <a href="/create-account">¿No tienes una cuenta? crear una</a>
</div>