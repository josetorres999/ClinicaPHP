<?php
namespace repositories;

use config\Database;
use models\Usuario;
use PDOStatement;
use PDO;
use PDOException;

class UsuarioRepository{
        public function __construct(){

        }


        public static function getAll(){
            $db = new Database;
            $query = "SELECT * FROM pacientes";
            $db->consulta($query);
            $res = $db->extraerRegistro();

            return $res;
        }

        public function insertar($nombre,$apellidos,$email,$contrasena){
            $db = new Database();
            $query = $db->conexion->prepare("INSERT INTO pacientes VALUES(null,:nombre,:apellidos,:email,:pass,'Usuario')");
            $query->bindParam(':nombre',$nombre);
            $query->bindParam(':apellidos',$apellidos);
            $query->bindParam(':email',$email);
            $query->bindParam(':pass',$contrasena);

            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function getByLogin($email,$contrasena){
            try{
                $db = new Database();
                $query = $db->conexion->prepare("SELECT * FROM pacientes WHERE correo=:email and password=:contrasena");
                $query->bindParam(':email',$email);
                $query->bindParam(':contrasena',$contrasena);
                $query->execute();
                $resultado = $query->fetchAll(PDO::FETCH_CLASS, Usuario::class);
                return $resultado;
            }catch(PDOException $pdo){
                echo("Hubo en error con el login: ".$pdo->getMessage());
            }
        }

        public function getNombrebyId($id){
            try{   
                $db = new Database();
                $query = $db->conexion->prepare("SELECT nombre FROM pacientes WHERE id=:id");
                $query->bindParam(":id",$id);
                $query->execute();
                $nombre = $query->fetchAll(PDO::FETCH_ASSOC);
                return $nombre[0];
            }catch(PDOException $pdo){

            }
        }

        public function delete($id){
            $db = new Database();

            $query = $db->conexion->prepare("DELETE FROM pacientes WHERE id=:id");
            $query->bindParam(':id',$id);
            $query2 = $db->conexion->prepare("DELETE FROM citas WHERE paciente_id=:id");
            $query2->bindParam(':id',$id);
            $query2->execute();
            $query->execute();
        }
    }

?>