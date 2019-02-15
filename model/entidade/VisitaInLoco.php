<?php

class VisitaInLoco
{

    private $id;

    private $data;

    private $horario;

    private $idUbs;

    private $idUsuario;

    private $entrevistado;

    private $ativo;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario)
    {
        $this->horario = $horario;
    }

    public function getIdUbs()
    {
        return $this->idUbs;
    }

    public function setIdUbs($idUbs)
    {
        $this->idUbs = $idUbs;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getEntrevistado()
    {
        return $this->entrevistado;
    }

    public function setEntrevistado($entrevistado)
    {
        $this->entrevistado = $entrevistado;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}
