<?php
	
	class Pessoa {
		//gerado pelo BD ou fora do cadastro
		protected $StatusCadastro;
		protected $id;
		//gerado na tela de cadastro
		protected $Nome;
		protected $CPF;
		protected $Telefone;
		protected $Email;
		protected $DataNascimento;
		protected $Comprovante;
		protected $TipoPessoa;
		protected $Sexo;
		protected $Senha;
		protected $Cidade;
		//gerado após acesso ao perfil, pelo usuário
		protected $Descricao;
		protected $Foto;
	
		 function getNome() {
	        return $this->Nome;
	    }

	    function getCPF() {
	        return $this->CPF;
	    }

	    function getTelefone() {
	        return $this->Telefone;
	    }

	    function getEmail() {
	        return $this->Email;
	    }

	    function getDataNascimento() {
	        return $this->DataNascimento;
	    }

	    function getComprovante() {
	        return $this->Comprovante;
	    }

	    function getTipoPessoa() {
	        return $this->TipoPessoa;
	    }

	    function getSexo() {
	        return $this->Sexo;
	    }

	    function getSenha() {
	        return $this->Senha;
	    }

	    function getCidade() {
	        return $this->Cidade;
	    }

	      function getStatusCadastro() {
	        return $this->StatusCadastro;
	    }

	    function getID() {
	        return $this->id;
	    }

	    function getDescricao() {
	        return $this->Descricao;
	    }

	    function getFoto() {
	        return $this->Foto;
	    }
	    
	    //-------------------------------------------------------------------------------------------------------------------------------------

	    function setNome($nome) {
	        $this->Nome = $nome;
	    }

	    function setCPF($cpf) {
	        $this->CPF = $cpf;
	    }

	     function setTelefone($telefone) {
	        $this->Telefone = $telefone;
	    }

	    function setEmail($email) {
	        $this->Email = $email;
	    }

	     function setDataNascimento($datanascimento) {
	        $this->DataNascimento = $datanascimento;
	    }

	    function setComprovante($comprovante) {
	        $this->Comprovante = $comprovante;
	    }

	     function setTipoPessoa($tipopessoa) {
	        $this->TipoPessoa = $tipopessoa;
	    }

	    function setSexo($sexo) {
	        $this->Sexo = $sexo;
	    }

	     function setSenha($senha) {
	        $this->Senha = $senha;
	    }

	    function setID($ID) {
	        $this->id = $ID;
	    }

	     function setStatusCadastro($statuscadastro) {
	        $this->StatusCadastro = $statuscadastro;
	    }

	    function setFoto($foto) {
	        $this->Foto = $foto;
	    }

	     function setDescricao($descricao) {
	        $this->Descricao = $descricao;
	    }

	    function setCidade($cidade) {
	        $this->Cidade = $cidade;
	    }
	}

	//-------------------------------------------------------------------------------------------------------------------------------------------

	class Contratante extends Pessoa {

	   
	}		
	//---------------------------------------------------------------------------------------------------------------
	
	class Prestador extends Pessoa {

		

	}



?>