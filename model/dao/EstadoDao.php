<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('Estado');

class EstadoDao extends AbstractDao
{

    private $controllerEstado;

    private function getController()
    {
        if ($this->controllerEstado == null)
            $this->controllerEstado = new ControllerEstado();
        return $this->controllerEstado;
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM estado ORDER BY nome;";
        
        $this->prepare();
        
        $estados = array();
        foreach ($this->fetchAll() as $res) {
            array_push($estados, $this->getController()->montaEstado($res["idEstado"], $res["nome"], $res["sigla"]));
        }
        return $estados;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM estado WHERE \"idEstado\" = ?;";
        
        $this->prepare();
        
        $this->setParam($id);
        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaEstado($res["idEstado"], $res["nome"], $res["sigla"]);
        }
        return null;
    }

    public function findByNome($nome)
    {
        $this->sql = "SELECT * FROM estado WHERE nome = ?;";
        
        $this->prepare();
        
        $this->setParam($nome);
        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaEstado($res["idEstado"], $res["nome"], $res["sigla"]);
        }
        return null;
    }

    public function findBySigla($sigla)
    {
        $this->sql = "SELECT * FROM estado WHERE sigla = ?;";
        
        $this->prepare();
        
        $this->setParam($sigla);
        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaEstado($res["idEstado"], $res["nome"], $res["sigla"]);
        }
        return null;
    }

    public function insert(Estado $estado)
    {
        $this->sql = "INSERT INTO estado (\"idEstado\", nome, sigla) VALUES(?, ?, ?);";
        
        $this->prepare();
        
        $this->setParam($estado->getId());
        $this->setParam($estado->getNome());
        $this->setParam($estado->getSigla());
        
        $this->execute();
    }
}
