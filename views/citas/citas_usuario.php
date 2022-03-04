<br><br><br><br><br><br><br>

<?php
    require_once('./controllers/CitaController.php');
    require_once('./controllers/UsuarioController.php');

    $citaController = new CitaController();
    $usuarioController = new UsuarioController();
    $doctorController = new DoctorController();

    $res = $citaController->getAllById();
    ?>
    <table>
        <tr>
            <td>Paciente</td><td>Doctor</td><td>Fecha</td><td>Hora</td><td>Borrar</td>
        </tr>
    <?php

    foreach($res as $fila){
        //var_dump($fila);echo("<br>");
        echo("<tr>
                <td>".$usuarioController->getById($fila['paciente_id'])."</td>
                <td>".$doctorController->getById($fila['doctor_id'])."</td>
                <td>".$fila['fecha']."</td>
                <td>".$fila['hora']."</td>
                <td><a href=".base_url."cita/borrar&id=".$fila['id'].">Borrar</a></td>
            </tr>");
    }

    
    

    ?>
    
    </table>

    <?php

    

?>
