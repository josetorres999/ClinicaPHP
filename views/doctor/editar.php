<?php

require_once("./controllers/EspecialidadController.php");
require_once("./controllers/DoctorController.php");


$espController = new EspecialidadController();
$res = $espController->mostrarTodos();

$docController = new DoctorController();
$doc = $docController->getDoctor($_GET['id']);


?>


<h2>Nuevo Doctor</h2>

<form action="<?=base_url?>doctor/editarDoc&id=<?=$doc->getId()?>" method="POST" id="formAnadirDoc">

    <p>Nombre</p>
    <input type="text" name="nomDoc" id="" value=<?=$doc->getNombre()?>>
    <?php if(!empty($_SESSION['errorDoc'][0])){echo $_SESSION['errorDoc'][0];} ?>
    <p>Apellidos</p>
    <input type="text" name="apDoc" id="" value=<?=$doc->getApellidos()?>>
    <?php if(!empty($_SESSION['errorDoc'][1])){echo $_SESSION['errorDoc'][1];} ?>
    <p>Telefono</p>
    <input type="phone" name="tlfDoc" id="" value=<?=$doc->getTelefono()?>>
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
