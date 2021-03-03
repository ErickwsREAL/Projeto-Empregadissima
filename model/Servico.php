<?php
    class Servico{  

      /*
      * Classe Servico, Envia informações da entidade Servico para a Classe ServicoDAO 
      */ 

      protected $id_diaria;    
      protected $id_prestador;
      protected $id_contratante;    
      protected $id_endereco;
      protected $forma_pagamento;
      protected $data_servico;
      protected $hora_entrada;
      protected $hora_saida;

      public function getIdDiaria() {
        return $this->id_diaria;
      }

      public function setIdDiaria($id_diaria) {
        $this->id_diaria = $id_diaria;
      }

      public function getIdPrestador() {
        return $this->id_prestador;
      }

      public function setIdPrestador($id_prestador) {
        $this->id_prestador = $id_prestador;
      }

      public function getIdContratante() {
        return $this->id_contratante;
      }
      
      public function setIdContratante($id_contratante) {
        $this->id_contratante = $id_contratante;
      }

      public function getIdEndereco() {
        return $this->id_endereco;
      }

      public function setIdEndereco($id_endereco) {
          $this->id_endereco = $id_endereco;
      }
      
      public function getFormaPagamento() {
          return $this->forma_pagamento;
      }

      public function setFormaPagamento($forma_pagamento) {
          $this->forma_pagamento = $forma_pagamento;
      }

      public function getDataServico() {
        return $this->data_servico;
      }
      
      public function setDataServico($data_servico) {
        $this->data_servico = $data_servico;
      }   

      public function getHoraEntrada() {
        return $this->hora_entrada;
      }
      
      public function setHoraEntrada($hora_entrada) {
        $this->hora_entrada = $hora_entrada;
      }   

      public function getHoraSaida() {
        return $this->hora_saida;
      }   

      public function setHoraSaida($hora_saida) {
        $this->hora_saida = $hora_saida;
      }   
    }

?>