<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('Ubs');

class UbsDao extends AbstractDao
{

    private $controllerUbs;

    private function getController()
    {
        if ($this->controllerUbs == null)
            $this->controllerUbs = new ControllerUbs();
        return $this->controllerUbs;
    }

    private function montaUbs($res)
    {
        return $this->getController()->montaUbs($res["idUbs"], $res["nome"], $res["idMunicipio"], $res["endereco"], $res["bairro"], $res["cep"], $res["responsavel"], $res["ativo"], $res['telefone1'], $res['telefone2'], $res['cnpj'], $res["email"]);
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM ubs ORDER BY nome;";

        $this->prepare();

        $ubs = array();
        foreach ($this->fetchAll() as $res) {
            array_push($ubs, $this->montaUbs($res));
        }
        return $ubs;
    }

    public function findAllByIdMunicipio($id)
    {
        $this->sql = "SELECT * FROM ubs WHERE \"idMunicipio\" = ? ORDER BY nome;";

        $this->prepare();

        $this->setParam($id);

        $ubs = array();
        foreach ($this->fetchAll() as $res) {
            array_push($ubs, $this->montaUbs($res));
        }
        return $ubs;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM ubs WHERE \"idUbs\" = ?;";

        $this->prepare();

        $this->setParam($id);
        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUbs($res);
        }
        return null;
    }

    public function findByNome($nome)
    {
        $this->sql = "SELECT * FROM ubs WHERE nome = ?;";

        $this->prepare();

        $this->setParam($nome);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUbs($res);
        }
        return null;
    }

    public function insert(Ubs $ubs)
    {
        $this->sql = "INSERT INTO ubs (nome, \"idMunicipio\", responsavel, endereco, bairro, cep, ativo, telefone1, telefone2, cnpj, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $this->prepare();

        $this->setParam($ubs->getNome());
        $this->setParam($ubs->getIdMunicipio());
        $this->setParam($ubs->getResponsavel());
        $this->setParam($ubs->getEndereco());
        $this->setParam($ubs->getBairro());
        $this->setParam($ubs->getCep());
        $this->setParam($ubs->isAtivo());
        $this->setParam($ubs->getTelefone1());
        $this->setParam($ubs->getTelefone2());
        $this->setParam($ubs->getCnpj());
        $this->setParam($ubs->getEmail());

        $this->execute();
    }

    public function update(Ubs $ubs)
    {
        $this->sql = "UPDATE ubs SET nome = ?, \"idMunicipio\" = ?, responsavel = ?, endereco = ?, bairro = ?, cep = ?, telefone1 = ?, telefone2 = ?, cnpj = ?, email = ? WHERE \"idUbs\" = ?;";

        $this->prepare();

        $this->setParam($ubs->getNome());
        $this->setParam($ubs->getIdMunicipio());
        $this->setParam($ubs->getResponsavel());
        $this->setParam($ubs->getEndereco());
        $this->setParam($ubs->getBairro());
        $this->setParam($ubs->getCep());
        $this->setParam($ubs->getTelefone1());
        $this->setParam($ubs->getTelefone2());
        $this->setParam($ubs->getCnpj());
        $this->setParam($ubs->getEmail());
        $this->setParam($ubs->getId());

        $this->execute();
    }
}
