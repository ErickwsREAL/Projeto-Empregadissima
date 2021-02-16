<?php
    class Servico{    
        public static function insert($dadosServico, $data_servico){
           include ("../controller/login_control/logar_bd_empregadissimas.php");

           $id_endereco = $dadosServico['id_endereco'];
           $forma_pagamento = $dadosServico['forma_pagamento'];
           $id_prestador = $dadosServico['id_prestador'];
           $id_contratante = $dadosServico['id_contratante'];
           $id_diaria = $dadosServico['id_diaria'];

           $data_servico = date($data_servico);

           $sql = "INSERT INTO servico (data_servico, id_endereco, forma_pagamento, status_servico, id_prestador, id_contratante, id_diaria) VALUES (STR_TO_DATE('$data_servico', '%Y/%m/%d'),'$id_endereco', '$forma_pagamento', '1', '$id_prestador', '$id_contratante', '$id_diaria')";

           $conn->query($sql);
            
            if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        public static function aprovaServico($dadosServico, $id_servico){
          include("../controller/login_control/logar_bd_empregadissimas.php");

          echo $id_servico;

          $sql = "UPDATE servico SET status_servico = '2' WHERE (id_servico = '$id_servico')";

          $conn->query($sql);
            
            if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }

        public static function reprovaServico($dadosServico, $id_servico){
          include("../controller/login_control/logar_bd_empregadissimas.php");

          $sql = "DELETE FROM servico WHERE (id_servico = '$id_servico')";

          $conn->query($sql);
            
            if ($conn->query($sql) === TRUE) {
              echo "New record updated successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }

         public static function select($dadosGET, $id_servico){
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $sql = "SELECT data_servico, id_endereco, forma_pagamento, id_diaria FROM servico WHERE id_servico='$id_servico'";

            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            $dados = array(
                'data_servico' => $row["data_servico"],
                'id_endereco' => $row["id_endereco"],
                'forma_pagamento' => $row["forma_pagamento"],
                'id_diaria' => $row["id_diaria"]
            );

            if ($result->num_rows > 0) {
                /*output data of each row*/
              while($row = $result->fetch_assoc()) {
                echo "data_servico: " . $row["data_servico"]. " - id_endereco: " . $row["id_endereco"]. "<br>";
              }
            } else {
               echo "0 results";
            }
          
            $conn->close();
            
            return $dados;
        }
    }

?>