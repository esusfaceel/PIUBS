<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::dao('MunicipioDao');
Import::entidade('Municipio');
Import::library('Request');
Import::library('Redirect');
Import::config('Configuracao');
Import::controller('ControllerLog');

class ControllerMunicipio extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new MunicipioDao();
        }
        return $this->dao;
    }

    public function getByNome($nome)
    {
        return $this->getDao()->findByNome($nome);
    }

    public function getById($id)
    {
        return $this->getDao()->findById($id);
    }

    public function getMunicipios()
    {
        return $this->getDao()->findAll();
    }

    public function getMunicipiosByEstado($id)
    {
        return $this->getDao()->findAllByEstado($id);
    }

    public function getAll()
    {
        return $this->getDao()->findAll();
    }

    public function cadastro()
    {
        if ($this->validaPost('salvar')) {
            $log = new ControllerLog();
            $log->log(ControllerLog::CADASTRO_MUNICIPIO, $this->getDao()
                ->insert($this->montaMunicipio(null, $this->Post('municipio'), $this->Post('idmh'), $this->Post('estado'), $this->Post('area'), $this->Post('dpopulacional'), $this->Post('dcapital'), $this->Post('transp'), $this->Post('latitude'), $this->Post('longitude'), $this->Post('populacao'))));
            $this->setSession("sucesso", 'Município cadastrado com sucesso!');
            Redirect::Redirect_To_View('listMunicipio');
        }
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $this->getDao()->update($this->montaMunicipio($this->Get('id'), $this->Post('nome'), $this->Post('idmh'), $this->Post('estado'), $this->Post('area'), $this->Post('dpopulacional'), $this->Post('dcapital'), $this->Post('transp'), $this->Post('latitude'), $this->Post('longitude'), $this->Post('populacao')));

            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_MUNICIPIO, $this->Get('id'));

            $this->setSession("sucesso", 'Município alterado com sucesso!');
            Redirect::Redirect_To_View('listMunicipio');
        }
    }

    public function montaMunicipio($id, $nome, $idhm, $idEstado, $area, $densidadePopulacional, $distanciaCapital, $meiosTransporte, $latitude, $longitude, $populacao, $sigla = NULL)
    {
        $municipio = new Municipio();
        $municipio->setArea($area);
        $municipio->setDensidadePopulacional($densidadePopulacional);
        $municipio->setDistanciaCapital($distanciaCapital);
        $municipio->setId($id);
        $municipio->setNome($nome);
        $municipio->setIdEstado($idEstado);
        $municipio->setIdhm($idhm);
        $municipio->setLatitude($latitude);
        $municipio->setLongitude($longitude);
        $municipio->setMeiosTransporte($meiosTransporte);
        $municipio->setPopulacao($populacao);
        if (! $sigla)
            return $municipio;
        return array($municipio, $sigla);
    }
}
