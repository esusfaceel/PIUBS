<?php

class Usuario
{

    private $id;

    private $nome;

    private $cpf;

    private $rg;

    private $sexo;

    private $celular;

    private $dataNasc;

    private $email;

    private $idTitulacao;

    private $login;

    private $senha;

    private $idCargo;

    private $idIes;

    private $ativo;

    private $idAvatar;

    private $linkRecovery;

    private $dataRecovery;

    private $firstAccess;

    public function getFirstAccess()
    {
        return $this->firstAccess;
    }

    public function setFirstAccess($firstAccess)
    {
        $this->firstAccess = $firstAccess;
    }

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

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getIdTitulacao()
    {
        return $this->idTitulacao;
    }

    public function setIdTitulacao($idTitulacao)
    {
        $this->idTitulacao = $idTitulacao;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getIdCargo()
    {
        return $this->idCargo;
    }

    public function setIdCargo($idCargo)
    {
        $this->idCargo = $idCargo;
    }

    public function getIdIes()
    {
        return $this->idIes;
    }

    public function setIdIes($ies)
    {
        $this->idIes = $ies;
    }

    public function isAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    public function getLinkRecovery()
    {
        return $this->linkRecovery;
    }

    public function getDataRecovery()
    {
        return $this->dataRecovery;
    }

    public function setLinkRecovery($linkRecovery)
    {
        $this->linkRecovery = $linkRecovery;
    }

    public function setDataRecovery($dataRecovery)
    {
        $this->dataRecovery = $dataRecovery;
    }

    public function getIdAvatar()
    {
        return $this->idAvatar;
    }

    public function setIdAvatar($idAvatar)
    {
        $this->idAvatar = $idAvatar;
    }
}