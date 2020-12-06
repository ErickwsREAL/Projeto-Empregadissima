<?php include ("../model/logar_bd_empregadissimas.php") ?>
<?php

    require_once '../model/Usuario.php';

    //$id_diaria = $_POST['res'];

    switch($_GET['metodo']){
        
        case 'inserir':

            Usuario::insert($_POST);

            echo '<script>alert("Cadastro feito com sucesso!, aguarde a liberação feita pelo administrador")</script>';
            echo '<script>location.href="../views/index.php"</script>';
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
        case 'aprovar_cadastro':

            if(isset($_POST['checkbox-apv-cdtros'])){
                foreach($_POST['checkbox-apv-cdtros'] as $apvid){

                    $deleteUser = "UPDATE pessoa SET status_cadastro = 2  WHERE id_pessoa =".$apvid;
                    mysqli_query($conn,$deleteUser);
                }   
            }

            //Usuario::approve($data, $_POST);
            echo '<script>alert("Cadastro atualizado com sucesso!")</script>';

            echo '<script>location.href="../views/adm-manter-cadastros.php"</script>';    
            break;            
        case 'reprovar_cadastro':

            if(isset($_POST['checkbox-apv-cdtros'])){
                foreach($_POST['checkbox-apv-cdtros'] as $apvid){

                    $deleteUser = "UPDATE pessoa SET status_cadastro = 3  WHERE id_pessoa =".$apvid;
                    mysqli_query($conn,$deleteUser);
                }   
            }

            //Usuario::approve($data, $_POST);
            echo '<script>alert("Cadastro atualizado com sucesso!")</script>';

            echo '<script>location.href="../views/adm-manter-cadastros.php"</script>';    
            break;            


        case  'excluir_cadastro':
        
            if(isset($_POST['checagem'])){
                foreach($_POST['checagem'] as $excluircad){

                    $deleteUser = "DELETE * FROM pessoa  WHERE id_pessoa =".$excluircad;
                    mysqli_query($conn,$deleteUser);
                }   
            }   
            
            echo '<script>alert("Cadastro removido com sucesso!")</script>';

            echo '<script>location.href="../views/adm-manter-cadastros.php"</script>';    

    }


?>