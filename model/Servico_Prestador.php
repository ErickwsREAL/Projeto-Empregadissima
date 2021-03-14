<?php
    class Servico_Prestador{
      
      /*
      * Classe Servico_Prestador, Envia informações da entidade Servico_Prestador para a Classe Servico_PrestadorDAO (perfil)
      */ 

      protected $id_diaria;
      protected $id_pessoa;
      protected $desc_servico;
      protected $preco_servico;

      public function getIdDiaria() {
        return $this->id_diaria;
      }

      public function setIdDiaria($id_diaria) {
        $this->id_diaria = $id_diaria;
      }

      public function getIdPessoa() {
        return $this->id_pessoa;
      }

      public function setIdPessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
      }

      public function getDescServico() {
        return $this->desc_servico;
      }

      public function setDescServico($desc_servico) {
        $this->desc_servico = $desc_servico;
      }

      public function getPrecoServico() {
        return $this->preco_servico;
      }

      public function setPrecoServico($preco_servico) {
        $this->preco_servico = $preco_servico;
      }

    }

?>