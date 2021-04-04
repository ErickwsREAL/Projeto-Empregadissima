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

				$enderecoDAO->inserirEndereco($endereco); 
				
				echo '<script>alert("Cadastro do endereço feito com sucesso!")</script>';
				echo '<script>location.href="../views/perfilcontratante.php"</script>';

				break;

			case 'Excluir':
				
				$endereco->setID($_GET['id_end']);

				$enderecoDAO->excluirEndereco($endereco);

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


				$enderecoDAO->atualizarEndereco($endereco);

				echo '<script>alert("Endereço Atualizado!")</script>';
				echo '<script>location.href="../views/perfilcontratante.php"</script>';

				break;			
		}
	}
?>