<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::entidade('Empresa');
Import::library('Request');
Import::library('Redirect');
Import::dao('EmpresaDao');
Import::config('Configuracao');
Import::controller('ControllerLog');

class ControllerEmpresa extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new EmpresaDao();
        }
        return $this->dao;
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $this->getDao()->update($this->montaEmpresa($this->Get('id'), $this->Post('razao'), $this->Post('municipio'), $this->Post('telefone2'), $this->Post('telefone'), $this->Post('email'), $this->Post('cnpj'), TRUE));

            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_EMPRESA, $this->Get('id'));

            $this->setSession("sucesso", 'Empresa alterada com sucesso!');
            Redirect::Redirect_To_View('listEmpresa');
        }
    }

    public function cadastro()
    {
        if ($this->validaPost('salvar')) {
            $log = new ControllerLog();
            $log->log(ControllerLog::CADASTRO_EMPRESA, $this->getDao()
                ->insert($this->montaEmpresa(null, $this->Post('razao'), $this->Post('municipio'), $this->Post('telefone2'), $this->Post('telefone'), $this->Post('email'), $this->Post('cnpj'), TRUE)));

            $this->setSession("sucesso", 'Empresa cadastrada com sucesso!');
            Redirect::Redirect_To_View('listEmpresa');
        }
    }

    public function getAll()
    {
        return $this->getDao()->findAll();
    }

    public function getById($id)
    {
        return $this->getDao()->findById($id);
    }

    public function getByIdMunicipio($id)
    {
        return $this->getDao()->findAllByMunicipio($id);
    }

    public function montaEmpresa($id, $razaoSocial, $idMunicipio, $telefone2, $telefone, $email, $cnpj, $ativo)
    {
        $empresa = new Empresa();
        $empresa->setId($id);
        $empresa->setRazaoSocial($razaoSocial);
        $empresa->setIdMunicipio($idMunicipio);
        $empresa->setTelefone2($telefone2);
        $empresa->setTelefone($telefone);
        $empresa->setEmail($email);
        $empresa->setCnpj($cnpj);
        $empresa->setAtivo($ativo);

        return $empresa;
    }
}
