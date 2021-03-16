<?php
	
include_once ("../model/Pessoa.php");

	class PrestadorDAO {

		public function criarPrestador(){ //ERICK
                  
                  $prestadorF = new prestadorFabricador();
                  $prestador = $prestadorF->criarPessoa();

                  return $prestador;
            }

            public function buscarPrestadoresAtivos(){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");      
                        
                  $Prestadores = array();

                  $sql = "SELECT id_pessoa, nome, cpf FROM pessoa WHERE tipo_pessoa = '1' AND status_cadastro = '2'";

                  $resultado = $conn->query($sql);

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

                  $sql = "INSERT INTO pessoa(nome, cpf,telefone, data_nascimento, comprovante, email, senha, sexo, cidade, tipo_pessoa, status_cadastro) VALUES ('$Nome','$CPF', '$Telefone', '$DataNascimento', '$Comprovante', '$Email', '$Senha', '$Sexo', '$Cidade', '$TipoPessoa',  $StatusCadastro)";
                 
                  $conn->query($sql);
                  
                  $conn->close();
		}

            public function desativarPrestadorDAO(Prestador $prestador){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idPrestador = $prestador->getID();

                  $sql = "UPDATE pessoa SET status_cadastro = 3 WHERE id_pessoa = '$idPrestador'";

                  $conn->query($sql);

                  $conn->close();
                  
            }

	      public function atualizarPrestadorDAO(Prestador $prestador){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");

                  $idPrestador = $prestador->getID();
                  $nomePrestador = $prestador->getNome();
                  $fotoPrestador = $prestador->getFoto();
                  $descricaoPrestador = $prestador->getDescricao();
                  $telefonePrestador = $prestador->getTelefone();

                  $sql = "UPDATE pessoa SET nome = '$nomePrestador', foto = '$fotoPrestador', descricao = '$descricaoPrestador', telefone = '$telefonePrestador' WHERE id_pessoa = '$idPrestador'";

                  $conn->query($sql);

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

            public function contaPrestadores($search) {
                  include ("../controller/login_control/logar_bd_empregadissimas.php");
                  $count = 0;
                  $nome = $search;

                  if (isset($nome)) {
                        $sql = "SELECT nome, id_pessoa, foto FROM pessoa WHERE tipo_pessoa = 1 AND nome LIKE '%$nome%'";
                  } else {
                        $sql = "SELECT nome, id_pessoa, foto FROM pessoa WHERE tipo_pessoa = 1";
                  }

                  $resultados = $conn->query($sql);
                  while($prestadores = $resultados->fetch_array()) {
                        $count += 1;
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
                  while($prestadores = $resultados->fetch_array()) {
                        $lista_prestadores[] = $prestadores;
                  }

                  $conn->close();
                  return $lista_prestadores;
            }

      
            public function admDesativarPrestadores($ids){//ERICK
                  include ("../controller/login_control/logar_bd_empregadissimas.php");
                  
                  foreach ($ids as $id) {
                    
                        $sql = "UPDATE pessoa SET status_cadastro = '3' WHERE id_pessoa = '$id' AND tipo_pessoa = '1' ";
                        $conn->query($sql);
                        
                  }     
                  $conn->close();
            }
      }


?>