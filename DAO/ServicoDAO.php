<?php
    class ServicoDAO{    

        public function fazerCheckinDAO($id_servico, $tipo_pessoa){//ERICK
          include ("../controller/login_control/logar_bd_empregadissimas.php");

          if ($tipo_pessoa == 1) {
            
            $sqlP = "SELECT check_inC FROM servico WHERE id_servico = '$id_servico'";

            $resultadoP = $conn->query($sqlP);
            $rowP = $resultadoP->fetch_assoc();
            

            if ($rowP["check_inC"] == 0) {
              
              $sql = "UPDATE servico SET check_inP = 1 WHERE id_servico = '$id_servico'";   
            
              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return false;
              }
              
              $conn->close();

              return true;

            }else {

              $sql = "UPDATE servico SET check_inP = 1, status_servico = 3 WHERE id_servico = '$id_servico'";

              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return false;
              }
              
              $conn->close();

              return true;
            }
           
          }


          if ($tipo_pessoa == 2) {
            
            $sqlC = "SELECT check_inP FROM servico WHERE id_servico = '$id_servico'";

            $resultadoC = $conn->query($sqlC);
            $rowC = $resultadoC->fetch_assoc();
            

            if ($rowC["check_inP"] == 0) {
              
              $sql = "UPDATE servico SET check_inC = 1 WHERE id_servico = '$id_servico'";   
            
              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return false;
              }
              
              $conn->close();

              return true;

            }else {

              $sql = "UPDATE servico SET check_inC = 1, status_servico = 3 WHERE id_servico = '$id_servico'";

              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return false;
              }
              
              $conn->close();

              return true;
            }
           
          }

        }

        public function cancelarCheckin_out($id_servico){//ERICK
          include ("../controller/login_control/logar_bd_empregadissimas.php");
             
          $sql = "UPDATE servico SET status_servico = 5 WHERE id_servico = '$id_servico'";

          $checkB = $conn->query($sql);

          if ($checkB == false) {
                
            $conn->close();
                
            return false;
          }
              
          $conn->close();

          return true;
        
        }

        public function fazerCheckoutDAO($id_servico, $tipo_pessoa){//ERICK
          include ("../controller/login_control/logar_bd_empregadissimas.php");

          if ($tipo_pessoa == 1) {
            
            $sqlP = "SELECT check_outC FROM servico WHERE id_servico = '$id_servico'";

            $resultadoP = $conn->query($sqlP);
            $rowP = $resultadoP->fetch_assoc();
            
            
            if ($rowP["check_outC"] == 0) {
              
              $sql = "UPDATE servico SET check_outP = 1 WHERE id_servico = '$id_servico'";   
            
              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return "false";
              }
              
              $conn->close();

              return "1";

            }
            if ($rowP["check_outC"] == 1) {

              $sql = "UPDATE servico SET check_outP = 1, status_servico = 4 WHERE id_servico = '$id_servico'";

              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return "false";
              }
              
              $conn->close();

              return "2";
            }
           
          }


          if ($tipo_pessoa == 2) {
            
            $sqlC = "SELECT check_outP FROM servico WHERE id_servico = '$id_servico'";

            $resultadoC = $conn->query($sqlC);
            $rowC = $resultadoC->fetch_assoc();

            if ($rowC["check_outP"] == 0) {
              
              $sql = "UPDATE servico SET check_outC = 1 WHERE id_servico = '$id_servico'";   
            
              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return "false";
              }
              
              $conn->close();

              return "1";

            }
            
            if ($rowC["check_outP"] == 1) {
            
              $sql = "UPDATE servico SET check_outC = 1, status_servico = 4 WHERE id_servico = '$id_servico'";

              $checkB = $conn->query($sql);

              if ($checkB == false) {
                $conn->close();
                
                return "false";
              }
              
              $conn->close();

              return "2";
            }
           
          }

        }

//--------------------------------------------------------------------------------------------------------
        public function buscarServicos($id_pessoa, $status, $tipo){
          include ("../controller/login_control/logar_bd_empregadissimas.php");
    
          $rows = array();
          $idPessoa = $id_pessoa;

          switch ($tipo) {
            case "C":
              $sql = "SELECT * FROM servico WHERE id_contratante = $idPessoa AND status_servico = $status"; 
              break;
            case "P":
              $sql = "SELECT * FROM servico WHERE id_prestador = $idPessoa AND status_servico = $status";  
              break;
          }

          $resultado = $conn->query($sql);

          while($row = $resultado->fetch_assoc()){
            $rows[] = $row;
          }	      
          
          $conn->close();
          return $rows;
        }

        public static function insertServico(Servico $dadosServico){
           include ("../controller/login_control/logar_bd_empregadissimas.php");

           $data_servico = date($dadosServico->getDataServico());
           $hoje = date('Y/m/d');

            //validação variaveis nulas 
          if ($dadosServico->getHoraEntrada() == null || $data_servico == null || $dadosServico->getHoraSaida() == null || 
               $dadosServico->getIdEndereco() == null || $dadosServico->getIdDiaria() == null){
            return $check = 2;

            //validação hora entrada
          } else if(($dadosServico->getHoraEntrada() >= $dadosServico->getHoraSaida()) || ($dadosServico->getHoraEntrada() < date("05:00:00"))){
              return $check = 2;

            //validação hora saida
          } else if ($dadosServico->getHoraSaida() > date("00:00:00") && $dadosServico->getHoraSaida() < date("05:00:00")){
            return $check = 2;
            
            //validação data serviço
          }else if($data_servico < $hoje){
            return $check = 2;
          }
          else{
            $sql = "INSERT  servico (data_servico, id_endereco, forma_pagamento, status_servico, id_prestador, id_contratante, id_diaria, hora_entrada, hora_saida) 
            SELECT  STR_TO_DATE('$data_servico', '%Y/%m/%d'),'{$dadosServico->getIdEndereco()}', '{$dadosServico->getFormaPagamento()}', '1', '{$dadosServico->getIdPrestador()}', '{$dadosServico->getIdContratante()}', '{$dadosServico->getIdDiaria()}', '{$dadosServico->getHoraEntrada()}', '{$dadosServico->getHoraSaida()}'
            WHERE NOT EXISTS 
                  ( SELECT  1
                    FROM  servico 
                    WHERE id_prestador = '{$dadosServico->getIdPrestador()}'      AND 
                          id_contratante = '{$dadosServico->getIdContratante()}'  AND 
                          hora_entrada = '{$dadosServico->getHoraEntrada()}'      AND 
                          hora_saida = '{$dadosServico->getHoraSaida()}'          AND 
                          data_servico = STR_TO_DATE('$data_servico', '%Y/%m/%d') 
                  )";

            $conn->query($sql);

            if ($conn->query($sql) === TRUE) {
              //echo "New record created successfully";
              $conn->close();
              return $check = 1;
            } else {
              //echo "Error: " . $sql . "<br>" . $conn->error;
              $conn->close();
              return $check = 3;
            }
          }
        }

        public static function update(Servico $dadosServico, $id_servico){
          include ("../controller/login_control/logar_bd_empregadissimas.php");

          $data_servico = $dadosServico->getDataServico(); 
          $id_endereco = $dadosServico->getIdEndereco();
          $forma_pagamento = $dadosServico->getFormaPagamento();
          $id_diaria = $dadosServico->getIdDiaria();
          $hora_entrada = $dadosServico->getHoraEntrada();
          $hora_saida = $dadosServico->getHoraSaida();

          $sql = "UPDATE servico SET data_servico= '$data_servico', id_endereco= $id_endereco, forma_pagamento= $forma_pagamento, id_diaria=$id_diaria, hora_entrada='$hora_entrada', hora_saida='$hora_saida' WHERE id_servico= $id_servico";

          $conn->query($sql);

          $conn->close();
      }

        public static function aprovaServico($dadosServico, $id_servico){
          include("../controller/login_control/logar_bd_empregadissimas.php");

          $sql = "UPDATE servico SET status_servico = '2' WHERE (id_servico = '$id_servico')";

          $conn->query($sql);
            
            if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }

        public static function deletaServico($id_servico){
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

        public static function reprovaServico($id_servico){
          include("../controller/login_control/logar_bd_empregadissimas.php");

          $sql = "UPDATE servico SET status_servico = 5 WHERE id_servico = '$id_servico'";
          
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

            $sql = "SELECT data_servico, id_endereco, forma_pagamento, id_diaria, hora_entrada, hora_saida FROM servico WHERE id_servico='$id_servico'";

            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            $dados = array(
                'data_servico' => $row["data_servico"],
                'id_endereco' => $row["id_endereco"],
                'forma_pagamento' => $row["forma_pagamento"],
                'id_diaria' => $row["id_diaria"],
                'hora_entrada' => $row["hora_entrada"],
                'hora_saida' => $row["hora_saida"]
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

        public static function select_id_prestador($id_servico){
          include ("../controller/login_control/logar_bd_empregadissimas.php");

          $sql = "SELECT * FROM servico WHERE id_servico='$id_servico'";

          $result = $conn->query($sql);

          $row = $result->fetch_assoc();

          $dados = array(
              'id_prestador' => $row["id_prestador"],
              'data_servico' => $row["data_servico"],
              'id_endereco' => $row["id_endereco"],
              'forma_pagamento' => $row["forma_pagamento"],
              'id_diaria' => $row["id_diaria"],
              'hora_entrada' => $row["hora_entrada"],
              'hora_saida' => $row["hora_saida"],
              'id_servico' => $row["id_servico"]         
          );
        
          $conn->close();
          
          return $dados;
      }

    }

?>