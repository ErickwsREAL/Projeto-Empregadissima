<?php
    include("../DAO/AgendaDAO.php");

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

    class Agenda {
        public static function insert($id_prestador, $datas_selecionadas) {
            $datas_formatadas = formatar_datas($datas_selecionadas);
            $response = AgendaDAO::inserir_data($id_prestador, $datas_formatadas);
                
            return $response;
        }

        public static function modify() {
            echo "oi";
        }

        public static function delete($id_agenda) {
            $response = AgendaDAO::remover_data($id_agenda);

            if ($response === TRUE) {
                return "Data disponível excluída com sucesso!";
            } else {
                return "Não foi possível excluir a data selecionada!";
            }
        }

        public static function select($id_prestador) {
            $datas_disponiveis = AgendaDAO::selecionar_datas($id_prestador);

            return $datas_disponiveis;
        }
    }
?>