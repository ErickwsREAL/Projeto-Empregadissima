<?php include ("../model/logar_bd_empregadissimas.php") ?>
<?php

    require_once '../model/Servico_Prestador.php';

    $desc_servico = $_POST['desc_servico'];
    $preco_servico = $_POST['preco_servico'];
    $id_pessoa = $_POST['id_pessoa'];
    

    //$id_diaria = $_POST['res'];

    switch($_GET['metodo']){
        
        case 'inserir':
            Servico_Prestador::insert($_POST);

            echo '<script>alert("Serviço inserido com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';
            break;
        case 'deletar':

            Servico_Prestador::delete($_GET['id_diaria'], $_POST);

            echo '<script>alert("Serviço deletado com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';
            break;
        case 'buscar':
            $parametros = Servico_Prestador::select($_GET['id_diaria'], $_POST);

            $valores = array();
            $valores['desc_servico'] = $parametros['desc_servico'];
            $valores['preco_servico'] = $parametros['preco_servico'];
            $valores['id_diaria'] = $parametros['id_diaria'];

            echo '<script>location.href="../views/perfil.php?desc_servico='.$valores['desc_servico'].'&preco_servico='.$valores['preco_servico'].'&id_diaria='.$valores['id_diaria'].'"</script>';
            break;
        case 'atualizar':

            Servico_Prestador::update($_GET, $_POST);
            echo '<script>alert("Serviço atualizado com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';    
            break;            
    }

?>