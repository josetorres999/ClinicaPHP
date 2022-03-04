<?php
    namespace repositories;


    use config\Database;
    use models\Especialidad;
    use PDO;

    require_once("./models/Especialidad.php");

    class EspecialidadRepository{
        public static function getAll(){
            $db = new Database;
            $query = "SELECT * FROM especialidades";
            $db->consulta($query);
            $res = $db->extraerRegistro();

            return $res;
        }

        public function insertar($nombre){
            $db = new Database();
                $query = $db->conexion->prepare("INSERT INTO especialidades VALUES (null, :nombre)");
                $query->bindParam(":nombre",$nombre);
                $query->execute();
            

        }

        public function getByNombre($nombre){
            $db = new Database();
            $query = $db->conexion->prepare("SELECT * FROM especialidades WHERE nombre=:nombre");
            $query->bindParam(":nombre",$nombre);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_CLASS, Especialidad::class);
            return $resultado;
        }
    }


?>