<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::entidade('Ubs');
Import::library('Request');
Import::library('Redirect');
Import::dao('UbsDao');
Import::config('Configuracao');
Import::controller('ControllerLog');

class ControllerUbs extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new UbsDao();
        }
        return $this->dao;
    }

    public function getById($id)
    {
        return $this->getDao()->findById($id);
    }

    public function getByNome($nome)
    {
        return $this->getDao()->findByNome($nome);
    }

    public function getAll()
    {
        return $this->getDao()->findAll();
    }

    public function getAllByIdMunicipio($id)
    {
        return $this->getDao()->findAllByIdMunicipio($id);
    }

    public function cadastro()
    {
        if ($this->validaPost('salvar')) {
            $log = new ControllerLog();
            $log->log(ControllerLog::CADASTRO_UBS, $this->getDao()
                ->insert($this->montaUbs(null, $this->Post('nome'), $this->Post('municipio'), $this->Post('end'), $this->Post('bairro'), $this->Post('cep'), null, TRUE, $this->Post('telefone1'), $this->Post('telefone2'), $this->Post('cnpj'), $this->Post('email'))));
            $this->setSession("sucesso", 'UBS cadastrada com sucesso!');
            Redirect::Redirect_To_View('listUbs');
        }
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $this->getDao()->update($this->montaUbs($this->Get('id'), $this->Post('nome'), $this->Post('municipio'), $this->Post('end'), $this->Post('bairro'), $this->Post('cep'), null, TRUE, $this->Post('telefone1'), $this->Post('telefone2'), $this->Post('cnpj'), $this->Post('email')));
            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_UBS, $this->Get('id'));

            $this->setSession("sucesso", 'UBS alterada com sucesso!');
            Redirect::Redirect_To_View('listUbs');
        }
    }

    public function montaUbs($id, $nome, $idMunicipio, $endereco, $bairro, $cep, $responsavel, $ativo, $telefone1, $telefone2, $cnpj, $email)
    {
        $ubs = new Ubs();
        $ubs->setAtivo($ativo);
        $ubs->setEndereco($endereco);
        $ubs->setBairro($bairro);
        $ubs->setCep($cep);
        $ubs->setId($id);
        $ubs->setIdMunicipio($idMunicipio);
        $ubs->setNome($nome);
        $ubs->setResponsavel($responsavel);
        $ubs->setTelefone1($telefone1);
        $ubs->setTelefone2($telefone2);
        $ubs->setCnpj($cnpj);
        $ubs->setEmail($email);

        return $ubs;
    }
}
