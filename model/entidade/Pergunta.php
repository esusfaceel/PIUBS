<?php

class Pergunta
{

    private $id;

    private $descricao;

    private $idTipoResposta;

    private $idUbs;

    private $ativo;
    
    private $obrigatoria;

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

    public function getIdTipoResposta()
    {
        return $this->idTipoResposta;
    }

    public function setIdTipoResposta($idTipoResposta)
    {
        $this->idTipoResposta = $idTipoResposta;
    }

    public function getIdUbs()
    {
        return $this->idUbs;
    }

    public function setIdUbs($idUbs)
    {
        $this->idUbs = $idUbs;
    }

    public function isAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
    public function isObrigatoria()
    {
        return $this->obrigatoria;
    }

    public function setObrigatoria($obrigatoria)
    {
        $this->obrigatoria = $obrigatoria;
    }
}
