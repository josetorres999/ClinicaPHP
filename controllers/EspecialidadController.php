<?php

use repositories\EspecialidadRepository;
require_once("./repositories/EspecialidadRepository.php");


class EspecialidadController{
    function __construct(){

    }

    public function mostrarForm(){
        require_once("./views/especialidad/form_especialidad.php");
    }

    public function anadir(){
        $_SESSION['errEsp'] = "";
        $espRepository = new EspecialidadRepository();
        if(isset($_POST['nombreEsp'])){
            $espRepository->insertar($_POST['nombreEsp']);
                $url = base_url."especialidad/mostrarForm";
                header("Location: ".$url);
        }else{
            $_SESSION['errEsp'] = "Debes introducir un nombre";
        }
        
    }

    public function mostrarTodos(){
        $espRepository = new EspecialidadRepository();
        $todos = $espRepository->getAll();
        return $todos;
    }
}


?>