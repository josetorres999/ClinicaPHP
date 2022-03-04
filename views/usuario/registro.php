<h2>Registro</h2>

<form action="<?=base_url?>usuario/save" method="POST" id="formRegistro">

    <p>Nombre</p>
    <input type="text" name="nomReg" id="">
    <?php if(!empty($_SESSION['errorReg'][0])){echo $_SESSION['errorReg'][0];} ?>
    <p>Apellidos</p>
    <input type="text" name="apReg" id="">
    <?php if(!empty($_SESSION['errorReg'][1])){echo $_SESSION['errorReg'][1];} ?>
    <p>Email</p>
    <input type="email" name="emReg" id="">
    <?php if(!empty($_SESSION['errorReg'][2])){echo $_SESSION['errorReg'][2];} ?>
    <p>Contraseña</p>
    <input type="password" name="pasReg" id="">
    <?php if(!empty($_SESSION['errorReg'][3])){echo $_SESSION['errorReg'][3];} ?>
    <br><br>
    <input type="submit" value="registrar" name="registrar">


</form>
