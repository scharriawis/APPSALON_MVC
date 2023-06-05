<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/" method="POST" class="formulario">
    <div class="campo">
        <label for="email">email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            placeholder="Tu email"
            value="<?php echo $auth->email; ?>"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            placeholder="Tu Password"
        />
    </div>
    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/create-account">¿No tienes una cuenta? crear una</a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>