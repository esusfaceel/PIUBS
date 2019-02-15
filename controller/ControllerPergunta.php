<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('Request');
Import::library('Redirect');
Import::dao('PerguntaDao');
Import::config('Configuracao');
Import::controller('ControllerLog');

class ControllerPergunta extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new PerguntaDao();
        }
        return $this->dao;
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $this->getDao()->update($this->montaPergunta($this->Get('id'), $this->Post('pergunta'), null, $this->Post('tresposta'), TRUE, ($this->Post('required') == 'on') ? TRUE : FALSE));

            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_PERGUNTA, $this->Get('id'));

            $this->setSession("sucesso", 'Pergunta alterada com sucesso!');
            Redirect::Redirect_To_View('listPergunta');
        }
    }

    public function inative()
    {
        if ($this->validaPost('del')) {
            $this->getDao()->inative($this->Get('id'));

            $log = new ControllerLog();
            $log->log(ControllerLog::EXCLUSAO_PERGUNTA, $this->Get('id'));

            $this->setSession("sucesso", 'Pergunta deletada com sucesso!');
            Redirect::Redirect_To_View('listPergunta');
        }
    }

    public function cadastro()
    {
        if ($this->validaPost('salvar')) {
            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_PERGUNTA, $this->getDao()
                ->insert($this->montaPergunta(null, $this->Post('pergunta'), null, $this->Post('tresposta'), TRUE, ($this->Post('required') == 'on') ? TRUE : FALSE)));
            $this->setSession("sucesso", 'Pergunta cadastrada com sucesso!');
            Redirect::Redirect_To_View('listPergunta');
        }
    }

    public function getAll()
    {
        return $this->getDao()->findAll();
    }

    public function getAllAtivos()
    {
        return $this->getDao()->findAllAtivos();
    }

    public function getAllByUbs($idUbs)
    {
        // return $this->getDao()->findAll();
    }

    public function getById($id)
    {
        return $this->getDao()->findById($id);
    }

    public function montaPergunta($id, $descricao, $idUbs, $idTipoResposta, $ativo, $obrigatoria)
    {
        $pergunta = new Pergunta();
        $pergunta->setId($id);
        $pergunta->setAtivo($ativo);
        $pergunta->setDescricao($descricao);
        $pergunta->setIdTipoResposta($idTipoResposta);
        $pergunta->setIdUbs($idUbs);
        $pergunta->setObrigatoria($obrigatoria);

        return $pergunta;
    }
}
