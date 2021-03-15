<?php
    include_once ("../model/Agenda.php");

    class AgendaDAO {
        public function __construct() {}
        public function __destruct() {}

        public static function selecionar_data($id) {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $consulta = "SELECT * FROM agenda WHERE id = $id";
            $response = $conn->query($consulta);

            if (isset($response)) {
                $row = $response->fetch_assoc();

                $agenda = new Agenda();
                $agenda->setId($row['id']);
                $agenda->setIdPrestador($row['id_pessoa']);
                $agenda->setDiaDisponivel($row['dia_disponivel']);

                return $agenda;
            } else {
                echo "Error while querying";
            }
        }

        public static function selecionar_agenda($id_pessoa) {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $consulta = "SELECT * FROM agenda WHERE id_pessoa = '$id_pessoa' ORDER BY dia_disponivel ASC";
            $sql = $conn->query($consulta);

            if (isset($sql)) {
                $conn->close();
                $response = array();
                while ($row = $sql->fetch_assoc()) {
                    $response[] = $row;
                }
                return $response;
            }
        }

        function inserir_agenda($id_pessoa, $lista_agenda) {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $consulta = "SELECT * FROM agenda WHERE id_pessoa = $id_pessoa";
            $sql = $conn->query($consulta);

            if (isset($sql)) {
                $datas_inseridas = array();
                while($row = $sql->fetch_assoc()) {
                    $datas_inseridas[] = $row['dia_disponivel'];
                }
            } else {
                $datas_inseridas = array();
            }
            
            foreach($lista_agenda as $agenda) {
                $nova_data = $agenda->getDiaDisponivel();

                if (in_array($nova_data, $datas_inseridas)) {
                    $datas_conflitantes[] = $nova_data;
                } else {
                    $insercao = "INSERT INTO agenda (id_pessoa, dia_disponivel) VALUES ($id_pessoa, '$nova_data')";
                    $conn->query($insercao);
                }
            }

            $conn->close();

            if (!empty($datas_conflitantes)) {
                $datas = implode(", ", $datas_conflitantes);
                return "As datas informadas já haviam sido inseridas: $datas";
            } else {
                return "Dias disponíveis inseridos com sucesso!";
            }
        }
        
        function remover_data(Agenda $agenda) {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $agenda_id = $agenda->getId();

            $consulta = "DELETE FROM agenda WHERE id = '$agenda_id'";
            $sql = $conn->query($consulta);

            $conn->close();

            if (isset($sql)) {
                return "Data excluída com sucesso!";
            } else {
                return "Houve algum erro na exclusão dessa data";
            }
        }

    }
?>