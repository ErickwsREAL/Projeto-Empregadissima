<?php
    include_once ("../model/Agenda.php");
    include_once ("../DAO/AgendaDAO.php");

    function formatar_datas($datas_selecionadas) {
        $results = array();
        $datas_invalidas = array();
        $data_atual = date('Y-m-d');
        $lista_datas = explode(" ", $datas_selecionadas);

        foreach($lista_datas as $data) {
            $data_formatada = date('Y-m-d', strtotime($data));
            if ($data_formatada >= $data_atual) {
                $results[] = $data_formatada;
            } else {
                $datas_invalidas[] = $data_formatada;
            }
        }

        if (isset($results)) {
            return [$results, $datas_invalidas];
        } else {
            return False;
        }
    }

    function carregar_agenda($id_pessoa) {
        $datas_disponiveis = AgendaDAO::selecionar_agenda($id_pessoa, "total");

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
                if (empty($_POST['datas_selecionadas'])) {
                    echo '<script> alert("Nenhuma data selecionada!")</script>';
                    echo '<script>location.href="../views/visao-prestador.php"</script>';
                } else {
                    $datas_formatadas = formatar_datas($_POST['datas_selecionadas']);

                    $datas_validas = $datas_formatadas[0];
                    $datas_invalidas = $datas_formatadas[1];
                    
                    if (!empty($datas_invalidas)) {
                        $datas_invalidas = implode(", ", $datas_invalidas);
                        echo '<script> alert("Data(s) invalida(s): '.$datas_invalidas.'")</script>';
                    }

                    if (!empty($datas_validas)) {
                        foreach($datas_validas as $data) {
                            $agenda = new Agenda();

                            $agenda->setIdPrestador($_GET['id_pessoa']);
                            $agenda->setDiaDisponivel($data);
                            $lista_agenda[] = $agenda;
                        }

                        $r = $agenda_dao->inserir_agenda($_GET['id_pessoa'], $lista_agenda);

                        if (is_string($r)) {
                            echo '<script> alert("As datas informadas já haviam sido inseridas: '.$r.'")</script>';
                        } elseif (is_array($r)) {
                            echo '<script> alert("As datas informadas já haviam sido inseridas: '.$r[0].'")</script>';
                            echo '<script> alert("Dias '.$r[1].' inseridos com sucesso!")</script>';
                        } elseif ($r == 1) {
                            echo '<script> alert("Dias inseridos com sucesso!")</script>';
                        } else {
                            echo '<script> alert("As datas informadas são invalidas!")</script>';
                        }
                    }
                    echo '<script>location.href="../views/visao-prestador.php"</script>';
                }
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