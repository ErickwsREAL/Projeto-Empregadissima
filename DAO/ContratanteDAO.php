<?php
	
include_once ("../model/Pessoa.php");
include_once ("../model/PessoaFabricador.php");


	class ContratanteDAO {

		public function criarContratante(){
                  
                  $ContratanteF = new ContratanteFabricador();
                  $Contratante = $ContratanteF->criarPessoa();

                  return $Contratante;
            }

            public function inserirContratanteDAO(Contratante $contratante){
			include ("../controller/login_control/logar_bd_empregadissimas.php");
			
      		$Nome = $contratante->getNome(); 
                  $CPF = $contratante->getCPF();
                  $DataNascimento = $contratante->getDataNascimento();
                  $Comprovante = $contratante->getComprovante();
                  $Email = $contratante->getEmail();
                  $Senha = $contratante->getSenha();
                  $TipoPessoa = $contratante->getTipoPessoa();
      		$Sexo = $contratante->getSexo();
      		$Telefone = $contratante->getTelefone(); 
                  $Cidade = $contratante->getCidade();
                  $StatusCadastro = $contratante->getStatusCadastro();

                  $sql = "INSERT INTO pessoa(nome, cpf,telefone, data_nascimento, comprovante, email, senha, sexo, cidade, tipo_pessoa, status_cadastro) VALUES ('$Nome','$CPF', '$Telefone', '$DataNascimento', '$Comprovante', '$Email', '$Senha', '$Sexo', '$Cidade', '$TipoPessoa',  $StatusCadastro)";
                 
                  $checkB = $conn->query($sql);

              	if ($checkB == false) {
                        $conn->close();
                  	
                  	return $check = 1;
                  }
            
                  $conn->close();

                  return $check = 2;
		}

		public function desativarContratanteDAO(Contratante $contratante){
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idContrantrante = $contratante->getID();

			$sql = "UPDATE pessoa SET status_cadastro = 3 WHERE id_pessoa = '$idContrantrante'";

			$checkB = $conn->query($sql);

			if ($checkB == false) {
            	     $conn->close();
            	
            	     return $check = 1;
                  }
            
                  $conn->close();

                  return $check = 2;
      	}

	
            public function atualizarContratanteDAO(Contratante $contratante){
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idContrantrante = $contratante->getID();
                  $nomeContratante = $contratante->getNome();
                  $fotoContratante = $contratante->getFoto();
                  $descricaoContratante = $contratante->getDescricao();
                  $telefoneContratante = $contratante->getTelefone();

                  $sql = "UPDATE pessoa SET nome = '$nomeContratante', foto = '$fotoContratante', descricao = '$descricaoContratante', telefone = '$telefoneContratante' WHERE id_pessoa = '$idContrantrante'";

                  $checkB = $conn->query($sql);

                  if ($checkB == false) {
                       $conn->close();
                  
                       return $check = 1;
                  }
            
                  $conn->close();

                  return $check = 2;

            }


            public function buscarContratanteDAO(Contratante $contratante){
                  include ("../controller/login_control/logar_bd_empregadissimas.php");
                  
                  $idContrantrante = $contratante->getID();

                  $sql = "SELECT nome, descricao, telefone, foto, sexo, cidade, data_nascimento, email FROM pessoa WHERE id_pessoa = '$idContrantrante'";

                  $resultados = $conn->query($sql);

                  $row = $resultados->fetch_assoc();

                  $contratante->setNome($row["nome"]);
                  $contratante->setFoto($row["foto"]);
                  $contratante->setDescricao($row["descricao"]);
                  $contratante->setDataNascimento($row["data_nascimento"]);
                  $contratante->setCidade($row["cidade"]);
                  $contratante->setSexo($row["sexo"]);
                  $contratante->setTelefone($row["telefone"]);
                  $contratante->setEmail($row["email"]);
                  
                  return $contratante;

            }





      }




?>