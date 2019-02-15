<?php

class Empresa
{

    private $id;

    private $razaoSocial;

    private $idMunicipio;

    private $cnpj;

    private $ativo;

    private $telefone;

    private $telefone2;

    private $email;

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }

    public function isAtivo()
    {
        return $this->ativo;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getTelefone2()
    {
        return $this->telefone2;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
    }

    public function setIdMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
