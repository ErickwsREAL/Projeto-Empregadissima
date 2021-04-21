<?php 

	include_once ("../model/Endereco.php");

	class EnderecoDAO {

		public function buscarEnderecos($id_contratante){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idContratante = $id_contratante;
			$rows = array();
			
			$sql = "SELECT * FROM endereco WHERE id_pessoa = '$idContratante'";

			$resultado = $conn->query($sql);
            $row_count = mysqli_num_rows($resultado);

            if ($row_count == 0) {
                $conn->close();
                return "false";
            }

			while($row = $resultado->fetch_assoc()){
				$rows[] = $row;
			}	
			$conn->close();
			return $rows;
		}

		public function inserirEndereco(Endereco $endereco){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idContratante = $endereco->getIDContratante();
			$rua = $endereco->getRua();
			$bairro = $endereco->getBairro();
			$cep = $endereco->getCEP();
			$numero = $endereco->getNumero();
			$complemento = $endereco->getComplemento();

			$sql1 = "SELECT id_endereco FROM endereco WHERE id_pessoa = '$idContratante' AND bairro = '$bairro' AND rua = '$rua' AND numero = '$numero'AND complemento = '$complemento' AND cep = '$cep'";			

			$resultado = $conn->query($sql1);
            $row_count = mysqli_num_rows($resultado);

            if ($row_count != 0) {
                $conn->close();
                return "a";
            }


			$sql = "INSERT INTO endereco(bairro, rua, numero, complemento, cep, id_pessoa) VALUES ('$bairro', '$rua', '$numero', '$complemento', '$cep', '$idContratante')";


			$checkB = $conn->query($sql);

            if ($checkB == false) {
                $conn->close();
                  	
                return "b";
            }
			
			$conn->close();	
		}

		public function excluirEndereco(Endereco $endereco){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idEndereco = $endereco->getID();
			$idContratante = $endereco->getIDContratante();

			$sql1 = "SELECT id_servico FROM servico WHERE id_contratante = '$idContratante' AND id_endereco = '$idEndereco' AND status_servico != 5";

			$resultado = $conn->query($sql1);
			
            $row_count = mysqli_num_rows($resultado);

            if ($row_count != 0) {
                $conn->close();
                return "a";
            }

            $sql = "DELETE FROM endereco WHERE id_endereco = '$idEndereco'";

			$checkB = $conn->query($sql);

            if ($checkB == false) {
                $conn->close();
                  	
                return "b";
            }
            
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
			$idContratante = $endereco->getIDContratante();	
			
			$sql2 = "SELECT id_servico FROM servico WHERE id_contratante = '$idContratante' AND id_endereco = '$idEndereco' AND status_servico != 5";

			$resultado2 = $conn->query($sql2);
            $row_count2 = mysqli_num_rows($resultado2);

            if ($row_count2 != 0) {
                $conn->close();
                return "c";
            }

			$sql1 = "SELECT id_endereco FROM endereco WHERE id_pessoa = '$idContratante' AND bairro = '$bairro' AND rua = '$rua' AND numero = '$numero'AND complemento = '$complemento' AND cep = '$cep'";			

			$resultado = $conn->query($sql1);
            $row_count = mysqli_num_rows($resultado);

            if ($row_count != 0) {
                $conn->close();
                return "a";
            }
		
			$sql = "UPDATE endereco SET rua = '$rua', bairro = '$bairro', numero = '$numero', cep = '$cep', complemento = '$complemento' WHERE id_endereco = '$idEndereco'";

			$checkB = $conn->query($sql);

            if ($checkB == false) {
                $conn->close();
                  	
                return "b";
            }
		
			$conn->close();
		}
	}



?>