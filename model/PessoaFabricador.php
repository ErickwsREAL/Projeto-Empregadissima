<?php 
	
	include_once ("Pessoa.php");

	abstract class PessoaFabricador {

		abstract protected function criarPessoa();

	}


	class ContratanteFabricador extends PessoaFabricador{

		public function criarPessoa(){
			
			return new Contratante();
		}

	}


	class PrestadorFabricador extends PessoaFabricador{

		public function criarPessoa(){
			
			return new Prestador();
			
		}

	}

?>