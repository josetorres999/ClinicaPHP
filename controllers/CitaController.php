<?php

    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';


    use repositories\CitaRepository;
    require_once("./repositories/CitaRepository.php");

    class CitaController{
        public function nueva(){
            require_once('./views/citas/form_citas.php');
        }

        public function nuevaAdmin(){
            require_once('./views/citas/anadir_citas_admin.php');
        }

        public function anadir(){
            $idPac = $_SESSION['usuario']->getId();
            $idDoc = $_POST['doctor'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $registrar = true;


            $_SESSION['errorCit']=['',''];

            if(empty($idDoc)){
                $registrar = false;
            }

            if(empty($fecha)){
                $registrar = false;
                $_SESSION['errorCit'][0] = "La fecha es obligatoria";
            }

            if(empty($hora)){
                $registrar = false;
                $_SESSION['errorCit'][1] = "La hora es obligatoria";
            }

            if($registrar == false){
                $url = base_url.'cita/nueva';
                header("Location: ".$url);
            }else{
                $citaRepository = new CitaRepository();
                //$this->enviarCorreo($_SESSION['usuario']->getCorreo());
                $citaRepository->insertar($idPac,$idDoc,$fecha,$hora);
                $url = base_url.'cita/mostrarCitas';
                header("Location: ".$url);
            }
        }

        public function anadir_admin(){
            $idPac = $_POST['paciente'];
            $idDoc = $_POST['doctor'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $registrar = true;

            if(empty($fecha)){
                $registrar = false;
                $_SESSION['errorCit'][0] = "La fecha es obligatoria";
            }

            if(empty($hora)){
                $registrar = false;
                $_SESSION['errorCit'][1] = "La hora es obligatoria";
            }

            if($registrar == false){
                $url = base_url.'cita/nuevaAdmin';
                header("Location: ".$url);
            }else{
                $citaRepository = new CitaRepository();
                $citaRepository->insertar($idPac,$idDoc,$fecha,$hora);
            }
        }

        public function mostrarTodas(){
            $citaRepository = new CitaRepository();
            $todos = $citaRepository->getAll();
            return $todos;
        }

        public function mostrar(){
            require_once('./views/citas/todas_citas.php');
        }

        public function borrar(){
            $citaRepository = new CitaRepository();

            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $citaRepository->delete($id);
                
                if($_SESSION['usuario'] == "Admin"){
                    header("Location: ".base_url."cita/mostrar");
                }else{
                    header("Location: ".base_url."cita/mostrarCitas");
                }
                
            }else{
                echo("Error");
            }
        }

        public function getAllById(){
            $idPac = $_SESSION['usuario']->getId();

            $citaRepository = new CitaRepository();
            $todos = $citaRepository->getAllById($idPac);

            return $todos;
        }

        public function mostrarCitas(){
            require_once("views/citas/citas_usuario.php");
        }

        public function enviarCorreo($correo){
            $mail = new PHPMailer();
            $mail-> isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.office365.com';                 
            $mail->Port = 587;
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
            $mail->Username   = 'clinicaphp@hotmail.com';                     //SMTP username
            $mail->Password   = 'miclinica1234';                               //SMTP password
            $mail->setFrom('clinicaphp@hotmail.com');
            $mail->addAddress("jatorrespalma@gmail.com");     //Add a recipient
            $mail->Subject = 'Confirmación de su cita con la clínica Steamulation';
            $mail->Body = "Hola";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            if (!$mail->send()){
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                die();
            } else {
                echo 'Se le ha enviado un correo con los datos de la cita.';
            }
        }
    }

?>