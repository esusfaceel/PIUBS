<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::entidade('Ies');
Import::library('Request');
Import::library('Redirect');
Import::dao('IesDao');
Import::config('Configuracao');
Import::controller('ControllerLog');

class ControllerIes extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new IesDao();
        }
        return $this->dao;
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $this->getDao()->update($this->montaIes($this->Get('id'), $this->Post('razao'), $this->Post('municipio'), $this->Post('sigla'), $this->Post('telefone'), $this->Post('email'), TRUE));

            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_IES, $this->Get('id'));

            $this->setSession("sucesso", 'IES alterada com sucesso!');
            Redirect::Redirect_To_View('listIes');
        }
    }

    public function cadastro()
    {
        if ($this->validaPost('salvar')) {
            $log = new ControllerLog();
            $log->log(ControllerLog::CADASTRO_IES, $this->getDao()
                ->insert($this->montaIes(null, $this->Post('razao'), $this->Post('municipio'), $this->Post('sigla'), $this->Post('telefone'), $this->Post('email'), TRUE)));

            $this->setSession("sucesso", 'IES cadastrada com sucesso!');
            Redirect::Redirect_To_View('listIes');
        }
    }

    public function getAll()
    {
        return $this->getDao()->findAll();
    }

    public function getBySigla($sigla)
    {
        return $this->getDao()->findBySigla($sigla);
    }

    public function getById($id)
    {
        return $this->getDao()->findById($id);
    }

    public function montaIes($id, $razaoSocial, $idMunicipio, $sigla, $telefone, $email, $ativo)
    {
        $ies = new Ies();
        $ies->setId($id);
        $ies->setRazaoSocial($razaoSocial);
        $ies->setIdMunicipio($idMunicipio);
        $ies->setSigla($sigla);
        $ies->setTelefone($telefone);
        $ies->setEmail($email);
        $ies->setAtivo($ativo);

        return $ies;
    }
}
