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

		public function excluirEndereco(Endereco $endereco){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idEndereco = $endereco->getID();

			$sql = "DELETE FROM endereco WHERE id_endereco = '$idEndereco'";

			$conn->query($sql);
			$conn->close();

		}

		public function buscarEndereco(Endereco $endereco){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idEndereco = $endereco->getID();

			$sql = "SELECT * FROM endereco WHERE id_endereco = '$idEndereco'";

			$resultado = $conn->query($sql);
			
			$row = $resultado->fetch_assoc();

			$endereco->setRua($row['rua']);
			$endereco->setBairro($row['bairro']);
			$endereco->setCEP($row['cep']);
			$endereco->setNumero($row['numero']);
			$endereco->setComplemento($row['complemento']);

			$conn->close();

			return $endereco;

		}

		public function atualizarEndereco(Endereco $endereco){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idEndereco = $endereco->getID();
			$rua = $endereco->getRua();
			$bairro = $endereco->getBairro();
			$cep = $endereco->getCEP();
			$numero = $endereco->getNumero();
			$complemento = $endereco->getComplemento(); 
		
			$sql = "UPDATE endereco SET rua = '$rua', bairro = '$bairro', numero = '$numero', cep = '$cep', complemento = '$complemento' WHERE id_endereco = '$idEndereco'";

			$conn->query($sql);
			$conn->close();
		}
	}




?>