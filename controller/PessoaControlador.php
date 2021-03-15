<?php  

	include_once ("../DAO/ContratanteDAO.php");
	include_once ("../DAO/PrestadorDAO.php");
	include_once ("../model/PessoaFabricador.php");
	include_once ("../model/Pessoa.php");
	
//------------------------------------------------------------------------------------------------------------------------------------------	
	$ContratanteDAO = new ContratanteDAO(); 
	$PrestadorDAO = new PrestadorDAO();		 
	$Contratante = criarObjetoPC(2, $ContratanteDAO);
	$Prestador = criarObjetoPC(1, $PrestadorDAO);

	function criarObjetoPC($tipo_pessoa, $usuarioDAO){
			
		if ($tipo_pessoa == 2) {

			$Contratante = $usuarioDAO->criarContratante(); 

			return $Contratante;
		}
			
		if ($tipo_pessoa == 1) {

			$Prestador = $usuarioDAO->criarPrestador(); 

			return $Prestador;
		}
	}

	function buscarUsuario($id_pessoa, $tipo_pessoa){
	
		if ($tipo_pessoa == 2) {

			$ContratanteDAO = new ContratanteDAO();
				
			$Contratante = criarObjetoPC($tipo_pessoa, $ContratanteDAO);
			$Contratante->setID($id_pessoa);
			$Contratante = $ContratanteDAO->buscarContratanteDAO($Contratante);
				
			return $Contratante;
		}

		if ($tipo_pessoa == 1) {

			$PrestadorDAO = new PrestadorDAO();
				
			$Prestador = criarObjetoPC($tipo_pessoa, $PrestadorDAO);
			$Prestador->setID($id_pessoa);
			$Prestador = $PrestadorDAO->buscarPrestadorDAO($Prestador);
				
			return $Prestador;
		}

	}

	function buscarPrestadores() {
		if (isset($_GET['busca'])) {
			$resultados = $PrestadorDAO->buscarPrestadores($_POST['search']);

			return $resultados;
		}

	}

//------------------------------------------------------------------------------------------------------------------------------------------
	if (isset($_GET['metodo'])) {  
		switch($_GET['metodo']){

			case 'Inserir':
				if ($_POST['tipo_pessoa'] == 2) {

					$Contratante->setNome($_POST['nome']);
					$Contratante->setCPF($_POST['cpf']);
					$Contratante->setTelefone($_POST['telefone']);
					$Contratante->setEmail($_POST['email']);
					$Contratante->setDataNascimento($_POST['data_nascimento']);
					$Contratante->setComprovante($_POST['comprovante']);
					$Contratante->setTipoPessoa($_POST['tipo_pessoa']);
					$Contratante->setSexo($_POST['sexo']);
					$Contratante->setStatusCadastro(1);
					$Contratante->setCidade($_POST['cidade']);
					$Contratante->setSenha($_POST['senha']);

					$ContratanteDAO->inserirContratanteDAO($Contratante);
			
					echo '<script>alert("Cadastro feito com sucesso! Aguarde a liberação feita pelo administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
				}
				elseif ($_POST['tipo_pessoa'] == 1) {
					
					$Prestador->setNome($_POST['nome']);
					$Prestador->setCPF($_POST['cpf']);
					$Prestador->setTelefone($_POST['telefone']);
					$Prestador->setEmail($_POST['email']);
					$Prestador->setDataNascimento($_POST['data_nascimento']);
					$Prestador->setComprovante($_POST['comprovante']);
					$Prestador->setTipoPessoa($_POST['tipo_pessoa']);
					$Prestador->setSexo($_POST['sexo']);
					$Prestador->setStatusCadastro(1);
					$Prestador->setCidade($_POST['cidade']);
					$Prestador->setSenha($_POST['senha']);

					$PrestadorDAO->inserirPrestadorDAO($Prestador);
					
					echo '<script>alert("Cadastro feito com sucesso! Aguarde a liberação feita pelo administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
				}
				
				break;
		//--------------------------------------------------------------acima cadastro.php, abaixo perfilcontratante.php e perfil.php------------
			case 'Desativar':
				if ($_POST['tipo_pessoa'] == 2) {

					$Contratante->setID($_POST['id_pessoa']);

					$ContratanteDAO->desativarContratanteDAO($Contratante);

					echo '<script>alert("Cadastro desativado! Para reativar contate algum administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
								
				}

				if ($_POST['tipo_pessoa'] == 1) {

					$Prestador->setID($_POST['id_pessoa']);

					$PrestadorDAOb->desativarPrestadorDAO($Prestador);
						
					echo '<script>alert("Cadastro desativado! Para reativar contate algum administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
								
				}	
				
				break;

			case 'Atualizar':
				if ($_GET['tipo_pessoa'] == 2) {

					$Contratante->setID($_GET['id_pessoa']);
					$Contratante->setDescricao($_POST['descricao']);
					$Contratante->setNome($_POST['nome']);
					$Contratante->setTelefone($_POST['telefone']);
					$Contratante->setFoto($_POST['foto']);

					$ContratanteDAO->atualizarContratanteDAO($Contratante);
					
					echo '<script>alert("Cadastro Atualizado!")</script>';
					echo '<script>location.href="../views/perfilcontratante.php"</script>';
								
				}

				if ($_GET['tipo_pessoa'] == 1) {

					$Prestador->setID($_GET['id_pessoa']);
					$Prestador->setDescricao($_POST['descricao']);
					$Prestador->setNome($_POST['nome']);
					$Prestador->setTelefone($_POST['telefone']);
					$Prestador->setFoto($_POST['foto']);
					
					$PrestadorDAO->atualizarPrestadorDAO($Prestador);
					
					echo '<script>alert("Cadastro Atualizado!")</script>';
					echo '<script>location.href="../views/perfil.php"</script>';
								
				}

				break;
				
			case 'ListarPrestadores':
				$search = $_POST['search'];
				
				$result = $PrestadorDAO->buscarPrestadores($search);
				$count = $PrestadorDAO->contaPrestadores($search);

				/*
				foreach($result as $row) {
					echo '<script>location.href="../views/visao-contratante.php?id_prestador='.$row['id_pessoa'].'&foto='.$row['foto'].'&nome='.$row['nome'].'&count='.$count.'"</script>';
				}
				*/

				echo '<script>location.href="../views/visao-contratante.php?resultados='.$result.'"</script>';
				

		}		
	}
?>