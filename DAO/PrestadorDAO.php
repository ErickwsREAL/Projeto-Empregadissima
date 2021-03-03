<?php
	
include_once ("../model/Pessoa.php");

	class PrestadorDAO {

		public function inserirPrestadorDAO(Prestador $prestador){
		    include ("../controller/login_control/logar_bd_empregadissimas.php");
			
      		$Nome = $prestador->getNome(); 
                  $CPF = $prestador->getCPF();
                  $DataNascimento = $prestador->getDataNascimento();
                  $Comprovante = $prestador->getComprovante();
                  $Email = $prestador->getEmail();
                  $Senha = $prestador->getSenha();
                  $TipoPessoa = $prestador->getTipoPessoa();
      		$Sexo = $prestador->getSexo();
      		$Telefone = $prestador->getTelefone(); 
                  $Cidade = $prestador->getCidade();
                  $StatusCadastro = $prestador->getStatusCadastro();

                  $sql = "INSERT INTO pessoa(nome, cpf,telefone, data_nascimento, comprovante, email, senha, sexo, cidade, tipo_pessoa, status_cadastro) VALUES ('$Nome','$CPF', '$Telefone', '$DataNascimento', '$Comprovante', '$Email', '$Senha', '$Sexo', '$Cidade', '$TipoPessoa',  $StatusCadastro)";
                 
                  $checkB = $conn->query($sql);

              	if ($checkB == false) {
                  	$conn->close();
                  	
                  	return $check = 1;
                  }
                  
                  $conn->close();

                  return $check = 2;
		}

            public function desativarPrestadorDAO(Prestador $prestador){
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idPrestador = $prestador->getID();

                  $sql = "UPDATE pessoa SET status_cadastro = 3 WHERE id_pessoa = '$idPrestador'";

                  $checkB = $conn->query($sql);

                  if ($checkB == false) {
                        $conn->close();
                  
                        return $check = 1;
                  }
                  
                  $conn->close();

                  return $check = 2;
                  
            }

	      public function atualizarPrestadorDAO(Prestador $prestador){
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idPrestador = $prestador->getID();
                  $nomePrestador = $prestador->getNome();
                  $fotoPrestador = $prestador->getFoto();
                  $descricaoPrestador = $prestador->getDescricao();
                  $telefonePrestador = $prestador->getTelefone();

                  $sql = "UPDATE pessoa SET nome = '$nomePrestador', foto = '$fotoPrestador', descricao = '$descricaoPrestador', telefone = '$telefonePrestador' WHERE id_pessoa = '$idPrestador'";

                  $checkB = $conn->query($sql);

                  if ($checkB == false) {
                       $conn->close();
                  
                       return $check = 1;
                  }
            
                  $conn->close();

                  return $check = 2;

            }     

            public function buscarPrestadorDAO(Prestador $prestador){
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idPrestador = $prestador->getID();

                  $sql = "SELECT nome, descricao, telefone, foto FROM pessoa WHERE id_pessoa = '$idPrestador'";

                  $resultados = $conn->query($sql);

                  $row = $resultados->fetch_assoc();

                  $prestador->setNome($row["nome"]);
                  $prestador->setFoto($row["foto"]);
                  $prestador->setDescricao($row["descricao"]);
                  $prestador->setTelefone($row["telefone"]);
            
                  $conn->close();

                  return $prestador;

            }

      }




?>