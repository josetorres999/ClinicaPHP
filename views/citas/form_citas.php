<?php 
    require_once('./controllers/DoctorController.php');
    
    
    $docController = new DoctorController();
    $res = $docController->mostrarTodos();

    $fechaHoy = new DateTime();
    $fechaString = $fechaHoy->format('Y-m-d');

?>

<form action="<?=base_url?>cita/anadir" method="POST">

    <p><h1>Crear cita</h1></p>

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