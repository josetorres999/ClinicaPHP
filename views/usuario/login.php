<h2>Login</h2>
<form action="<?=base_url?>usuario/iniciarSesion" method="POST">
    <p>Email</p>
    <input type="text" name="emLog" placeholder="Email..."><br>
    <p>Contraseña</p>
    <input type="password" name="passLog"><br>
    <input type="submit" value="Iniciar sesion" name="subLog">
</form>