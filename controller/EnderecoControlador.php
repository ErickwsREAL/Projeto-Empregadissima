<?php 
	
	include_once ("../DAO/EnderecoDAO.php");
	include_once ("../model/Endereco.php");

	$endereco = new Endereco();
	$enderecoDAO = new EnderecoDAO();

	function buscarTEnd($id_pessoa){
		
		$enderecoDAO = new EnderecoDAO();
		$rows = $enderecoDAO->buscarEnderecos($id_pessoa);

		return $rows;
	}
	
	if (isset($_POST['id_endBuscar'])){
	 	
		$endereco->setID($_POST['id_endBuscar']);

		$endereco = $enderecoDAO->buscarEndereco($endereco);

		//var_dump($endereco);
		
		$bairro = $endereco->getBairro();
		$rua = $endereco->getRua();
		$numero = $endereco->getNumero();
		$cep = $endereco->getCEP();
		$complemento = $endereco->getComplemento();
		$id = $endereco->getID(); 

		echo $bairro.",".$rua.",".$numero.",".$cep.",".$complemento.",".$id;
	}	
		
	

	if (isset($_GET['metodo'])) {    
		switch($_GET['metodo']){

			case 'Inserir':
						
				$endereco->setIDContratante($_POST['id_c']);
				$endereco->setRua($_POST['rua']);
				$endereco->setBairro($_POST['bairro']);
				$endereco->setCEP($_POST['cep']);
				$endereco->setNumero($_POST['numero']);
				$endereco->setComplemento($_POST['complemento']);

				$checkBD = $enderecoDAO->inserirEndereco($endereco); 
				
				if ($checkBD == "c" or $checkBD == "d") {
					echo '<script>alert("Rua ou Bairro apresentam números! Por favor, use apenas letras.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}


				if ($checkBD == "a") {
					echo '<script>alert("Já existe um cadastro deste endereço em seu nome.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}
				if ($checkBD == "b") {
					echo '<script>alert("Cadastro não foi inserido com sucesso. Tente novamente.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}

				echo '<script>alert("Cadastro do endereço feito com sucesso!")</script>';
				echo '<script>location.href="../views/perfilcontratante.php"</script>';
				
				break;

			case 'Excluir':
				
				$endereco->setID($_POST['enderecoSelecionado']);
				$endereco->setIDContratante($_POST['id_contratante']);

				$checkBD = $enderecoDAO->excluirEndereco($endereco);

				if ($checkBD == "a") {
					echo '<script>alert("Não foi possível excluir, pois existe um serviço não finalizado neste endereço.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}

				if ($checkBD == "b") {
					echo '<script>alert("Não foi possível excluir. Tente novamente.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}

				echo '<script>alert("Endereço Excluido!")</script>';
				echo '<script>location.href="../views/perfilcontratante.php"</script>';

				break;	

			case 'Atualizar':
				
				$endereco->setID($_POST['id_end']);
				$endereco->setRua($_POST['rua']);
				$endereco->setBairro($_POST['bairro']);
				$endereco->setCEP($_POST['cep']);
				$endereco->setNumero($_POST['numero']);
				$endereco->setComplemento($_POST['complemento']);
					$endereco->setIDContratante($_POST['id_contratante']);

				$checkBD = $enderecoDAO->atualizarEndereco($endereco);
				
				if ($checkBD == "e" or $checkBD == "d") {
					echo '<script>alert("Rua ou Bairro apresentam números! Por favor, use apenas letras.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}

				if ($checkBD == "a") {
					echo '<script>alert("Já existe um cadastro deste endereço em seu nome.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}
				if ($checkBD == "b") {
					echo '<script>alert("Não foi possível atualizar o endereço. Tente novamente.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}
				
				if ($checkBD == "c") {
					echo '<script>alert("Não foi possível atualizar o endereço. Existe um serviço pendente neste endereço.")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';

					break;
				}

				echo '<script>alert("Endereço Atualizado!")</script>';
				echo '<script>location.href="../views/perfilcontratante.php"</script>';

				break;			
		}
	}
?>