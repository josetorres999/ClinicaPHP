<?php 
    require_once("views/layout/header.php");
?>
<div id="padre">
<?php

    use controllers\ErrorController;
    use config\Database;
    
    
    require_once("config/constantes.php");
    require_once("config/Database.php");
    require_once("controllers/ErrorController.php");
    require_once("controllers/UsuarioController.php");
    require_once('controllers/DoctorController.php');
    require_once('controllers/CitaController.php');
    require_once('controllers/EspecialidadController.php');




    session_start();


    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']->getTipo()=='Usuario'){
            require_once("views/layout/sidebar_usuario.php");
        }else{
            require_once("views/layout/sidebar_admin.php");
        }
    }else{
        require_once('views/layout/sidebar_base.php');
    }
    
    
?>    
<div>
<?php
    function show_error(){
        $error = new ErrorController();
        $error->index();
    }

    if(isset($_GET['controller'])){
        $nombre_controlador = $_GET['controller'].'Controller';
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $nombre_controlador = controller_default;
    }else{
        show_error();
        exit();
    }

    //Si todo va bien creamos una instancia del controlador
    if(class_exists($nombre_controlador)){
        $controlador = new $nombre_controlador();

        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            $controlador->$action();
        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
            $action_default = action_default;
            $controlador->$action_default();
        }else{
            show_error();
        }
    }else{
        show_error();
    }
    try{
        $db = new Database();
    }catch(Exception $e){
        echo "Error con la base de datos ".$e->getMessage();
    }
?>
    </div>
</div>
<?php
    require_once('./views/layout/footer.php');
?>
