<?php

use PHPUnit\Framework\TestCase;

/**
 * Aluno: Leonardo Kenji Dias Itako - RA: 105411
 * Teste caixa preta - Particionamento de equivalência
 * Data disponivel == NULL
 */

class AgendaTesteCaixaPreta3 extends TestCase {
    
    /** @test */
    public function testeDataNula() {
        require_once 'C:/xampp/htdocs/Projeto-Empregadissima-main/model/Agenda.php';
        require_once 'C:/xampp/htdocs/Projeto-Empregadissima-main/DAO/AgendaDAO.php';

        $dia_agenda = new Agenda();

        $dia_agenda->setIdPrestador(1);
        $dia_agenda->setDiaDisponivel(NULL);

        $agendaDAO = new AgendaDAO();

        $retorno = $agendaDAO->inserir_agenda(1, [$dia_agenda]);

        // $retorno = string -> datas anteriormente inseridas
        // $retorno = lista -> lista[0] : datas anteriormente inseridas; lista[1] : datas inseridas
        // $retorno = 1 -> datas inseridas
        echo "$retorno";
        $this->assertEquals(0, $retorno);
    }
}

?>