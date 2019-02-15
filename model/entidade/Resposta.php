<?php

class Resposta
{

    private $id;

    private $idPergunta;

    private $idTipoResposta;

    private $resposta;

    private $obs;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdPergunta()
    {
        return $this->idPergunta;
    }

    public function setIdPergunta($idPergunta)
    {
        $this->idPergunta = $idPergunta;
    }

    public function getIdTipoResposta()
    {
        return $this->idTipoResposta;
    }

    public function setIdTipoResposta($idTipoResposta)
    {
        $this->idTipoResposta = $idTipoResposta;
    }

    public function getResposta()
    {
        return $this->resposta;
    }

    public function setResposta($resposta)
    {
        $this->resposta = $resposta;
    }

    public function getObs()
    {
        return $this->obs;
    }

    public function setObs($obs)
    {
        $this->obs = $obs;
    }
}
