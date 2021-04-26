<?php

use PHPUnit\Framework\TestCase;

/**
 * Aluno: Leonardo Kenji Dias Itako - RA: 105411
 * Teste caixa preta - Particionamento de equivalência
 * Data disponível >= Data atual
 */

class AgendaTesteCaixaPreta1 extends TestCase {
    
    /** @test */
    public function testeDataValida() {
        require_once 'C:/xampp/htdocs/Projeto-Empregadissima-main/model/Agenda.php';
        require_once 'C:/xampp/htdocs/Projeto-Empregadissima-main/DAO/AgendaDAO.php';

        $dia_agenda = new Agenda();

        $dia_agenda->setIdPrestador(14);
        $dia_agenda->setDiaDisponivel("2021-04-30");

        $agendaDAO = new AgendaDAO();

        $retorno = $agendaDAO->inserir_agenda(14, [$dia_agenda]);

        // $retorno = string -> datas anteriormente inseridas
        // $retorno = lista -> lista[0] : datas anteriormente inseridas; lista[1] : datas inseridas
        // $retorno = 1 -> datas inseridas
        // $retorno = 0 -> datas invalidas
        $this->assertEquals(1, $retorno);
    }
}

?>