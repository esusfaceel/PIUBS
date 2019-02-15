<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::controller('ControllerIes');
Import::entidade('Ies');

class IesDao extends AbstractDao
{

    private $controllerIes;

    private function getController()
    {
        if ($this->controllerIes == null)
            $this->controllerIes = new ControllerIes();
        return $this->controllerIes;
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM ies ORDER BY sigla;";
        
        $this->prepare();
        
        $ies = array();
        foreach ($this->fetchAll() as $res) {
            array_push($ies, $this->getController()->montaIes($res["idIes"], $res["razaoSocial"], $res["idMunicipio"], $res["sigla"], $res["telefone"], $res["email"], $res["ativo"]));
        }
        return $ies;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM ies WHERE \"idIes\" = ?;";
        
        $this->prepare();
        
        $this->setParam($id);
        
        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaIes($res["idIes"], $res["razaoSocial"], $res["idMunicipio"], $res["sigla"], $res["telefone"], $res["email"], $res["ativo"]);
        }
        return null;
    }

    public function findBySigla($sigla)
    {
        $this->sql = "SELECT * FROM ies WHERE sigla = ?;";
        
        $this->prepare();
        
        $this->setParam($sigla);
        
        $res = $this->singleResult();
        if ($res != null) {
            return $this->controllerIes->montaIes($res["idIes"], $res["razaoSocial"], $res["idMunicipio"], $res["sigla"], $res["telefone"], $res["email"], $res["ativo"]);
        }
        return null;
    }

    public function insert(Ies $ies)
    {
        $this->sql = "INSERT INTO ies (\"razaoSocial\", \"idMunicipio\", sigla, telefone, email, ativo) VALUES(?, ?, ?, ?, ?, ?);";
        
        $this->prepare();
        
        $this->setParam($ies->getRazaoSocial());
        $this->setParam($ies->getIdMunicipio());
        $this->setParam($ies->getSigla());
        $this->setParam($ies->getTelefone());
        $this->setParam($ies->getEmail());
        $this->setParam($ies->isAtivo());
        
        $this->execute();
    }

    public function update(Ies $ies)
    {
        $this->sql = "UPDATE ies SET \"razaoSocial\" = ?, \"idMunicipio\" = ?, sigla = ?, telefone = ?, email = ? WHERE \"idIes\" = ?;";
        
        $this->prepare();
        
        $this->setParam($ies->getRazaoSocial());
        $this->setParam($ies->getIdMunicipio());
        $this->setParam($ies->getSigla());
        $this->setParam($ies->getTelefone());
        $this->setParam($ies->getEmail());
        $this->setParam($ies->getId());
        
        $this->execute();
    }
}
