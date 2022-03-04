<?php

use repositories\DoctorRepository;

    require_once('./models/Doctor.php');
    require_once('./repositories/DoctorRepository.php');

    class DoctorController{

        public function anadir(){
            $_SESSION['errorDoc']=['','','',''];
            require_once('./views/doctor/anadir.php');
        }

        public function save(){
            $nombre = $_POST['nomDoc'];
            $apellidos = $_POST['apDoc'];
            $telefono = $_POST['tlfDoc'];
            $especialidad = $_POST['espDoc'];
            $registrar = true;


            $_SESSION['errorDoc']=['','','',''];

            if(empty($nombre)){
                $registrar = false;
                $_SESSION['errorDoc'][0] = "El nombre es obligatorio";
            }

            if(empty($apellidos)){
                $registrar = false;
                $_SESSION['errorDoc'][1] = "Los apellidos son obligatorios";
            }

            if(empty($telefono)){
                $registrar = false;
                $_SESSION['errorDoc'][2] = "El telefono es obligatorio";
            }

            if(empty($especialidad)){
                $registrar = false;
                $_SESSION['errorDoc'][3] = "La especialidad es obligatoria";
            }

            if($registrar == false){
                $url = base_url.'doctor/anadir';
                header("Location: ".$url);
            }else{
                $docRepository = new DoctorRepository();
                $docRepository->insertar($nombre,$apellidos,$telefono,$especialidad);
                $url = base_url.'doctor/mostrar';
                header("Location: ".$url);
            }
    }

    public function mostrar(){
        require_once("views/doctor/todos_doctores.php");
    }

    public function mostrarTodos(){
        $docRepository = new DoctorRepository();
        $todos = $docRepository->getAll();
        return $todos;
    }

    public function getById($id){
        $docRepository = new DoctorRepository();
        $nombre = $docRepository->getNombreById($id);
        return $nombre['nombre'];
    }

    public function borrar(){
        $doctorRepository = new DoctorRepository();

            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $doctorRepository->delete($id);

                header("Location: ".base_url."doctor/mostrar");
            }else{
                echo("Error");
            }
    }

    public function getDoctor($id){
        $docRepository = new DoctorRepository();
        $res = $docRepository->getById($id);
        return $res[0];
    }

    public function editar(){
        require_once("./views/doctor/editar.php");
    }

    public function editarDoc(){
        $nombre = $_POST['nomDoc'];
            $apellidos = $_POST['apDoc'];
            $telefono = $_POST['tlfDoc'];
            $especialidad = $_POST['espDoc'];
            $registrar = true;


            $_SESSION['errorDoc']=['','','',''];

            if(empty($nombre)){
                $registrar = false;
                $_SESSION['errorDoc'][0] = "El nombre es obligatorio";
            }

            if(empty($apellidos)){
                $registrar = false;
                $_SESSION['errorDoc'][1] = "Los apellidos son obligatorios";
            }

            if(empty($telefono)){
                $registrar = false;
                $_SESSION['errorDoc'][2] = "El telefono es obligatorio";
            }

            if(empty($especialidad)){
                $registrar = false;
                $_SESSION['errorDoc'][3] = "La especialidad es obligatoria";
            }

            if($registrar == false){
                $url = base_url.'doctor/anadir';
                header("Location: ".$url);
            }else{
                $docRepository = new DoctorRepository();
                $docRepository->editar($_GET['id'],$nombre,$apellidos,$telefono,$especialidad);
                $url = base_url.'doctor/mostrar';
                header("Location: ".$url);
            }
    }
}

?>