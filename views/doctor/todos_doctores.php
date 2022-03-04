<br><br><br><br><br><br><br>

<?php
    require_once('./controllers/DoctorController.php');
    require_once('./controllers/UsuarioController.php');

    $docController = new DoctorController();

    $res = $docController->mostrarTodos();
?>
    <table>
        <tr>
            <td>Nombre</td><td>Apellidos</td><td>Telefono</td><td>Especialidad</td>
        </tr>
<?php

    foreach($res as $fila){
        //var_dump($fila);echo("<br>");
        echo("<tr>
                <td>".$fila['nombre']."</td>
                <td>".$fila['apellidos']."</td>
                <td>".$fila['telefono']."</td>
                <td>".$fila['especialidad']."</td>");

            if($_SESSION['usuario']->getTipo()=="Admin"){
                echo("<td><a href=".base_url."doctor/borrar&id=".$fila['id'].">Borrar</a></td>
                </tr>");
                echo("<td><a href=".base_url."doctor/editar&id=".$fila['id'].">Editar</a></td>
                </tr>");
            }    
                
    }
    ?>
    
    </table>
