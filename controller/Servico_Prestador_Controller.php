<?php include ("login_control/logar_bd_empregadissimas.php") ?>
<?php

    require_once ('../model/Servico_Prestador.php');
    require_once ('../DAO/ServicoPrestadorDAO.php');

	function buscarDiarias($id_prestador){

		$servico_prestador = new ServicoPrestadorDAO();
		$rows = $servico_prestador->buscarDiarias($id_prestador);
        
		return $rows;
	}  
 
    if (isset($_GET['metodo'])) {


        $desc_servico = $_POST['desc_servico'];
        $preco_servico = $_POST['preco_servico'];
        $id_pessoa = $_POST['id_pessoa'];

        switch($_GET['metodo']){
            
            case 'inserir':
                $servico_prestador = new Servico_Prestador();

                $servico_prestador->setIdPessoa($_POST['id_pessoa']);
                $servico_prestador->setDescServico($_POST['desc_servico']);
                $servico_prestador->setPrecoServico($_POST['preco_servico']);

                $servico_prestadorDAO = new ServicoPrestadorDAO();
                $check = $servico_prestadorDAO->insert($servico_prestador);

                echo '<script>alert("Serviço inserido com sucesso!")</script>';
                echo '<script>location.href="../views/perfil.php"</script>';

                break;
            case 'deletar':

                $servico_prestador = new Servico_Prestador();
                $servico_prestador->setIdDiaria($_GET['id_diaria']);

                $servico_prestadorDAO = new ServicoPrestadorDAO();
                $servico_prestadorDAO->delete($servico_prestador);

                echo '<script>alert("Serviço deletado com sucesso!")</script>';
                echo '<script>location.href="../views/perfil.php"</script>';
                
                break;
            case 'buscar':

                $servico_prestador = new Servico_Prestador();
                $servico_prestador->setIdDiaria($_GET['id_diaria']);

                $servico_prestadorDAO = new ServicoPrestadorDAO();
                $parametros = $servico_prestadorDAO->select($servico_prestador);

                $valores = array();
                $valores['desc_servico'] = $parametros['desc_servico'];
                $valores['preco_servico'] = $parametros['preco_servico'];
                $valores['id_diaria'] = $parametros['id_diaria'];

                echo '<script>location.href="../views/perfil.php?desc_servico='.$valores['desc_servico'].'&preco_servico='.$valores['preco_servico'].'&id_diaria='.$valores['id_diaria'].'"</script>';
                break;
            case 'atualizar':

                $servico_prestador = new Servico_Prestador();
                $servico_prestador->setIdDiaria($_GET['id_diaria']);
                $servico_prestador->setDescServico($_POST['desc_servico']);
                $servico_prestador->setPrecoServico($_POST['preco_servico']);

                $servico_prestadorDAO = new ServicoPrestadorDAO();
                $servico_prestadorDAO->update($servico_prestador);

                echo '<script>alert("Serviço atualizado com sucesso!")</script>';
                echo '<script>location.href="../views/perfil.php"</script>';    
                break;            
        }
    }
?>