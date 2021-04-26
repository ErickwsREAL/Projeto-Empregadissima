<?php

use PHPUnit\Framework\TestCase;

/**
 * Aluno: Leonardo Kenji Dias Itako - RA: 105411
 * Teste caixa branca da funcionalidade: "Manter Agenda"
 * Caminho: 1, 2, 3, 4, 5, 6, 7, 8, 4, 5, 6, 7, 9, 10, 11, 12, 13, 4, 17, 18, 19, 20, 21, 22
 */

class AgendaTesteCaixaBranca3 extends TestCase {

    /** @test */
    public function testeInsercao() {
        $lista_agenda = ['2021-04-27', '2021-04-29'];
        $data_hoje = date("Y-m-d");
        $datas_inseridas = ['2021-04-25', '2021-04-26', '2021-04-27'];
        // $datas_inseridas = $this->selecionar_agenda($id_pessoa, "parcial");

        foreach($lista_agenda as $nova_data) {
            // $nova_data = $agenda->getDiaDisponivel();

            if ($nova_data >= $data_hoje) {
                if (in_array($nova_data, $datas_inseridas)) {
                    $datas_conflitantes[] = $nova_data;
                } else {
                    $datas_sem_conflito[] = $nova_data;
                    // $insercao = "INSERT INTO agenda (id_pessoa, dia_disponivel) VALUES ($id_pessoa, '$nova_data')";
                    // $conn->query($insercao);
                }
            } else {
                continue;
            }
        }

        // $conn->close();

        if (!empty($datas_conflitantes) && !empty($datas_sem_conflito)) {
            $conflitos = implode(", ", $datas_conflitantes);
            $inseridas = implode(", ", $datas_sem_conflito);
            $this->assertEquals(['2021-04-27', '2021-04-29'], [$conflitos, $inseridas]);
            return [$conflitos, $inseridas];
        } elseif (!empty($datas_conflitantes)) {
            $conflitos = implode(", ", $datas_conflitantes);
            return $conflitos;
        } elseif (!empty($datas_sem_conflito)) {
            $ret = 1;
            return $ret;
        } else {
            $ret = 0;
            return $ret;
        }

    }
}

?>