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

	function buscarPrestadores($busca) {
		$PrestadorDAO = new PrestadorDAO();

		$resultados = $PrestadorDAO->buscarPrestadores($busca);

		while($dados_prestador = $resultados->fetch_array(MYSQLI_ASSOC)) {
			$Prestador = criarObjetoPC(1, $PrestadorDAO);

			$Prestador->setID($dados_prestador["id_pessoa"]);
			$Prestador->setNome($dados_prestador["nome"]);
			$Prestador->setFoto($dados_prestador["foto"]);

			$results[] = $Prestador;
		}

		return $results;
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
				
				$output = '';
				$result = $PrestadorDAO->buscarPrestadores($search);
				if(isset($result)) {
					while($row = $result->fetch_array(MYSQLI_ASSOC)) {
						if ($row['foto'] != NULL) {
							$foto = $row['foto']; 
						} else {
							$foto = 'profile.png';
						}
						$output .= '
						<div class="contractor-item">
							<div class="thumbnail">
							<input type="hidden" name="id_prestador" id="id_prestador" value="'.$row['id_pessoa'].'">                                                 
							<img src="../views/imagens/'.$foto.'">
							<div class="caption">
								<h3 style="font-size:20px; color:white">'.$row['nome'].'</h3>
								<p><a href="../views/perfil-prestador-visao-contratante.php?id_prestador='.$row['id_pessoa'].'" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
							</div>
						</div>
						';
					}
				}
				echo '<script>location.href="../views/visao-contratante.php?resultados='.$output.'"</script>';
		}		
	}
?>