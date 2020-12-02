<?php include ("../model/logar_bd_empregadissimas.php") ?>
<?php

    require_once '../model/Usuario.php';

    //$id_diaria = $_POST['res'];

    switch($_GET['metodo']){
        
        case 'inserir':

            Usuario::insert($_POST);

            echo '<script>alert("Cadastro feito com sucesso!, aguarde a liberação feita pelo administrador")</script>';
            echo '<script>location.href="../views/index.html"</script>';
            break;
        case 'deletar':

            Usuario::delete($_GET['id_diaria'], $_POST);

            echo '<script>alert("Cadastro deletado com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';
            break;
        case 'buscar':

            $parametros = Usuario::select($_GET['id_diaria'], $_POST);

            $valores = array();
            $valores['desc_servico'] = $parametros['desc_servico'];
            $valores['preco_servico'] = $parametros['preco_servico'];
            $valores['id_diaria'] = $parametros['id_diaria'];

            echo '<script>location.href="../views/perfil.php?desc_servico='.$valores['desc_servico'].'&preco_servico='.$valores['preco_servico'].'&id_diaria='.$valores['id_diaria'].'"</script>';
            break;
        case 'atualizar':

            Usuario::update($_GET, $_POST);
            echo '<script>alert("Cadastro atualizado com sucesso!")</script>';
            echo '<script>location.href="../views/perfil.php"</script>';    
            break;            
    }

?>