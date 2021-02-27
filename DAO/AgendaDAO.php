<?php
    class AgendaDAO {
        public function __construct() {}
        public function __destruct() {}

        public static function inserir_data($id_prestador, $datas_selecionadas) {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $consulta = "SELECT * FROM agenda WHERE id_prestador = $id_prestador";
            $sql = $conn->query($consulta);

            if (isset($sql)) {
                $datas_inseridas = array();
                while($row = $sql->fetch_assoc()) {
                    $datas_inseridas[] = $row['dia_disponivel'];
                }
            } else {
                $datas_inseridas = array();
            }

            foreach($datas_selecionadas as $data) {
                if (in_array($data, $datas_inseridas)) {
                    $datas_conflitantes[] = $data;
                } else {
                    $insercao = "INSERT INTO agenda (`id_prestador`, `dia_disponivel`) VALUES ($id_prestador, '$data')";
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

        public static function modificar_data() {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

        }
        
        public static function remover_data($id_agenda) {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $consulta = "DELETE FROM agenda WHERE id = $id_agenda";
            $conn->query($consulta);

            $conn->close();

            return True;
        }

        public static function selecionar_datas($id_prestador) {
            include ("../controller/login_control/logar_bd_empregadissimas.php");

            $consulta = "SELECT * FROM agenda WHERE id_prestador = '$id_prestador'";
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
    }
?>