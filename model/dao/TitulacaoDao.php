<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('Titulacao');

class TitulacaoDao extends AbstractDao
{

    private $controllerTitulacao;

    private function getController()
    {
        if ($this->controllerTitulacao == null)
            $this->controllerTitulacao = new ControllerTitulacao();
        return $this->controllerTitulacao;
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM titulacao;";
        
        $this->prepare();
        
        $titulos = array();
        foreach ($this->fetchAll() as $res) {
            array_push($titulos, $this->getController()->montaTitulacao($res['idTitulacao'], $res['descricao']));
        }
        return $titulos;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM titulacao WHERE \"idTitulacao\" = ?;";
        
        $this->prepare();
        
        $this->setParam($id);
        $res = $this->singleResult();
        if ($res != null) {
            return $this->controllerTitulacao->montaTitulacao($res['idTitulacao'], $res['descricao']);
        }
        return null;
    }
}
