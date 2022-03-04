<?php

require_once('./models/usuario.php');
require_once('./repositories/UsuarioRepository.php');
use config\Database;
use models\Usuario;
use repositories\UsuarioRepository;

class UsuarioController{


    public function registro(){
        require_once("views/usuario/registro.php");
    }

    public function login(){
        require_once("views/usuario/login.php");
    }

    public function save(){
            $nombre = $_POST['nomReg'];
            $apellidos = $_POST['apReg'];
            $email = $_POST['emReg'];
            $contrasena = $_POST['pasReg'];
            $registrar = true;


            $_SESSION['errorReg']=['','','',''];

            if(empty($nombre)){
                $registrar = false;
                $_SESSION['errorReg'][0] = "El nombre es obligatorio";
            }

            if(empty($apellidos)){
                $registrar = false;
                $_SESSION['errorReg'][1] = "Los apellidos son obligatorios";
            }

            if(empty($email)){
                $registrar = false;
                $_SESSION['errorReg'][2] = "El correo es obligatorio";
            }

            if(empty($contrasena)){
                $registrar = false;
                $_SESSION['errorReg'][3] = "La contraseña es obligatoria";
            }

            if($registrar == false){
                $url = base_url.'usuario/registro';
                header("Location: ".$url);
            }else{
                $usuarioRepository = new UsuarioRepository();
                $usuarioRepository->insertar($nombre,$apellidos,$email,$contrasena);
            }
    }

    public function iniciarSesion(){
        if(isset($_POST['subLog'])){
            $email = $_POST['emLog'];
            $contrasena = $_POST['passLog'];

            $usuarioRepository = new UsuarioRepository();
            $usuario = $usuarioRepository->getByLogin($email,$contrasena);
            
            if($usuario){
                //Inicia sesion
                $_SESSION['usuario'] = $usuario[0];

                if($_SESSION['usuario']->getTipo() == "Usuario"){
                    $url = base_url.'cita/mostrarCitas';
                    header("Location: ".$url);
                }else{
                    $url = base_url.'cita/mostrar';
                    header("Location: ".$url);
                }
                
            }else{
                //No inicia sesion
                echo("No coincide con ningun usuario");
            }
            
        }
    }

    public function mostrarTodos(){
        $usuarioRepository = new UsuarioRepository();
        $todos = $usuarioRepository->getAll();
        return $todos;
    }

    public function mostrar(){
        require_once("./views/usuario/todos_usuarios.php");
    }

    public function getById($id){
        $usuarioRepository = new UsuarioRepository();
        $nombre = $usuarioRepository->getNombreById($id);
        return $nombre['nombre'];
    }

    public function logout(){
        unset($_SESSION['usuario']);
        $url = base_url;
        header("Location: ".$url);
    }

    public function borrar(){
        $doctorRepository = new UsuarioRepository();

            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $doctorRepository->delete($id);

                header("Location: ".base_url."usuario/mostrar");
            }else{
                echo("Error");
            }
    }

    
}