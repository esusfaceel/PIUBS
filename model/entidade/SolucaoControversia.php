<?php

class SolucaoControversia
{

    private $id;

    private $requerenteUbs;

    private $requerenteEmpresa;

    private $requeridoUbs;

    private $requeridoEmpresa;

    private $requerenteDescricao;

    private $requerenteArgumentacao;

    private $requeridoArgumentacao;

    private $avaliacaoDescricao;

    private $status;

    private $data;

    private $horario;

    private $ativo;

    private $idUsuario;

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setHorario($horario)
    {
        $this->horario = $horario;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRequerenteUbs()
    {
        return $this->requerenteUbs;
    }

    public function getRequerenteEmpresa()
    {
        return $this->requerenteEmpresa;
    }

    public function getRequeridoUbs()
    {
        return $this->requeridoUbs;
    }

    public function getRequeridoEmpresa()
    {
        return $this->requeridoEmpresa;
    }

    public function getRequerenteDescricao()
    {
        return $this->requerenteDescricao;
    }

    public function getRequerenteArgumentacao()
    {
        return $this->requerenteArgumentacao;
    }

    public function getRequeridoArgumentacao()
    {
        return $this->requeridoArgumentacao;
    }

    public function getAvaliacaoDescricao()
    {
        return $this->avaliacaoDescricao;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRequerenteUbs($requerenteUbs)
    {
        $this->requerenteUbs = $requerenteUbs;
    }

    public function setRequerenteEmpresa($requerenteEmpresa)
    {
        $this->requerenteEmpresa = $requerenteEmpresa;
    }

    public function setRequeridoUbs($requeridoUbs)
    {
        $this->requeridoUbs = $requeridoUbs;
    }

    public function setRequeridoEmpresa($requeridoEmpresa)
    {
        $this->requeridoEmpresa = $requeridoEmpresa;
    }

    public function setRequerenteDescricao($requerenteDescricao)
    {
        $this->requerenteDescricao = $requerenteDescricao;
    }

    public function setRequerenteArgumentacao($requerenteArgumentacao)
    {
        $this->requerenteArgumentacao = $requerenteArgumentacao;
    }

    public function setRequeridoArgumentacao($requeridoArgumentacao)
    {
        $this->requeridoArgumentacao = $requeridoArgumentacao;
    }

    public function setAvaliacaoDescricao($avaliacaoDescricao)
    {
        $this->avaliacaoDescricao = $avaliacaoDescricao;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}
