<?php

class Municipio
{

    private $id;

    private $nome;

    private $idhm;

    private $idEstado;

    private $area;

    private $densidadePopulacional;

    private $distanciaCapital;

    private $meiosTransporte;

    private $latitude;

    private $longitude;

    private $populacao;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getIdhm()
    {
        return $this->idhm;
    }

    public function setIdhm($idhm)
    {
        $this->idhm = $idhm;
    }

    public function getIdEstado()
    {
        return $this->idEstado;
    }

    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getDensidadePopulacional()
    {
        return $this->densidadePopulacional;
    }

    public function setDensidadePopulacional($densidadePopulacional)
    {
        $this->densidadePopulacional = $densidadePopulacional;
    }

    public function getDistanciaCapital()
    {
        return $this->distanciaCapital;
    }

    public function setDistanciaCapital($distanciaCapital)
    {
        $this->distanciaCapital = $distanciaCapital;
    }

    public function getMeiosTransporte()
    {
        return $this->meiosTransporte;
    }

    public function setMeiosTransporte($meiosTransporte)
    {
        $this->meiosTransporte = $meiosTransporte;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getPopulacao()
    {
        return $this->populacao;
    }

    public function setPopulacao($populacao)
    {
        $this->populacao = $populacao;
    }
}
