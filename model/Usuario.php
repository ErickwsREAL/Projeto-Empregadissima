<?php
    class Usuario{    

    	public static function insert($dadosUsuario){
           include ("logar_bd_empregadissimas.php");

            $nome = $dadosUsuario['nome'];
            $cpf = $dadosUsuario['cpf'];
            $telefone = $dadosUsuario['telefone'];
            $data_nascimento = $dadosUsuario['data_nascimento'];
            $comprovante = $dadosUsuario['comprovante'];
            $email = $dadosUsuario['email'];
            $senha = $dadosUsuario['senha'];
            $tipo_pessoa = $dadosUsuario['tipo_pessoa'];
		    $sexo = $dadosUsuario['sexo'];
            $cidade = $dadosUsuario['cidade'];
            
            $sql = "INSERT INTO pessoa(nome, cpf, telefone, data_nascimento, comprovante, email, senha, sexo, cidade, tipo_pessoa, status_cadastro) VALUES ('$nome','$cpf', '$telefone', '$data_nascimento', '$comprovante', '$email', '$senha', '$sexo', '$cidade', '$tipo_pessoa',  1)";
           
            $conn->query($sql);

            $conn->close(); 
    	}

        public static function insertEndereço($dadosEnd){
            include ("logar_bd_empregadissimas.php");

            $bairro = $dadosEnd['bairro'];
            $rua = $dadosEnd['rua'];
            $numero = $dadosEnd['numero'];
            $complemento = $dadosEnd['complemento'];
            $cep = $dadosEnd['cep'];
            $id_pessoa_c = $dadosEnd['id_c'];

            $sql = "INSERT INTO endereco(bairro, rua, numero, complemento, cep, id_pessoa) VALUES ('$bairro','$rua', '$numero', '$complemento', '$cep', '$id_pessoa_c')";
       
            $conn->query($sql);

            $conn->close();    
        }
        

        public static function deletarEndereço($id_end){
            include ("logar_bd_empregadissimas.php");

                $sql = "DELETE FROM endereco WHERE id_endereco = '$id_end' ";
       
                $conn->query($sql);

                $conn->close();    
        }
        
        public static function buscarEndereço($id_end){
            include ("logar_bd_empregadissimas.php");

                $sql = "SELECT * FROM endereco WHERE id_endereco = '$id_end' ";
       
                $result = $conn->query($sql);

                $row = $result->fetch_array();

                $dados = array(
                    'Bairro' => $row["bairro"],
                    'Rua' => $row["rua"],
                    'Numero' => $row["numero"],
                    'Complemento' => $row["complemento"],
                    'CEP' => $row["cep"],
                    'id_end' => $row["id_endereco"]
                );

                $conn->close();
                
                return $dados;  
        }
        
        public static function atualizarEndereço($dadosEnd){
            include ("logar_bd_empregadissimas.php");

                $bairro = $dadosEnd['bairro'];
                $rua = $dadosEnd['rua'];
                $numero = $dadosEnd['numero'];
                $complemento = $dadosEnd['complemento'];
                $cep = $dadosEnd['cep'];
                $id_end = $dadosEnd['id_end'];

                $sql = "UPDATE endereco SET bairro = '$bairro', rua = '$rua', numero = '$numero', complemento = '$complemento', cep = '$cep' WHERE id_endereco = '$id_end'";
                
                $conn->query($sql);

                $conn->close();
        }

        public static function select($dadosGET, $params){
            include ("logar_bd_empregadissimas.php");

            $sql = "SELECT descricao, nome, telefone, foto, tipo_pessoa FROM pessoa WHERE id_pessoa='$dadosGET'";

            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            $dados = array(
                'descricao' => $row["descricao"],
                'nome' => $row["nome"],
                'telefone' => $row["telefone"],
                'foto' => $row["foto"],
                'tipo_pessoa' => $row["tipo_pessoa"]
            );

            $conn->close();
            
            return $dados;
        }

		public static function delete($dadosGET, $params){
			include ("logar_bd_empregadissimas.php");

            $deletar = $dados['id_pessoa'];

            $sql = "DELETE FROM pessoa WHERE nome='$deletar'";

            $conn->query($sql);

            $conn->close();

    	}

        public static function update($dadosGET, $dadosPOST){
            include ("logar_bd_empregadissimas.php");

            $id_pessoa = $dadosGET['id_pessoa'];

            echo $dadosGET['id_pessoa'];
            echo $dadosPOST['telefone'];
            echo $dadosPOST['nome'];
            echo $dadosPOST['foto'];

            $descricao = $dadosPOST['descricao'];
            $nome = $dadosPOST['nome'];
            $telefone = $dadosPOST['telefone'];
            $foto = $dadosPOST['foto'];

            $sql = "UPDATE pessoa SET descricao='$descricao', nome='$nome', telefone='$telefone', foto='$foto' WHERE id_pessoa='$id_pessoa'";

            $conn->query($sql);

            $conn->close();        
        }


        public static function approve($dados_array, $dadosPOST){
            include ("logar_bd_empregadissimas.php");
            


            $conn->query($sql);

            $conn->close(); 
        }
    }

?>