<?php

require_once("./controllers/EspecialidadController.php");

$espController = new EspecialidadController();
$res = $espController->mostrarTodos();

?>


<h2>Nuevo Doctor</h2>

<form action="<?=base_url?>doctor/save" method="POST" id="formAnadirDoc">

    <p>Nombre</p>
    <input type="text" name="nomDoc" id="">
    <?php if(!empty($_SESSION['errorDoc'][0])){echo $_SESSION['errorDoc'][0];} ?>
    <p>Apellidos</p>
    <input type="text" name="apDoc" id="">
    <?php if(!empty($_SESSION['errorDoc'][1])){echo $_SESSION['errorDoc'][1];} ?>
    <p>Telefono</p>
    <input type="phone" name="tlfDoc" id="">
    <?php if(!empty($_SESSION['errorDoc'][2])){echo $_SESSION['errorDoc'][2];} ?>
    <p>Especialidad</p>
    <select name="espDoc">
        <?php 

            foreach($res as $fila){
                echo("<option value=".$fila['nombre'].">".$fila['nombre']."</option>");
            }
        ?>
    </select>
    <br><br>
    <input type="submit" value="Añadir" name="anadirDoc">


</form>
