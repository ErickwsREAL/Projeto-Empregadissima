<?php
    include_once ("../model/Agenda.php");
    include_once ("../DAO/AgendaDAO.php");

    function formatar_datas($datas_selecionadas) {
        $results = array();
        $lista_datas = explode(" ", $datas_selecionadas);

        foreach($lista_datas as $data) {
            $results[] = date('Y-m-d', strtotime($data));
        }

        if (isset($results)) {
            return $results;
        } else {
            return False;
        }
    }

    function carregar_agenda($id_pessoa) {
        $datas_disponiveis = AgendaDAO::selecionar_agenda($id_pessoa);

        if (!empty($datas_disponiveis)) {
            foreach($datas_disponiveis as $data) {
                $agenda = AgendaDAO::selecionar_data($data['id']);

                $response[] = $agenda;
            }

            return $response;
        } else {
            return array();
        }
    }

    if (isset($_GET['metodo'])) {
        $agenda_dao = new AgendaDAO();

        switch($_GET['metodo']) {
            case 'inserir_agenda':
                foreach(formatar_datas($_POST['datas_selecionadas']) as $data) {
                    $agenda = new Agenda();

                    $agenda->setIdPrestador($_GET['id_pessoa']);
                    $agenda->setDiaDisponivel($data);
                    $lista_agenda[] = $agenda;
                }

                $r = $agenda_dao->inserir_agenda($_GET['id_pessoa'], $lista_agenda);

                echo '<script> alert("'.$r.'")</script>';
                echo '<script>location.href="../views/visao-prestador.php"</script>';
                break;
            case 'excluir_data':
                $agenda = $agenda_dao->selecionar_data($_GET['id_agenda']);
                $r = $agenda_dao->remover_data($agenda);

                unset($agenda);

                echo '<script> alert("'.$r.'")</script>';
                echo '<script>location.href="../views/visao-prestador.php"</script>';
                break;            
            default:
                echo '<script> alert("Método desconhecido!") </script>';
                break;
        }

        unset($agenda_dao);
    }

?>