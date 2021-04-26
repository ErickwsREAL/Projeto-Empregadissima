<?php

use PHPUnit\Framework\TestCase;

/**
 * Aluno: Leonardo Kenji Dias Itako - RA: 105411
 * Teste caixa preta - Análise de valor limite
 */

class AgendaTesteCaixaPretaLimite extends TestCase {
    
    /** @test */
    public function testeDataNula() {
        require_once 'C:/xampp/htdocs/Projeto-Empregadissima-main/model/Agenda.php';
        require_once 'C:/xampp/htdocs/Projeto-Empregadissima-main/DAO/AgendaDAO.php';

        $dia_agenda1 = new Agenda();

        $dia_agenda1->setIdPrestador(14);
        $dia_agenda1->setDiaDisponivel("2012-04-12");

        $dia_agenda2 = new Agenda();

        $dia_agenda2->setIdPrestador(14);
        $dia_agenda2->setDiaDisponivel("2021-05-26");

        $agendaDAO = new AgendaDAO();

        $retorno = $agendaDAO->inserir_agenda(14, [$dia_agenda1, $dia_agenda2]);

        // $retorno = string -> datas anteriormente inseridas
        // $retorno = lista -> lista[0] : datas anteriormente inseridas; lista[1] : datas inseridas
        // $retorno = 1 -> datas inseridas
        // $retorno = 0 -> datas invalida
        echo "$retorno";
        $this->assertEquals(1, $retorno);
    }
}

?>