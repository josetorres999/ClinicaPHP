<?php 
    require_once('./controllers/DoctorController.php');
    require_once('./controllers/UsuarioController.php');
    
    $pacienteController = new UsuarioController();
    $docController = new DoctorController();
    $res = $docController->mostrarTodos();
    $res2 = $pacienteController->mostrarTodos();

    $fechaHoy = new DateTime();
    $fechaString = $fechaHoy->format('Y-m-d');

?>

<form action="<?=base_url?>cita/anadir_admin" method="POST">

    <p><h1>Crear cita</h1></p>

    <p><h4>Paciente</h4></p>
    <select name="paciente">
        <?php 
            foreach($res2 as $fila){
                echo("<option value=".$fila['id'].">".$fila['nombre']."</option>");
            }
        ?>
    </select>

    <p><h4>Doctor: </h4> 
    <select name="doctor" id="doctor">
        <?php 
            foreach($res as $fila){
                echo("<option value=".$fila['id'].">".$fila['nombre']."</option>");
            }
        ?>
    </select>    </p>
    <p><h4>Fecha</h4> <input type="date" name="fecha" id="fecha" min="<?=$fechaString?>"></p>
    <p><h4>Hora</h4> <input type="time" name="hora" id="hora"></p>
    <p><input type="submit" value="Enviar"> <input type="reset" value="Limpiar"></p>
</form>