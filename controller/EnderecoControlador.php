<?php 

	include_once ("../DAO/EnderecoDAO.php");
	include_once ("../model/Endereco.php");

	$enderecoC = new Endereco();
	$enderecoDAOC = new EnderecoDAO();

	switch($_GET['metodo']){

		case 'Inserir':
					
			$enderecoC->setIDContratante($_POST['id_c']);
			$enderecoC->setRua($_POST['rua']);
			$enderecoC->setBairro($_POST['bairro']);
			$enderecoC->setCEP($_POST['cep']);
			$enderecoC->setNumero($_POST['numero']);
			$enderecoC->setComplemento($_POST['complemento']);

			$enderecoDAOC->inserirEndereco($enderecoC); 
			echo '<script>alert("Cadastro do endereço feito com sucesso!")</script>';
			echo '<script>location.href="../views/perfilcontratante.php"</script>';

			break;

		case 'Excluir':
			
			$enderecoC->setID($_GET['id_end']);

			$enderecoDAOC->excluirEndereco($enderecoC);

			echo '<script>alert("Endereço Excluido!")</script>';
			echo '<script>location.href="../views/perfilcontratante.php"</script>';

			break;	

		case 'Atualizar':
			
			$enderecoC->setID($_POST['id_end']);
			$enderecoC->setRua($_POST['rua']);
			$enderecoC->setBairro($_POST['bairro']);
			$enderecoC->setCEP($_POST['cep']);
			$enderecoC->setNumero($_POST['numero']);
			$enderecoC->setComplemento($_POST['complemento']);


			$enderecoDAOC->atualizarEndereco($enderecoC);

			echo '<script>alert("Endereço Atualizado!")</script>';
			echo '<script>location.href="../views/perfilcontratante.php"</script>';

			break;			

		case 'Buscar':
			
			$enderecoC->setID($_GET['id_end']);

			$endereco = $enderecoDAOC->buscarEndereco($enderecoC);

			echo '<script>location.href="../views/perfilcontratante.php?bairro='.$endereco->getBairro().'&rua='.$endereco->getRua().'&numero='.$endereco->getNumero().'&complemento='.$endereco->getComplemento().'&cep='.$endereco->getCEP().'&id_end='.$endereco->getID().'"</script>';

			break;	
	}

?>