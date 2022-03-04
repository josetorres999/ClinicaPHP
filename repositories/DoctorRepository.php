<?php
namespace repositories;

use config\Database;
use DateTime;
use models\Doctor;
use PDOStatement;
use PDO;
use PDOException;
require_once("./repositories/CitaRepository.php");

class DoctorRepository{
        public function __construct(){

        }


        public static function getAll(){
            $db = new Database;
            $query = "SELECT * FROM doctores WHERE activo='Activo'";
            $db->consulta($query);
            $res = $db->extraerRegistro();

            return $res;
        }

        public function insertar($nombre,$apellidos,$tlf,$esp){
            $db = new Database();
            $query = $db->conexion->prepare("INSERT INTO doctores VALUES(null,:nombre,:apellidos,:telefono,:especialidad,'Activo')");
            $query->bindParam(':nombre',$nombre);
            $query->bindParam(':apellidos',$apellidos);
            $query->bindParam(':telefono',$tlf);
            $query->bindParam(':especialidad',$esp);

            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function getById($id){
            try{
                $db = new Database();
                $query = $db->conexion->prepare("SELECT * FROM doctores WHERE id=:id");
                $query->bindParam(':id',$id);
                $query->execute();
                $resultado = $query->fetchAll(PDO::FETCH_CLASS, Doctor::class);
                return $resultado;
            }catch(PDOException $pdo){
                echo("Hubo en error al recuperar la informacion: ".$pdo->getMessage());
            }
        }

        public function getNombrebyId($id){
            try{   
                $db = new Database();
                $query = $db->conexion->prepare("SELECT nombre FROM doctores WHERE id=:id");
                $query->bindParam(":id",$id);
                $query->execute();
                $nombre = $query->fetchAll(PDO::FETCH_ASSOC);
                return $nombre[0];
            }catch(PDOException $pdo){

            }
        }

        public function delete($id){
            $db = new Database();
            $citaRepository = new CitaRepository();
            $citas = $citaRepository->getAllIdDoc($id);
            $fechaHoy = new DateTime();
            foreach($citas as $cita){
                $fecha = new DateTime($cita['fecha']);
                $dif = $fechaHoy->diff($fecha);
                if($dif->invert==0){
                    $query2 = $db->conexion->prepare("DELETE FROM citas WHERE id=:id");
                    $query2->bindParam(':id',$cita['id']);
                    $query2->execute();
                }
                
            }

            $query = $db->conexion->prepare("UPDATE doctores SET activo = 'Inactivo' WHERE id=:id");
            $query->bindParam(':id',$id);
            
            
            $query->execute();
        }

        public function editar($id,$nombre,$apellidos,$tlf,$esp){
            $db = new Database();
            $query = $db->conexion->prepare("UPDATE doctores SET nombre=:nombre, apellidos=:apellidos, telefono=:telefono, especialidad=:especialidad WHERE id=:id");
            $query->bindParam(':nombre',$nombre);
            $query->bindParam(':apellidos',$apellidos);
            $query->bindParam(':telefono',$tlf);
            $query->bindParam(':especialidad',$esp);
            $query->bindParam(':id',$id);

            $query->execute();
        }

        

    }

?>