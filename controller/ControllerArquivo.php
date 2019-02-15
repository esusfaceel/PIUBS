<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('Request');
Import::dao('ArquivoDao');
Import::library('Redirect');

class ControllerArquivo
{

    private $dao;

    const REQUERIDO = 1;

    const REQUIRENTE = 2;

    const AVALIACAO = 3;

    private function getDao()
    {
        if ($this->dao == null)
            $this->dao = new ArquivoDao();
        return $this->dao;
    }

    public function insertVisita($nome, $idVisita)
    {
        $arquivo = Request::File($nome);
        for ($i = 0; $i < count($arquivo['name']); $i ++) {
            $idArquivo = $this->getDao()->insertArquivo($arquivo['name'][$i], $arquivo['tmp_name'][$i]);
            $this->getDao()->insertArquivoRelatorioVisita($idArquivo, $idVisita);
        }
    }

    public function insertSolucao($nome, $idSolucao, $tipoSolucao)
    {
        $arquivo = Request::File($nome);
        for ($i = 0; $i < count($arquivo['name']); $i ++) {
            $idArquivo = $this->getDao()->insertArquivo($arquivo['name'][$i], $arquivo['tmp_name'][$i]);
            $this->getDao()->insertArquivoRelatorioSolucao($idArquivo, $idSolucao, $tipoSolucao);
        }
    }

    public function tiposPermitidos($nome)
    {
        $arquivo = Request::File($nome);
        for ($i = 0; $i < count($arquivo['name']); $i ++) {
            $tipo = substr($arquivo['name'][$i], strrpos($arquivo['name'][$i], '.'));
            if ($tipo != ".png" && $tipo != ".jpg" && $tipo != ".jpeg" && $tipo != ".pdf" && $tipo != ".zip" && $tipo != ".rar")
                return false;
        }
        return true;
    }

    public function getByIdVisita($id)
    {
        return $this->getDao()->selectAllByIdVisita($id);
    }

    public function getByIdSolucao($id, $tipoSolucao)
    {
        return $this->getDao()->selectAllByIdSolucao($id, $tipoSolucao);
    }

    public function deleteVisita()
    {
        if (Request::validaPost('del')) {
            $this->getDao()->deletetRelatorioById(Request::Get('idFile'));
            $this->getDao()->deletetById(Request::Get('idFile'));
            Request::setSession("sucesso", 'Arquivo deletado com sucesso!');
            Redirect::Redirect_To_View('editVisitaInLoco/' . Request::Get('id'));
        }
    }

    public function deleteSolucaoControversia()
    {
        if (Request::validaPost('del')) {
            $this->getDao()->deletetRelatorioById(Request::Get('idFile'));
            $this->getDao()->deletetById(Request::Get('idFile'));
            Request::setSession("sucesso", 'Arquivo deletado com sucesso!');
            Redirect::Redirect_To_View('editSolucaoControversia/' . Request::Get('id'));
        }
    }
}