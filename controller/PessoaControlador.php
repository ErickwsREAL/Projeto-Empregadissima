<?php  

	include_once ("../DAO/ContratanteDAO.php");
	include_once ("../DAO/PrestadorDAO.php");
	include_once ("../model/PessoaFabricador.php");
	include_once ("../model/Pessoa.php");
	
	switch($_GET['metodo']){

		case 'Inserir':
			if ($_POST['tipo_pessoa'] == 2) {

				$ContratanteF = new ContratanteFabricador();
				$Contratante = $ContratanteF->criarPessoa(); 
				
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

				$ContratanteDAOb = new ContratanteDAO(); 
				$check = $ContratanteDAOb->inserirContratanteDAO($Contratante);
				if ($check != 2) {
					echo '<script>alert("Seu cadastro não foi efetuado! Tente novamente.")</script>';
				}
				echo '<script>alert("Cadastro feito com sucesso! Aguarde a liberação feita pelo administrador.")</script>';
				echo '<script>location.href="../views/index.php"</script>';
			}
			elseif ($_POST['tipo_pessoa'] == 1) {

				$PrestadorF = new PrestadorFabricador();
				$Prestador = $PrestadorF->criarPessoa(); 
				
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

				$PrestadorDAOb = new PrestadorDAO(); 
				$check = $PrestadorDAOb->inserirPrestadorDAO($Prestador);
				if ($check != 2) {
					echo '<script>alert("Seu cadastro não foi efetuado! Tente novamente.")</script>';
				}
				echo '<script>alert("Cadastro feito com sucesso! Aguarde a liberação feita pelo administrador.")</script>';
				echo '<script>location.href="../views/index.php"</script>';
			}
			break;

		case 'Desativar':
			if ($_POST['tipo_p'] == 2) {

				$ContratanteF = new ContratanteFabricador();
				$Contratante = $ContratanteF->criarPessoa(); 

				$Contratante->setID($_POST['id_p']);

				$ContratanteDAOb = new ContratanteDAO(); 
				$check = $ContratanteDAOb->desativarContratanteDAO($Contratante);

				if ($check != 2) {
						echo '<script>alert("Não foi possivel desativar o seu cadastro.")</script>';
				}
				
				echo '<script>alert("Cadastro desativado! Para reativar contate algum administrador.")</script>';
				echo '<script>location.href="../views/index.php"</script>';
							
			}

			if ($_POST['tipo_p'] == 1) {

				$PrestadorF = new PrestadorFabricador();
				$Prestador = $PrestadorF->criarPessoa(); 

				$Prestador->setID($_POST['id_p']);

				$PrestadorDAOb = new PrestadorDAO(); 
				$check = $PrestadorDAOb->desativarPrestadorDAO($Prestador);

				if ($check != 2) {
					echo '<script>alert("Não foi possivel desativar o seu cadastro")</script>';
				}
					
				echo '<script>alert("Cadastro desativado! Para reativar contate algum administrador.")</script>';
				echo '<script>location.href="../views/index.php"</script>';
							
			}	
			break;

		case 'Atualizar':
			if ($_GET['tipo_pessoa'] == 2) {

				$ContratanteF = new ContratanteFabricador();
				$Contratante = $ContratanteF->criarPessoa(); 

				$Contratante->setID($_GET['id_pessoa']);
				$Contratante->setDescricao($_POST['descricao']);
				$Contratante->setNome($_POST['nome']);
				$Contratante->setTelefone($_POST['telefone']);
				$Contratante->setFoto($_POST['foto']);

				$ContratanteDAOb = new ContratanteDAO(); 
				$check = $ContratanteDAOb->atualizarContratanteDAO($Contratante);

				if ($check != 2) {
						echo '<script>alert("Não foi possivel atualizar o seu cadastro.")</script>';
				}
				
				echo '<script>alert("Cadastro Atualizado!")</script>';
				echo '<script>location.href="../views/perfilcontratante.php"</script>';
							
			}

			if ($_GET['tipo_pessoa'] == 1) {

				$PrestadorF = new PrestadorFabricador();
				$Prestador = $PrestadorF->criarPessoa(); 

				$Prestador->setID($_GET['id_pessoa']);
				$Prestador->setDescricao($_POST['descricao']);
				$Prestador->setNome($_POST['nome']);
				$Prestador->setTelefone($_POST['telefone']);
				$Prestador->setFoto($_POST['foto']);

				$PrestadorDAOb = new PrestadorDAO(); 
				$check = $PrestadorDAOb->atualizarPrestadorDAO($Prestador);

				if ($check != 2) {
						echo '<script>alert("Não foi possivel atualizar o seu cadastro.")</script>';
				}
				
				echo '<script>alert("Cadastro Atualizado!")</script>';
				echo '<script>location.href="../views/perfilcontratante.php"</script>';
							
			}

			break;

		case 'Buscar':
			
			if ($_GET['tipo_pessoa'] == 2) {

				$ContratanteF = new ContratanteFabricador();
				$Contratante = $ContratanteF->criarPessoa(); 

				$Contratante->setID($_GET['id_pessoa']);

				$ContratanteDAOb = new ContratanteDAO(); 
				$Contratante = $ContratanteDAOb->buscarContratanteDAO($Contratante);

				echo '<script>location.href="../views/perfilcontratante.php?descricao='.$Contratante->getDescricao().'&nome='.$Contratante->getNome().'&telefone='.$Contratante->getTelefone().'&foto='.$Contratante->getFoto().'"</script>'; 
							
			}

			if ($_GET['tipo_pessoa'] == 1) {

				$PrestadorF = new PrestadorFabricador();
				$Prestador = $PrestadorF->criarPessoa(); 

				$Prestador->setID($_GET['id_pessoa']);

				$PrestadorDAOb = new PrestadorDAO(); 
				$Prestador = $PrestadorDAOb->buscarPrestadorDAO($Prestador);

				echo '<script>location.href="../views/perfil.php?descricao='.$Prestador->getDescricao().'&nome='.$Prestador->getNome().'&telefone='.$Prestador->getTelefone().'&foto='.$Prestador->getFoto().'"</script>'; 
							
			}		

			break;	
	}
?>