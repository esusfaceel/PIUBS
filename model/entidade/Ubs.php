<?php

class Ubs
{

    private $id;

    private $nome;

    private $idMunicipio;

    private $endereco;

    private $email;

    private $cep;

    private $bairro;

    private $responsavel;

    private $telefone1;

    private $telefone2;

    private $cnpj;

    private $ativo;

    public function getTelefone1()
    {
        return $this->telefone1;
    }

    public function getTelefone2()
    {
        return $this->telefone2;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }

    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
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

    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }

    public function setIdMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
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
