<?php 

	include_once ("../model/Endereco.php");

	class EnderecoDAO {

		public function inserirEndereco(Endereco $endereco){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idContratante = $endereco->getIDContratante();
			$rua = $endereco->getRua();
			$bairro = $endereco->getBairro();
			$cep = $endereco->getCEP();
			$numero = $endereco->getNumero();
			$complemento = $endereco->getComplemento();

			$sql = "INSERT INTO endereco(bairro, rua, numero, complemento, cep, id_pessoa) VALUES ('$bairro', '$rua', '$numero', '$complemento', '$cep', '$idContratante')";

			$conn->query($sql);
			$conn->close();	
		}

	}




?>