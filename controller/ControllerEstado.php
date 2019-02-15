<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::dao('EstadoDao');
Import::entidade('Estado');

class ControllerEstado
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new EstadoDao();
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

    public function getBySigla($sigla)
    {
        return $this->getDao()->findBySigla($sigla);
    }

    public function getEstados()
    {
        return $this->getDao()->findAll();
    }

    public function montaEstado($id, $nome, $sigla)
    {
        $estado = new Estado();
        $estado->setId($id);
        $estado->setNome($nome);
        $estado->setSigla($sigla);
        return $estado;
    }
}
