<?php 

	class Endereco {
		
		private $id;
		private $Rua;		
		private $idContratante;
		private $Bairro;
		private $Numero;
		private $CEP;
		private $Complemento;

		function getID() {
	        return $this->id;
	    }

	    function getRua() {
	        return $this->Rua;
	    }

	    function getIDContratante() {
	        return $this->idContratante;
	    }

	    function getBairro() {
	        return $this->Bairro;
	    }

	    function getNumero() {
	        return $this->Numero;
	    }

	    function getCEP() {
	        return $this->CEP;
	    }

	    function getComplemento() {
	        return $this->Complemento;
	    }

	    //------------------------------------------------------------------------------------------------------------------------------------------

	    function setID($ID) {
	        $this->id = $ID;
	    }

	    function setRua($rua) {
	        $this->Rua = $rua;
	    }

	    function setIDContratante($IDContratante) {
	        $this->idContratante = $IDContratante;
	    }

	    function setBairro($bairro) {
	        $this->Bairro = $bairro;
	    }

	    function setNumero($numero) {
	        $this->Numero = $numero;
	    }

	    function setCEP($cep) {
	        $this->CEP = $cep;
	    }

	    function setComplemento($complemento) {
	        $this->Complemento = $complemento;
	    }


	}


?>