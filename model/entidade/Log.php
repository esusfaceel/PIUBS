<?php

class Log
{

    private $id;

    private $idTipoLog;

    private $idAlteracao;

    private $idUsuario;

    private $data;

    public function getId()
    {
        return $this->id;
    }

    public function getIdTipoLog()
    {
        return $this->idTipoLog;
    }

    public function getIdAlteracao()
    {
        return $this->idAlteracao;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdTipoLog($idTipoLog)
    {
        $this->idTipoLog = $idTipoLog;
    }

    public function setIdAlteracao($idAlteracao)
    {
        $this->idAlteracao = $idAlteracao;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
