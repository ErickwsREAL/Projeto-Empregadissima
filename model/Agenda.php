<?php

    class Agenda {
        private $id;
        private $id_prestador;
        private $dia_disponivel;

        /* Getters */

        function getId() {
            return $this->id;
        }

        function getIdPrestador() {
            return $this->id_prestador;
        }

        function getDiaDisponivel() {
            return $this->dia_disponivel;
        }

        /* Setters */

        function setId($ID) {
            $this->id = $ID;
        }

        function setIdPrestador($prestador_id) {
            $this->id_prestador = $prestador_id;
        }

        function setDiaDisponivel($data) {
            $this->dia_disponivel = $data;
        }
    }
?>