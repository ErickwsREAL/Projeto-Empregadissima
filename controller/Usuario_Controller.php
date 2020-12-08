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
            $parametros = Usuario::select($_GET['id_pessoa'], $_POST);

            $valores = array();
            $valores['descricao'] = $parametros['descricao'];
            $valores['nome'] = $parametros['nome'];
            $valores['telefone'] = $parametros['telefone'];
            $valores['foto'] = $parametros['foto'];
            $valores['tipo_pessoa'] = $parametros['tipo_pessoa'];

            if ($valores['tipo_pessoa'] == 2) {
                echo '<script>location.href="../views/perfilcontratante.php?descricao='.$valores['descricao'].'&nome='.$valores['nome'].'&telefone='.$valores['telefone'].'&foto='.$valores['foto'].'"</script>';                
            }
            else{
                echo '<script>location.href="../views/perfil.php?descricao='.$valores['descricao'].'&nome='.$valores['nome'].'&telefone='.$valores['telefone'].'&foto='.$valores['foto'].'"</script>';
            }

            break;
        case 'atualizar':

            Usuario::update($_GET, $_POST);
            echo '<script>alert("Cadastro atualizado com sucesso!")</script>';

            if ($_GET['tipo_pessoa'] == 2) {
                echo '<script>location.href="../views/perfilcontratante.php"</script>';           
            }
            else{
                echo '<script>location.href="../views/perfil.php"</script>';  
            }        

            break;    
        case 'aprovar_cadastro':

            if(isset($_POST['checkbox-apv-cdtros'])){
                foreach($_POST['checkbox-apv-cdtros'] as $apvid){

                    $altUser = "UPDATE pessoa SET status_cadastro = 2  WHERE id_pessoa =".$apvid; // 2 - cadastro aprovado
                    mysqli_query($conn,$altUser);
                }   
            }

            //Usuario::approve($data, $_POST);
            echo '<script>alert("Cadastro atualizado com sucesso!")</script>';

            echo '<script>location.href="../views/adm-manter-cadastros.php"</script>';    
            break;            
        case 'reprovar_cadastro':

            if(isset($_POST['checkbox-apv-cdtros'])){
                foreach($_POST['checkbox-apv-cdtros'] as $apvid){

                    $altUser = "UPDATE pessoa SET status_cadastro = 3  WHERE id_pessoa =".$apvid; // 3 - cadastro reprovado
                    mysqli_query($conn,$altUser);
                }   
            }

            //Usuario::approve($data, $_POST);
            echo '<script>alert("Cadastro atualizado com sucesso!")</script>';

            echo '<script>location.href="../views/adm-manter-cadastros.php"</script>';    
            break;            
    }


?>