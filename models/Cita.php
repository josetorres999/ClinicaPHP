<?php

    class Cita{
        function __construct(
            private string $id,
            private string $pacienteId,
            private string $doctorId,
            private string $fecha,
            private string $hora

        )
        {
            
        }

            /**
             * Get the value of id
             */ 
            public function getId()
            {
                        return $this->id;
            }

            /**
             * Set the value of id
             *
             * @return self
             */ 
            public function setId($id)
            {
                        $this->id = $id;

                        return $this;
            }

            /**
             * Get the value of pacienteId
             */ 
            public function getPacienteId()
            {
                        return $this->pacienteId;
            }

            /**
             * Set the value of pacienteId
             *
             * @return self
             */ 
            public function setPacienteId($pacienteId)
            {
                        $this->pacienteId = $pacienteId;

                        return $this;
            }

            /**
             * Get the value of doctorId
             */ 
            public function getDoctorId()
            {
                        return $this->doctorId;
            }

            /**
             * Set the value of doctorId
             *
             * @return self
             */ 
            public function setDoctorId($doctorId)
            {
                        $this->doctorId = $doctorId;

                        return $this;
            }

            /**
             * Get the value of fecha
             */ 
            public function getFecha()
            {
                        return $this->fecha;
            }

            /**
             * Set the value of fecha
             *
             * @return self
             */ 
            public function setFecha($fecha)
            {
                        $this->fecha = $fecha;

                        return $this;
            }

            /**
             * Get the value of hora
             */ 
            public function getHora()
            {
                        return $this->hora;
            }

            /**
             * Set the value of hora
             *
             * @return self
             */ 
            public function setHora($hora)
            {
                        $this->hora = $hora;

                        return $this;
            }
    }

?>