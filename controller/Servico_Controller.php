<?php include ("../login_control/logar_bd_empregadissimas.php") ?>
<?php

    require_once ('../model/Servico.php');
    require_once ('../DAO/ServicoDAO.php');

    //$id_diaria = $_POST['res']; 

    switch($_GET['metodo']){
        
        case 'inserir':
            $servico = new Servico();

            $servico->setIdEndereco($_POST['id_endereco']);
            $servico->setFormaPagamento($_POST['forma_pagamento']);
            $servico->setIdPrestador($_POST['id_prestador']);
            $servico->setIdContratante($_POST['id_contratante']);
            $servico->setIdDiaria($_POST['id_diaria']);
            $servico->setDataServico($_GET['data_servico']);
            
            $servicoDAO = new ServicoDAO();
            $check = $servicoDAO->insert($servico);

            //Servico::insert($_POST, $_GET['data_servico']);
            if ($check == 1) {
                echo '<script>alert("Seu cadastro não foi efetuado! Tente novamente.")</script>';
            }
            echo '<script>alert("Solicitação de Serviço enviada com sucesso!")</script>';
            echo '<script>location.href="../views/manter-solicitacao-contratante.php"</script>';
            break;
        case 'deletar':

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
            
            if ($_GET['tipo_pessoa'] == 1){
                echo '<script>location.href="../views/manter-solicitacao-contratante.php?data_servico='.$valores['data_servico'].'&id_endereco='.$valores['id_endereco'].'&forma_pagamento='.$valores['forma_pagamento'].'&id_diaria='.$valores['id_diaria'].'"</script>';
            }
            else{
                echo '<script>location.href="../views/manter-solicitacao.php?data_servico='.$valores['data_servico'].'&id_endereco='.$valores['id_endereco'].'&forma_pagamento='.$valores['forma_pagamento'].'&id_diaria='.$valores['id_diaria'].'"</script>';
            }

            break;
        case 'atualizar':

            $servico = new Servico();
            $servico->setIdEndereco($_POST['id_endereco']);
            $servico->setFormaPagamento($_POST['forma_pagamento']);
            $servico->setIdPrestador($_POST['id_prestador']);
            $servico->setIdContratante($_POST['id_contratante']);
            $servico->setIdDiaria($_GET['id_diaria']);
            $servico->setDataServico($_GET['data_servico']);

            $servicoDAO = new ServicoDAO();
            
            $servicoDAO->updateDAO($servico, $_GET);

        //    ServicoDAO::update($_GET, $_POST);
            echo '<script>alert("Serviço atualizado com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';    
            break;   
        case 'alt_status_apv':
            ServicoDAO::aprovaServico($_POST, $_GET['id_servico']);


            echo '<script>alert("Serviço aprovado com sucesso!")</script>';
            echo '<script>location.href="../views/manter-solicitacao.php"</script>';
            break;
        case 'alt_status_rep':
            ServicoDAO::reprovaServico($_POST, $_GET['id_servico']);
            
            if ($_GET['tipo_pessoa'] == 1){
                echo '<script>location.href="../views/manter-solicitacao-contratante.php"</script>';
            }
            else{
                echo '<script>location.href="../views/manter-solicitacao.php"</script>';
            }

             break; 
    }

?>