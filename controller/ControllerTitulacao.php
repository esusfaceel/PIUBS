<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::entidade('Titulacao');
Import::dao('TitulacaoDao');

class ControllerTitulacao
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new TitulacaoDao();
        }
        return $this->dao;
    }

    public function getById($id)
    {
        return $this->getDao()->findById($id);
    }

    public function getTitulacoes()
    {
        return $this->getDao()->findAll();
    }

    public function montaTitulacao($id, $descricao)
    {
        $titulacao = new Titulacao();
        $titulacao->setId($id);
        $titulacao->setDescricao($descricao);
        return $titulacao;
    }
}
