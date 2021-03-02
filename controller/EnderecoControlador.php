<?php 

	include_once ("../DAO/EnderecoDAO.php");
	include_once ("../model/Endereco.php");

	switch($_GET['metodo']){

		case 'Inserir':
			
			$enderecoC = new Endereco();
			$enderecoC->setIDContratante($_POST['id_c']);
			$enderecoC->setRua($_POST['rua']);
			$enderecoC->setBairro($_POST['bairro']);
			$enderecoC->setCEP($_POST['cep']);
			$enderecoC->setNumero($_POST['numero']);
			$enderecoC->setComplemento($_POST['complemento']);

			$enderecoDAOC = new EnderecoDAO();
			$enderecoDAOC->inserirEndereco($enderecoC); 
			echo '<script>alert("Cadastro do endereço feito com sucesso!")</script>';
			echo '<script>location.href="../views/perfilcontratante.php"</script>';

			break;

		case 'Excluir':
			# code...
			break;	

		case 'Atualizar':
			# code...
			break;		

		case 'Buscar':
			# code...
			break;	
	}

?>