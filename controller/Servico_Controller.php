<?php include ("../login_control/logar_bd_empregadissimas.php") ?>
<?php

    require_once '../model/Servico.php';
    

    //$id_diaria = $_POST['res']; 

    switch($_GET['metodo']){
        
        case 'inserir':
            Servico::insert($_POST, $_GET['data_servico']);

            echo '<script>alert("Solicitação de Serviço enviada com sucesso!")</script>';
            echo '<script>location.href="../views/manter-solicitacao-contratante.php"</script>';
            break;
        case 'deletar':

            Servico::delete($_GET['id_diaria'], $_POST);

            echo '<script>alert("Serviço deletado com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';
            break;
        case 'buscar':
            $parametros = Servico::select($_POST,$_GET['id_servico']);

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

            Servico::update($_GET, $_POST);
            echo '<script>alert("Serviço atualizado com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';    
            break;   
        case 'alt_status_apv':
            Servico::aprovaServico($_POST, $_GET['id_servico']);


            echo '<script>alert("Serviço aprovado com sucesso!")</script>';
            echo '<script>location.href="../views/manter-solicitacao.php"</script>';
            break;
        case 'alt_status_rep':
            Servico::reprovaServico($_POST, $_GET['id_servico']);

            echo '<script>alert("Serviço reprovado com sucesso!")</script>';
            echo '<script>location.href="../views/manter-solicitacao.php"</script>';
             break; 
    }

?>