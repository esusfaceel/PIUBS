<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::controller('ControllerEmpresa');
Import::entidade('Empresa');

class EmpresaDao extends AbstractDao
{

    private $controllerEmpresa;

    private function getController()
    {
        if ($this->controllerEmpresa == null)
            $this->controllerEmpresa = new ControllerEmpresa();
        return $this->controllerEmpresa;
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM empresa;";

        $this->prepare();

        $empresa = array();
        foreach ($this->fetchAll() as $res) {
            array_push($empresa, $this->getController()->montaEmpresa($res["idEmpresa"], $res["razaoSocial"], $res["idMunicipio"], $res["telefone2"], $res["telefone"], $res["email"], $res["cnpj"], $res["ativo"]));
        }
        return $empresa;
    }

    public function findAllByMunicipio($idMunicipio)
    {
        $this->sql = "SELECT * FROM empresa WHERE \"idMunicipio\" = ?;";

        $this->prepare();

        $this->setParam($idMunicipio);

        $empresa = array();
        foreach ($this->fetchAll() as $res) {
            array_push($empresa, $this->getController()->montaEmpresa($res["idEmpresa"], $res["razaoSocial"], $res["idMunicipio"], $res["telefone2"], $res["telefone"], $res["email"], $res["cnpj"], $res["ativo"]));
        }
        return $empresa;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM empresa WHERE \"idEmpresa\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaEmpresa($res["idEmpresa"], $res["razaoSocial"], $res["idMunicipio"], $res["telefone2"], $res["telefone"], $res["email"], $res["cnpj"], $res["ativo"]);
        }
        return null;
    }

    public function insert(Empresa $empresa)
    {
        $this->sql = "INSERT INTO empresa (\"razaoSocial\", \"idMunicipio\", telefone2, telefone, email, ativo) VALUES(?, ?, ?, ?, ?, ?);";

        $this->prepare();

        $this->setParam($empresa->getRazaoSocial());
        $this->setParam($empresa->getIdMunicipio());
        $this->setParam($empresa->getTelefone2());
        $this->setParam($empresa->getTelefone());
        $this->setParam($empresa->getEmail());
        $this->setParam($empresa->isAtivo());

        $this->execute();
    }

    public function update(Empresa $empresa)
    {
        $this->sql = "UPDATE empresa SET \"razaoSocial\" = ?, \"idMunicipio\" = ?, telefone2 = ?, telefone = ?, email = ? WHERE \"idEmpresa\" = ?;";

        $this->prepare();

        $this->setParam($empresa->getRazaoSocial());
        $this->setParam($empresa->getIdMunicipio());
        $this->setParam($empresa->getTelefone2());
        $this->setParam($empresa->getTelefone());
        $this->setParam($empresa->getEmail());
        $this->setParam($empresa->getId());

        $this->execute();
    }
}
