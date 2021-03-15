<?php
    class ServicoPrestadorDAO{    
        public static function insert(Servico_Prestador $dadosServico){
           include ("../controller/login_control/logar_bd_empregadissimas.php");

           $desc_servico = $dadosServico->getDescServico(); 
           $preco_servico = $dadosServico->getPrecoServico();
           $id_pessoa = $dadosServico->getIdPessoa();

           $sql = "INSERT INTO diaria_prestador (descricao_diaria, valor, id_pessoa) VALUES ('$desc_servico', '$preco_servico', $id_pessoa)";
           $conn->query($sql);
            
            /*if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
            }*/

            $conn->close();
        }

         public static function select(Servico_Prestador $dadosServico){
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $id_diaria = $dadosServico->getIdDiaria();
            $sql = "SELECT descricao_diaria, valor, id_diaria FROM diaria_prestador WHERE id_diaria='$id_diaria'";

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

        public static function delete(Servico_Prestador $dadosServico){
            
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $idDiaria = $dadosServico->getIdDiaria();

            $sql = "DELETE FROM diaria_prestador WHERE id_diaria='$idDiaria'";

            $conn->query($sql);

            $conn->close();
        }

        public static function update(Servico_Prestador $dadosServico){
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $desc_servico = $dadosServico->getDescServico(); 
            $preco_servico = $dadosServico->getPrecoServico();
            $id_diaria = $dadosServico->getIdDiaria();

            $sql = "UPDATE diaria_prestador SET descricao_diaria='$desc_servico', valor='$preco_servico' WHERE id_diaria='$id_diaria'";

            $conn->query($sql);

            $conn->close();
        }

    }