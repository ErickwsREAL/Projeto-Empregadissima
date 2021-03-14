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

	function buscarEndereco($id_endereco){

		$enderecoDAO = new EnderecoDAO();	
		$endereco = new Endereco();
		
		$endereco->setID($id_endereco);
		$endereco = $enderecoDAO->buscarEndereco($endereco);

		return $endereco;
	}

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

		case 'Buscar':
			
			$endereco->setID($_GET['id_end']);

			$endereco = $enderecoDAO->buscarEndereco($endereco);

			echo '<script>location.href="../views/perfilcontratante.php?bairro='.$endereco->getBairro().'&rua='.$endereco->getRua().'&numero='.$endereco->getNumero().'&complemento='.$endereco->getComplemento().'&cep='.$endereco->getCEP().'&id_end='.$endereco->getID().'"</script>';

			break;	
	}

?>