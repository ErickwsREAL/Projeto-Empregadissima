<?php
	
include_once ("../model/Pessoa.php");
include_once ("../model/PessoaFabricador.php");


	class ContratanteDAO {

		public function criarContratante(){//ERICK
                  
                  $ContratanteF = new ContratanteFabricador();
                  $Contratante = $ContratanteF->criarPessoa();

                  return $Contratante;
            }

            public function buscarContratantesAtivos(){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");      
                  
                  $Contratantes = array();

                  $sql = "SELECT id_pessoa, nome, cpf FROM Pessoa WHERE tipo_pessoa = '2' AND status_cadastro = '2'";

                  $resultado = $conn->query($sql);
                  $row_count = mysqli_num_rows($resultado);

                  if ($row_count == 0) {
                        $conn->close();
                        return [];
                  }

                  while($row = $resultado->fetch_assoc()){
                        
                        $Contratantes[] = $row;                       
                  }

                  $conn->close();

                  return $Contratantes;

            }

            public function inserirContratanteDAO(Contratante $contratante){//ERICK
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

                  if (preg_match('~[0-9]+~', $Nome)) {
                        return "b";
                  }

                  if (preg_match('~[0-9]+~', $Cidade)) {
                        return "c";
                  }

                  $sql1 = "SELECT id_pessoa FROM pessoa WHERE cpf = '$CPF' OR email = '$Email' OR telefone = '$Telefone'";
                  
                  $resultado = $conn->query($sql1);
                  $row_count = mysqli_num_rows($resultado);
                  
                  if ($row_count > 0) {
                        
                        return "a";
                  }

                  $sql = "INSERT INTO pessoa(nome, cpf,telefone, data_nascimento, comprovante, email, senha, sexo, cidade, tipo_pessoa, status_cadastro) VALUES ('$Nome','$CPF', '$Telefone', '$DataNascimento', '$Comprovante', '$Email', '$Senha', '$Sexo', '$Cidade', '$TipoPessoa',  $StatusCadastro)";
                 
                  $checkB = $conn->query($sql);

              	if ($checkB == false) {
                        $conn->close();
                  	
                  	return "false";
                  }
            
                  $conn->close();
		}

		public function desativarContratanteDAO(Contratante $contratante){//ERICK
			include ("../controller/login_control/logar_bd_empregadissimas.php");

			$idContratante = $contratante->getID();

			$sqlServico = "SELECT id_servico FROM servico WHERE id_contratante = '$idContratante' AND status_servico != 5"; 

                  $resultado = $conn->query($sqlServico);
                  $row_count = mysqli_num_rows($resultado);

                  if ($row_count == 0) {
                        
                        $sql = "UPDATE pessoa SET status_cadastro = 3 WHERE id_pessoa = '$idContratante'";
                        $checkB = $conn->query($sql);
                        
                        if ($checkB == false) {
                             $conn->close();
                        
                             return "false";
                        }
                  
                        $conn->close();      
                  }else{
                        
                        $conn->close();
                        return "a";
                  }
      	}

	
            public function atualizarContratanteDAO(Contratante $contratante){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idContrantrante = $contratante->getID();
                  $nomeContratante = $contratante->getNome();
                  $fotoContratante = $contratante->getFoto();
                  $descricaoContratante = $contratante->getDescricao();
                  $telefoneContratante = $contratante->getTelefone();

                  if (preg_match('~[0-9]+~', $nomeContratante)) {
                        return "b";
                  }

                  $sql1 = "SELECT id_pessoa FROM pessoa WHERE telefone = '$telefoneContratante'";
                  
                  $resultado = $conn->query($sql1);
                  $row_count = mysqli_num_rows($resultado);
                  
                  if ($row_count > 0) {
                        
                        $sql = "UPDATE pessoa SET nome = '$nomeContratante', foto = '$fotoContratante', descricao = '$descricaoContratante' WHERE id_pessoa = '$idContrantrante'";

                        $checkB = $conn->query($sql);

                        if ($checkB == false) {
                             $conn->close();
                        
                             return "false";
                        }

                        return "a";
                  }

                  $sql = "UPDATE pessoa SET nome = '$nomeContratante', foto = '$fotoContratante', descricao = '$descricaoContratante', telefone = '$telefoneContratante' WHERE id_pessoa = '$idContrantrante'";

                  $checkB = $conn->query($sql);

                  if ($checkB == false) {
                       $conn->close();
                  
                       return "false";
                  }
            
                  $conn->close();
            }


            public function buscarContratanteDAO(Contratante $contratante){//ERICK
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


            public function admDesativarContratantes($ids){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");
                  
                  $count = [];
                  
                  foreach ($ids as $id) {

                        $sql1 = "SELECT tipo_pessoa FROM pessoa WHERE id_pessoa = '$id'";
                        $resultados = $conn->query($sql1);
                        $row = $resultados->fetch_assoc();

                        if ($row['tipo_pessoa'] == 2) {
                              $sqlServico = "SELECT id_servico FROM servico WHERE id_contratante = '$id' AND status_servico != 5"; 

                              $resultado = $conn->query($sqlServico);
                              $row_count = mysqli_num_rows($resultado);
                              
                              if ($row_count == 0) {
                                    $sql = "UPDATE pessoa SET status_cadastro = '3' WHERE id_pessoa = '$id'";
                                    $checkB = $conn->query($sql);
                                    
                                    if ($checkB == false){
                                          $conn->close();      
                                          return "false";
                                    }     
                                    
                                    $count[$id] = "2";
                              
                              }else{

                                    $count[$id] = "1";                        
                                          
                              }
                        }
                  }
                  
                  $conn->close();
                  return $count;
            }
      








      }




?>