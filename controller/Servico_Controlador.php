<?php include ("login_control/logar_bd_empregadissimas.php") ?>
<?php

    require_once ('../model/Servico.php');
    require_once ('../DAO/ServicoDAO.php');   

    

    function buscarServicosContratante($id_contratante, $status){

		$servico = new ServicoDAO();
		$rows = $servico->buscarServicos($id_contratante, $status, "C");
        
		return $rows;
	}  

    function buscarServicosPrestador($id_prestador, $status){

		$servico = new ServicoDAO();
		$rows = $servico->buscarServicos($id_prestador, $status, "P");
        
		return $rows;
	}  
    
	if (isset($_GET['metodo'])) {  
        switch($_GET['metodo']){        
            case 'inserir':
                $servico = new Servico();

                $servico->setIdEndereco($_POST['id_endereco']);
                $servico->setFormaPagamento($_POST['forma_pagamento']);
                $servico->setIdPrestador($_POST['id_prestador']);
                $servico->setIdContratante($_POST['id_contratante']);
                $servico->setIdDiaria($_POST['id_diaria']);
                $servico->setDataServico($_GET['data_servico']);
                $servico->setHoraEntrada($_POST['hora_entrada']);
                $servico->setHoraSaida($_POST['hora_saida']);

                $servicoDAO = new ServicoDAO();
                $check = $servicoDAO->insert($servico);

                if ($check == 2) {
                    echo '<script>alert("Seu cadastro não foi efetuado! Tente novamente.")</script>';
                    echo '<script>location.href="../views/manter-solicitacao-contratante.php"</script>';
                }else{
                echo '<script>alert("Solicitação de Serviço enviada com sucesso!")</script>';
                echo '<script>location.href="../views/manter-solicitacao-contratante.php"</script>';
                }
                break;
            case 'deletar':

                $servico->setID($_GET['id_diaria']);
                $servicoDAO->delete($servico);

                ServicoDAO::delete($_GET['id_diaria'], $_POST);

                echo '<script>alert("Serviço deletado com sucesso!")</script>';
                echo '<script>location.href="../views/perfil.php"</script>';
                break;
            case 'buscar':
                $parametros = ServicoDAO::select($_POST,$_GET['id_servico']);

                $valores = array();
                $valores['data_servico'] = $parametros['data_servico'];
                $valores['id_endereco'] = $parametros['id_endereco'];
                $valores['forma_pagamento'] = $parametros['forma_pagamento'];
                $valores['id_diaria'] = $parametros['id_diaria'];
                $valores['hora_entrada'] = $parametros['hora_entrada'];
                $valores['hora_saida'] = $parametros['hora_saida'];

                if ($_GET['tipo_pessoa'] == 1){
                    echo '<script>location.href="../views/manter-solicitacao-contratante.php?data_servico='.$valores['data_servico'].'&id_endereco='.$valores['id_endereco'].'&forma_pagamento='.$valores['forma_pagamento'].'&id_diaria='.$valores['id_diaria'].'&hora_entrada='.$valores['hora_entrada'].'&hora_saida='.$valores['hora_saida'].'"</script>';
                }
                else{
                    echo '<script>location.href="../views/manter-solicitacao.php?data_servico='.$valores['data_servico'].'&id_endereco='.$valores['id_endereco'].'&forma_pagamento='.$valores['forma_pagamento'].'&id_diaria='.$valores['id_diaria'].'&hora_entrada='.$valores['hora_entrada'].'&hora_saida='.$valores['hora_saida'].'"</script>';
                }

                break;
            case 'atualizar':
                $servico = new Servico();

                $servico->setDataServico($_POST['data_servico']);
                $servico->setIdEndereco($_POST['id_endereco']);
                $servico->setIdDiaria($_POST['id_diaria']);
                $servico->setHoraEntrada($_POST['hora_entrada']);
                $servico->setHoraSaida($_POST['hora_saida']);
                $servico->setFormaPagamento($_POST['forma_pagamento']);

                $servicoDAO = new ServicoDAO();
                
                $servicoDAO->update($servico, $_POST['id_servico']);

                echo '<script>alert("Serviço atualizado com sucesso!")</script>';
                echo '<script>location.href="../views/manter-solicitacao-contratante.php"</script>';    
                break;   
            case 'alt_status_apv':
                ServicoDAO::aprovaServico($_POST, $_GET['id_servico']);


                echo '<script>alert("Serviço aprovado com sucesso!")</script>';
                echo '<script>location.href="../views/manter-solicitacao.php"</script>';
                break;

            case 'alt_status_rep':
                ServicoDAO::reprovaServico($_GET['id_servico']);
                
                if ($_GET['tipo_pessoa'] == 1){
                    echo '<script>location.href="../views/manter-solicitacao-contratante.php"</script>';
                }
                else{
                    echo '<script>location.href="../views/manter-solicitacao.php"</script>';
                }
                case 'buscar_id_prestador_servico':
                    
                    $parametros = ServicoDAO::select_id_prestador($_GET['id_servico']);

                    $valores = array();
                    $valores['id_prestador'] = $parametros['id_prestador'];
                    $valores['data_servico'] = $parametros['data_servico'];
                    $valores['id_endereco'] = $parametros['id_endereco'];
                    $valores['forma_pagamento'] = $parametros['forma_pagamento'];
                    $valores['id_diaria'] = $parametros['id_diaria'];
                    $valores['hora_entrada'] = $parametros['hora_entrada'];
                    $valores['hora_saida'] = $parametros['hora_saida'];        
                    $valores['id_servico'] = $parametros['id_servico'];               
    
                    echo '<script>location.href="../views/manter-solicitacao-contratante.php?id_prestador='.$valores['id_prestador'].'&data_servico='.$valores['data_servico'].'&id_endereco='.$valores['id_endereco'].'&forma_pagamento='.$valores['forma_pagamento'].'&id_diaria='.$valores['id_diaria'].'&hora_entrada='.$valores['hora_entrada'].'&hora_saida='.$valores['hora_saida'].'&id_servico='.$valores['id_servico'].'"</script>';

                break; 
            
            
            case 'fazerCheckin_out'://ERICK      
                $tipo_pessoaCheck = $_GET['tipo_pessoaCheck'];
                $id_servicoCheck = $_GET['id_servicoCheck'];
                $servicoDAO = new ServicoDAO();

                if (isset($_POST['check-in'])) {

                    if ($_POST['check-in'] == "iniciado") {
                    
                        $checkBD = $servicoDAO->fazerCheckinDAO($id_servicoCheck, $tipo_pessoaCheck);

                        if ($tipo_pessoaCheck == 1 and $checkBD == true) {
                            
                            echo '<script>alert("Check-in foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-2"</script>';
                                
                        }

                        if ($tipo_pessoaCheck == 1 and $checkBD == false) {
                            
                            echo '<script>alert("Check-in não foi realizado com sucesso. Tente novamente.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-2"</script>';
                                                   
                        }


                        if ($tipo_pessoaCheck == 2 and $checkBD == true) {
                            
                            echo '<script>alert("Check-in foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-2"</script>';       
                           
                        }

                        if ($tipo_pessoaCheck == 2 and $checkBD == false) {
                            
                            echo '<script>alert("Check-in não foi realizado com sucesso. Tente novamente.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-2"</script>';                        
                       
                        }

                    }

                    if ($_POST['check-in'] == "cancelado") {
                       
                       $checkBD = $servicoDAO->cancelarCheckin_out($id_servicoCheck);

                       if ($tipo_pessoaCheck == 1 and $checkBD == true) {
                            
                            echo '<script>alert("Seu serviço foi cancelado.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-4"</script>';
                                
                        }

                        if ($tipo_pessoaCheck == 1 and $checkBD == false) {
                            
                            echo '<script>alert("Cancelamento do serviço não foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-2"</script>';
                                                   
                        }


                        if ($tipo_pessoaCheck == 2 and $checkBD == true) {
                            
                            echo '<script>alert("Seu serviço foi cancelado.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-4"</script>';       
                           
                        }

                        if ($tipo_pessoaCheck == 2 and $checkBD == false) {
                            
                            echo '<script>alert("Cancelamento do serviço não foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-2"</script>';                        
                       
                        }
              
                    }

                }

                 if (isset($_POST['check-out'])) {

                    if ($_POST['check-out'] == "finalizado") {
                    
                        $checkBD = $servicoDAO->fazerCheckoutDAO($id_servicoCheck, $tipo_pessoaCheck);

                        if ($tipo_pessoaCheck == 1 and $checkBD == 1) {
                            
                            echo '<script>alert("Check-out foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-2"</script>';
                                
                        }

                        if ($tipo_pessoaCheck == 1 and $checkBD == 2) {
                            
                            echo '<script>alert("Check-out foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-3"</script>';
                                
                        }

                        if ($tipo_pessoaCheck == 1 and $checkBD == false) {
                            
                            echo '<script>alert("Check-out não foi realizado com sucesso. Tente novamente.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-2"</script>';
                                                   
                        }
//---------------------------------------------------------------------------------------------------------------------------------

                        if ($tipo_pessoaCheck == 2 and $checkBD == 1) {
                            
                            echo '<script>alert("Check-out foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-2"</script>';       
                           
                        }

                        if ($tipo_pessoaCheck == 2 and $checkBD == 2) {
                            
                            echo '<script>alert("Check-out foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-3"</script>';       
                           
                        }

                        if ($tipo_pessoaCheck == 2 and $checkBD == false) {
                            
                            echo '<script>alert("Check-out não foi realizado com sucesso. Tente novamente.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-2"</script>';                        
                       
                        }

                    }

                    if ($_POST['check-out'] == "cancelado") {
                       
                       $checkBD = $servicoDAO->cancelarCheckin_out($id_servicoCheck);

                       if ($tipo_pessoaCheck == 1 and $checkBD == true) {
                            
                            echo '<script>alert("Seu serviço foi cancelado.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-4"</script>';
                                
                        }

                        if ($tipo_pessoaCheck == 1 and $checkBD == false) {
                            
                            echo '<script>alert("Cancelamento do serviço não foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao.php#tabs-2"</script>';
                                                   
                        }

                        if ($tipo_pessoaCheck == 2 and $checkBD == true) {
                            
                            echo '<script>alert("Seu serviço foi cancelado.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-4"</script>';       
                           
                        }

                        if ($tipo_pessoaCheck == 2 and $checkBD == false) {
                            
                            echo '<script>alert("Cancelamento do serviço não foi realizado com sucesso.")</script>';
                            echo '<script>location.href="../views/manter-solicitacao-contratante.php#tabs-2"</script>';                        
                       
                        }
              
                    }

                }

                break;

        }
    }
?>