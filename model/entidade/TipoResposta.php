<?php

class TipoResposta
{
    const PARAGRAFO = 1;

    const SIM_NAO = 2;
    
    const SIM_NAO_TALVEZ = 3;
    
    const EXCELENTE_BOM_REGULAR_PESSIMO = 4;

    private $id;

    private $descricao;

    private $ativo;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function isAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}
