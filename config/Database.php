<?php
namespace config;

use PDO;

class Database {
    public PDO $conexion;
    private $resultado;

    public function __construct(
        private string $servidor = SERVIDOR,
        private string $usuario = USUARIO,
        private string $pass = PASS,
        private string $base_datos = BASE_DATOS
    ){
        $this->conexion = $this->conectar();
    }

    public function conectar(){
        try{
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::MYSQL_ATTR_FOUND_ROWS => true);

            $conexion = new PDO("mysql:dbname=miclinica;host=localhost", $this->usuario, $this->pass,$opciones);
            return $conexion;
        }catch(Exception $e){
            echo("Ha ocurrido un error y no puede conectarse a la base de datos");
            exit;
        }
    }

    public function consulta(string $consulta): void{
        $this->resultado = $this->conexion->query($consulta)->fetchAll();
    }

    public function extraerRegistro():mixed{
        return $this->resultado;
    }
    
}