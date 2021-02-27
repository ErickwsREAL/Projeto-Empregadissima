<?php
    class Servico_Prestador{    
        public static function insert($dadosServico){
           include ("../controller/login_control/logar_bd_empregadissimas.php");

           $desc_servico = $dadosServico['desc_servico'];
           $preco_servico = $dadosServico['preco_servico'];
           $id_pessoa = $dadosServico['id_pessoa'];

           $sql = "INSERT INTO diaria_prestador (descricao_diaria, valor, id_pessoa) VALUES ('$desc_servico', '$preco_servico', $id_pessoa)";
           $conn->query($sql);
            
            /*if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }*/

            $conn->close();
        }

         public static function select($dadosGET, $params){
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $sql = "SELECT descricao_diaria, valor, id_diaria FROM diaria_prestador WHERE id_diaria='$dadosGET'";

            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            $dados = array(
                'desc_servico' => $row["descricao_diaria"],
                'preco_servico' => $row["valor"],
                'id_diaria' => $row["id_diaria"]
            );

            //if ($result->num_rows > 0) {
           /*     output data of each row*/
            //  while($row = $result->fetch_assoc()) {
                //echo "desc_servico: " . $row["descricao_diaria"]. " - valor: " . $row["valor"]. "<br>";
             //  }
            //  } else {
             //   echo "0 results";
            // }
          
            $conn->close();
            
            return $dados;
        }

        public static function delete($dadosGET, $dados){
            
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $sql = "DELETE FROM diaria_prestador WHERE id_diaria='$dadosGET'";

            $conn->query($sql);

            $conn->close();
        }

        /*public static function selectUpdate($params){
            include ("logar_bd_empregadissimas.php");

            $atualiza = $params['atualiza'];

            $sql = "SELECT nome, sobrenome, email FROM usuario WHERE nome='$atualiza'";

            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            $dados = array(
                'nome' => $row["nome"],
                'sobrenome' => $row["sobrenome"],
                'email' => $row["email"]
            );

           // if ($result->num_rows > 0) {
           //     output data of each row
           //     while($row = $result->fetch_assoc()) {
           //      echo "nome: " . $row["nome"]. " " . $row["sobrenome"]. " - e-mail " . $row["email"]. "<br>";
           //    }
           //   } else {
           //      echo "0 results";
           //  }
          
            $conn->close();
            
            return $dados;
        }*/

        public static function update($dadosGET, $dadosPOST){
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $id_diaria = $dadosGET['id_diaria'];

            echo $dadosGET['id_diaria'];
            echo $dadosPOST['desc_servico'];
            echo $dadosPOST['preco_servico'];

            $desc_servico = $dadosPOST['desc_servico'];
            $preco_servico = $dadosPOST['preco_servico'];

            $sql = "UPDATE diaria_prestador SET descricao_diaria='$desc_servico', valor='$preco_servico' WHERE id_diaria='$id_diaria'";

            $conn->query($sql);

            $conn->close();
        }

    }