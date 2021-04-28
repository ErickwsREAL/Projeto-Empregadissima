<?php
	
include_once ("../model/Pessoa.php");
include_once ("../model/PessoaFabricador.php");


	class PrestadorDAO {

		public function criarPrestador(){//ERICK
                  
                  $PrestadorF = new PrestadorFabricador();
                  $Prestador = $PrestadorF->criarPessoa();

                  return $Prestador;
            }

             public function buscarPrestadoresAtivos(){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");      
                  
                  $Prestadores = array();

                  $sql = "SELECT id_pessoa, nome, cpf FROM pessoa WHERE tipo_pessoa = '1' AND status_cadastro = '2'";

                  $resultado = $conn->query($sql);
                  $row_count = mysqli_num_rows($resultado);

                  if ($row_count == 0) {
                        $conn->close();
                        return [];
                  }

                  while($row = $resultado->fetch_assoc()){
                        
                        $Prestadores[] = $row;                        
                  }

                  $conn->close();

                  return $Prestadores;

            }

            public function inserirPrestadorDAO(Prestador $prestador){//ERICK
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

                  if (preg_match('~[0-9]+~', $Nome)) {
                        return "b";
                  }

                  if (preg_match('~[0-9]+~', $Cidade)) {
                        return "c";
                  }

                  if (strlen($Telefone) != 15) {
                       return "d";
                  }

                  if (strlen($CPF) != 14) {
                       return "e";
                  }

                  $sql1 = "SELECT id_pessoa FROM pessoa WHERE cpf = '$CPF' OR email = '$Email' OR telefone = '$Telefone'";
                  
                  $resultado = $conn->query($sql1);
                  $row_count = mysqli_num_rows($resultado);
                  
                  if ($row_count > 0) {
                        $conn->close();
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

            public function desativarPrestadorDAO(Prestador $prestador){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idPrestador = $prestador->getID();

                  $sqlServico = "SELECT id_servico FROM servico WHERE id_prestador = '$idPrestador' and status_servico !=5"; 

                  $resultado = $conn->query($sqlServico);
                  $row_count = mysqli_num_rows($resultado);

                  if ($row_count == 0) {
                        
                        $sql = "UPDATE pessoa SET status_cadastro = 3 WHERE id_pessoa = '$idPrestador'";

                        $checkB = $conn->query($sql);
                        
                        if ($checkB == false) {
                             $conn->close();
                        
                             return "false";
                        }
                  
                        $conn->close();

                  } else {

                     return "a";         
                  }        
                  
            }

	      public function atualizarPrestadorDAO(Prestador $prestador){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idPrestador = $prestador->getID();
                  $nomePrestador = $prestador->getNome();
                  $fotoPrestador = $prestador->getFoto();
                  $descricaoPrestador = $prestador->getDescricao();
                  $telefonePrestador = $prestador->getTelefone();

                  if (preg_match('~[0-9]+~', $nomePrestador)) {
                        return "b";
                  }

                  if (strlen($telefonePrestador) != 15) {
                       return "c";
                  }

                  $sql1 = "SELECT id_pessoa FROM pessoa WHERE telefone = '$telefonePrestador'";
                  
                  $resultado = $conn->query($sql1);
                  $row_count = mysqli_num_rows($resultado);
                  
                  if ($row_count > 0) {
                        
                        $sql = "UPDATE pessoa SET nome = '$nomePrestador', foto = '$fotoPrestador', descricao = '$descricaoPrestador' WHERE id_pessoa = '$idPrestador'";

                        $checkB = $conn->query($sql);

                        if ($checkB == false) {
                             $conn->close();
                        
                             return "false";
                        }

                        return "a";
                  }

                  $sql = "UPDATE pessoa SET nome = '$nomePrestador', foto = '$fotoPrestador', descricao = '$descricaoPrestador', telefone = '$telefonePrestador' WHERE id_pessoa = '$idPrestador'";

                  $checkB = $conn->query($sql);

                  if ($checkB == false) {
                       $conn->close();
                  
                       return "false";
                  }
            
                  $conn->close();

            }     

            public function buscarPrestadorDAO(Prestador $prestador){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");
                  
                  $idPrestador = $prestador->getID();

                  $sql = "SELECT nome, descricao, telefone, foto, sexo, cidade, data_nascimento, email, tipo_pessoa FROM pessoa WHERE id_pessoa = '$idPrestador'";

                  $resultados = $conn->query($sql);

                  $row = $resultados->fetch_assoc();

                  $prestador->setNome($row["nome"]);
                  $prestador->setFoto($row["foto"]);
                  $prestador->setDescricao($row["descricao"]);
                  $prestador->setDataNascimento($row["data_nascimento"]);
                  $prestador->setCidade($row["cidade"]);
                  $prestador->setSexo($row["sexo"]);
                  $prestador->setTelefone($row["telefone"]);
                  $prestador->setEmail($row["email"]);
                  $prestador->setTipoPessoa($row["tipo_pessoa"]);
                  
                  return $prestador;

            }

            public function admDesativarPrestadores($ids){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $count = [];
                  foreach ($ids as $id) {

                        $sql1 = "SELECT tipo_pessoa FROM pessoa WHERE id_pessoa = '$id'";
                        $resultados = $conn->query($sql1);
                        $row = $resultados->fetch_assoc();

                        if ($row['tipo_pessoa'] == 1) {
                              $sqlServico = "SELECT id_servico FROM servico WHERE id_prestador = '$id' AND status_servico != 5"; 

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

            public function buscarPrestadores($search) {
                  include ("../controller/login_control/logar_bd_empregadissimas.php");
                  $nome = $search;

                  if (isset($nome)) {
                        $sql = "SELECT nome, id_pessoa, foto FROM pessoa WHERE tipo_pessoa = 1 AND nome LIKE '%$nome%'";
                  } else {
                        $sql = "SELECT nome, id_pessoa, foto FROM pessoa WHERE tipo_pessoa = 1";
                  }

                  $resultados = $conn->query($sql);

                  $conn->close();
                  return $resultados;
            }

      }




?>