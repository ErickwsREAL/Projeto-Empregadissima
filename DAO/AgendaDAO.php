<?php
    include_once ("C:/xampp/htdocs/Projeto-Empregadissima-main/model/Agenda.php");

    class AgendaDAO {
        public function __construct() {}
        public function __destruct() {}

        public static function selecionar_data($id) {
            include ("C:/xampp/htdocs/Projeto-Empregadissima-main/controller/login_control/logar_bd_empregadissimas.php");

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

        public static function selecionar_agenda($id_pessoa, $escolha) {
            include ("C:/xampp/htdocs/Projeto-Empregadissima-main/controller/login_control/logar_bd_empregadissimas.php");

            $consulta = "SELECT * FROM agenda WHERE id_pessoa = '$id_pessoa' ORDER BY dia_disponivel ASC";
            $sql = $conn->query($consulta);

            if (isset($sql)) {
                $conn->close();
                $response = array();
                if ($escolha == "total") {
                    while ($row = $sql->fetch_assoc()) {
                        $response[] = $row;
                    }
                } elseif ($escolha == "parcial") {
                    while($row = $sql->fetch_assoc()) {
                        $response[] = $row['dia_disponivel'];
                    }
                } else {
                    return 0;
                }
                return $response;
            }
        }

        function inserir_agenda($id_pessoa, $lista_agenda) {
            include ("C:/xampp/htdocs/Projeto-Empregadissima-main/controller/login_control/logar_bd_empregadissimas.php");

            $datas_inseridas = array();
            $data_hoje = date("Y-m-d");
            $datas_inseridas = $this->selecionar_agenda($id_pessoa, "parcial");

            foreach($lista_agenda as $agenda) {
                $nova_data = $agenda->getDiaDisponivel();

                if ($nova_data >= $data_hoje) {
                    if (in_array($nova_data, $datas_inseridas)) {
                        $datas_conflitantes[] = $nova_data;
                    } else {
                        $datas_sem_conflito[] = $nova_data;
                        $insercao = "INSERT INTO agenda (id_pessoa, dia_disponivel) VALUES ($id_pessoa, '$nova_data')";
                        $conn->query($insercao);
                    }
                } else {
                    continue;
                }
            }

            $conn->close();

            if (!empty($datas_conflitantes) and !empty($datas_sem_conflito)) {
                $conflitos = implode(", ", $datas_conflitantes);
                $inseridas = implode(", ", $datas_sem_conflito);
                return [$conflitos, $inseridas];
            } elseif (!empty($datas_conflitantes)) {
                $conflitos = implode(", ", $datas_conflitantes);
                return $conflitos;
            } elseif (!empty($datas_sem_conflito)) {
                return 1;
            } else {
                return 0;
            }
        }
        
        function remover_data(Agenda $agenda) {
            include ("C:/xampp/htdocs/Projeto-Empregadissima-main/controller/login_control/logar_bd_empregadissimas.php");

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