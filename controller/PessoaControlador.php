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

	function criarObjetoPC($tipo_pessoa, $usuarioDAO){//ERICK
			
		if ($tipo_pessoa == 2) {

			$Contratante = $usuarioDAO->criarContratante(); 

			return $Contratante;
		}
			
		if ($tipo_pessoa == 1) {

			$Prestador = $usuarioDAO->criarPrestador(); 

			return $Prestador;
		}
	}

	function buscarUsuario($id_pessoa, $tipo_pessoa){//ERICK
	
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

	function buscarCadastrosAtivos(){//ERICK

		$ContratanteDAO = new ContratanteDAO();
		$PrestadorDAO = new PrestadorDAO();

		$Prestadores = $PrestadorDAO->buscarPrestadoresAtivos();
		$Contratantes = $ContratanteDAO->buscarContratantesAtivos();

		if ($Prestadores == false and $Contratantes == false) {

			return false;
		}

		$Usuarios = array_merge($Prestadores, $Contratantes);

		return $Usuarios;

	}

	function buscarPrestadores($busca) {
		$PrestadorDAO = new PrestadorDAO();

		$resultados = $PrestadorDAO->buscarPrestadores($busca);

		return $resultados;
	}

//------------------------------------------------------------------------------------------------------------------------------------------
	if (isset($_GET['metodo'])) {  
		switch($_GET['metodo']){

			case 'Inserir'://ERICK
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

					$checkBD = $ContratanteDAO->inserirContratanteDAO($Contratante);
					
					if ($checkBD == "false") {
						
						echo '<script>alert("Ocorreu um erro ao inserir seu cadastro. Tente novamente.")</script>';
						echo '<script>location.href="../views/cadastro.php"</script>';

						break;
					}

					if ($checkBD == "a") {
						
						echo '<script>alert("Email, CPF ou Telefone já utilizados. Tente novamente.")</script>';
						echo '<script>location.href="../views/cadastro.php"</script>';

						break;
					}

					echo '<script>alert("Cadastro feito com sucesso! Aguarde a liberação feita pelo administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
				}
				
				if ($_POST['tipo_pessoa'] == 1) {
					
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

					$checkBD = $PrestadorDAO->inserirPrestadorDAO($Prestador);

					if ($checkBD == "false") {
						
						echo '<script>alert("Ocorreu um erro ao inserir seu cadastro. Tente novamente.")</script>';
						echo '<script>location.href="../views/cadastro.php"</script>';

						break;
					}

					if ($checkBD == "a") {
						
						echo '<script>alert("Email, CPF ou Telefone já utilizados. Tente novamente.")</script>';
						echo '<script>location.href="../views/cadastro.php"</script>';

						break;
					}

					
					echo '<script>alert("Cadastro feito com sucesso! Aguarde a liberação feita pelo administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
				}
				
				break;
		//--------------------------------------------------------------acima cadastro.php, abaixo perfilcontratante.php e perfil.php------------
			case 'Desativar'://ERICK
				if ($_GET['tipo_pessoa'] == 2) {

					$Contratante->setID($_GET['id_pessoa']);

					$checkBD = $ContratanteDAO->desativarContratanteDAO($Contratante);

					if ($checkBD == "a") {
						
						echo '<script>alert("Ainda existem serviços em seu nome, verifique a aba de solicitações.")</script>';
						echo '<script>location.href="../views/perfilcontratante.php"</script>';
						
						break;
					}	

					if ($checkBD == "false") {
						
						echo '<script>alert("Houve um erro ao desativar sua conta. Tente novamente.")</script>';
						echo '<script>location.href="../views/perfilcontratante.php"</script>';
						break;

					}

					echo '<script>alert("Cadastro desativado! Para reativar contate algum administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
								
				}

				if ($_GET['tipo_pessoa'] == 1) {

					$Prestador->setID($_GET['id_pessoa']);

					$checkBD = $PrestadorDAO->desativarPrestadorDAO($Prestador);

					if ($checkBD == "false") {
						
						echo '<script>alert("Houve um erro ao desativar sua conta. Tente novamente.")</script>';
						echo '<script>location.href="../views/perfil.php"</script>';
						break;

					}

					if ($checkBD == "a") {
						
						echo '<script>alert("Ainda existem serviços em seu nome, verifique a aba de solicitações.")</script>';
						echo '<script>location.href="../views/perfil.php"</script>';
						break;
					}
						
					echo '<script>alert("Cadastro desativado! Para reativar contate algum administrador.")</script>';
					echo '<script>location.href="../views/index.php"</script>';
								
				}	
				
				break;

			case 'Atualizar'://ERICK
				if ($_POST['tipo_pessoa'] == 2) {

					$Contratante->setID($_POST['id_pessoa']);
					$Contratante->setDescricao($_POST['descricao']);
					$Contratante->setNome($_POST['nome']);
					$Contratante->setTelefone($_POST['telefone']);
					$Contratante->setFoto($_POST['foto']);

					$checkBD = $ContratanteDAO->atualizarContratanteDAO($Contratante);


					if ($checkBD == "false") {
						
						echo '<script>alert("Houve um erro ao atualizar suas informações. Tente novamente.")</script>';
						echo '<script>location.href="../views/perfilcontratante.php"</script>';

					}else {
					
						echo '<script>alert("Cadastro Atualizado!")</script>';
						echo '<script>location.href="../views/perfilcontratante.php"</script>';
					}				
				}

				if ($_POST['tipo_pessoa'] == 1) {

					$Prestador->setID($_POST['id_pessoa']);
					$Prestador->setDescricao($_POST['descricao']);
					$Prestador->setNome($_POST['nome']);
					$Prestador->setTelefone($_POST['telefone']);
					$Prestador->setFoto($_POST['foto']);
					
					$checkBD = $PrestadorDAO->atualizarPrestadorDAO($Prestador);
					
					if ($checkBD == false) {
						
						echo '<script>alert("Houve um erro ao atualizar suas informações. Tente novamente.")</script>';
						echo '<script>location.href="../views/perfil.php"</script>';

					}else {
						echo '<script>alert("Cadastro Atualizado!")</script>';
						echo '<script>location.href="../views/perfil.php"</script>';
					}	
				}

				break;

			case 'AdmDesativarCadastro'://ERICK
				
				if(isset($_POST['checagem'])){
                	
                	$ids = $_POST['checagem'];
                	
                	$checkBDC = $ContratanteDAO->admDesativarContratantes($ids);
                	$checkBDP = $PrestadorDAO->admDesativarPrestadores($ids);
                	
                	if ($checkBDP == false and $checkBDC == false){
                            
                            echo '<script>alert("Erro ao excluir o(s) cadastro(s)!")</script>';
                			echo '<script>location.href="../views/adm-manter-cadastros.php#tabs-2"</script>';

                			break;
                        }	

                    if ($checkBDP == false and $checkBDC == true or $checkBDP == true and $checkBDC == false){
                            
                            echo '<script>alert("Erro ao excluir algum(us) cadastro(s)")</script>';
                			echo '<script>location.href="../views/adm-manter-cadastros.php#tabs-2"</script>';
                        	
                        	break;
                        }    

                	echo '<script>alert("Cadastro(s) removido(s)!")</script>';
                	echo '<script>location.href="../views/adm-manter-cadastros.php#tabs-2"</script>';
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