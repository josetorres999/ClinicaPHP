<?php
namespace models;

class Doctor {

    
    private string $id;
    private string $nombre;
    private string $apellidos;
    private string $telefono;
    private string $especialidad;
    private string $activo;

    function __construct()
    {

    }

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }

    public function getApellidos(): string{
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos){
        $this->apellidos = $apellidos;
    }
   
    public function getTelefono(): string{
        return $this->telefono;
    }

    public function setTelefono(string $telefono){
        $this->telefono = $telefono;
    }
       
    public function getEspecialidad(): string{
        return $this->especialidad;
    }


    /**
     * Get the value of activo
     */ 
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set the value of activo
     *
     * @return self
     */ 
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }
}