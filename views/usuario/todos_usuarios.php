<br><br><br><br><br><br><br>

<?php
    require_once('./controllers/UsuarioController.php');

    $usuarioController = new UsuarioController();

    $res = $usuarioController->mostrarTodos();
?>
    <table>
        <tr>
            <td>Nombre</td><td>Apellidos</td><td>Correo</td><td>Tipo</td><td>Borrar</td>
        </tr>
<?php

    foreach($res as $fila){
        //var_dump($fila);echo("<br>");
        echo("<tr>
                <td>".$fila['nombre']."</td>
                <td>".$fila['apellidos']."</td>
                <td>".$fila['correo']."</td>
                <td>".$fila['tipo']."</td>");

            if($_SESSION['usuario']->getTipo()=="Admin"){
                echo("<td><a href=".base_url."usuario/borrar&id=".$fila['id'].">Borrar</a></td>
                </tr>");
            }    
                
    }
    ?>
    
    </table>
