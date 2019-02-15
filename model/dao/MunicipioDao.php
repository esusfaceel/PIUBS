<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('Municipio');

class MunicipioDao extends AbstractDao
{

    private $controllerMunicipio;

    private function getController()
    {
        if ($this->controllerMunicipio == null)
            $this->controllerMunicipio = new ControllerMunicipio();
        return $this->controllerMunicipio;
    }

    public function findAll()
    {
        $this->sql = "SELECT m.*, e.sigla FROM municipio m join estado e on m.\"idEstado\" = e.\"idEstado\" ORDER BY m.\"idMunicipio\";";

        $this->prepare();

        $municipios = array();
        foreach ($this->fetchAll() as $res) {
            array_push($municipios, $this->getController()->montaMunicipio($res["idMunicipio"], $res["nome"], $res["idhm"], $res["idEstado"], $res["area"], $res["densidadePopulacional"], $res["distanciaCapital"], $res["meiosTransporte"], $res["latitude"], $res["longitude"], $res["populacao"], $res['sigla']));
        }
        return $municipios;
    }

    public function findAllBySiglaEstado($siglaEstado)
    {
        $this->sql = "SELECT m.* FROM municipio m JOIN estado e ON (e.\"idEstado\" = m.\"idEstado\") WHERE e.sigla = ? ORDER BY m.nome;";

        $this->prepare();
        $this->setParam($siglaEstado);

        $municipios = array();
        foreach ($this->fetchAll() as $res) {
            array_push($municipios, $this->getController()->montaMunicipio($res["idMunicipio"], $res["nome"], $res["idhm"], $res["idEstado"], $res["area"], $res["densidadePopulacional"], $res["distanciaCapital"], $res["meiosTransporte"], $res["latitude"], $res["longitude"], $res["populacao"]));
        }
        return $municipios;
    }

    public function findAllByEstado($id)
    {
        $this->sql = "SELECT * FROM municipio WHERE \"idEstado\" = ? ORDER BY nome;";

        $this->prepare();

        $this->setParam($id);

        $municipios = array();
        foreach ($this->fetchAll() as $res) {
            array_push($municipios, $this->getController()->montaMunicipio($res["idMunicipio"], $res["nome"], $res["idhm"], $res["idEstado"], $res["area"], $res["densidadePopulacional"], $res["distanciaCapital"], $res["meiosTransporte"], $res["latitude"], $res["longitude"], $res["populacao"]));
        }
        return $municipios;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM municipio WHERE \"idMunicipio\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaMunicipio($res["idMunicipio"], $res["nome"], $res["idhm"], $res["idEstado"], $res["area"], $res["densidadePopulacional"], $res["distanciaCapital"], $res["meiosTransporte"], $res["latitude"], $res["longitude"], $res["populacao"]);
        }
        return null;
    }

    public function findByNome($nome)
    {
        $this->sql = "SELECT * FROM municipio WHERE nome = ?;";

        $this->prepare();

        $this->setParam($nome);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaMunicipio($res["idMunicipio"], $res["nome"], $res["idhm"], $res["idEstado"], $res["area"], $res["densidadePopulacional"], $res["distanciaCapital"], $res["meiosTransporte"], $res["latitude"], $res["longitude"], $res["populacao"]);
        }
        return null;
    }

    public function insert(Municipio $municipio)
    {
        $this->sql = "INSERT INTO municipio (nome, idhm, \"idEstado\", area, \"densidadePopulacional\", \"distanciaCapital\", \"meiosTrasnporte\", latitude, longitude, populacao) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $this->prepare();

        $this->setParam($municipio->getNome());
        $this->setParam($municipio->getIdhm());
        $this->setParam($municipio->getIdEstado());
        $this->setParam($municipio->getArea());
        $this->setParam($municipio->getDensidadePopulacional());
        $this->setParam($municipio->getDistanciaCapital());
        $this->setParam($municipio->getMeiosTransporte());
        $this->setParam($municipio->getLatitude());
        $this->setParam($municipio->getLongitude());
        $this->setParam($municipio->getPopulacao());

        $this->execute();
    }

    public function update(Municipio $municipio)
    {
        $this->sql = "UPDATE municipio SET nome = ?, idhm = ?, \"idEstado\" = ?, area = ?, \"densidadePopulacional\" = ?, \"distanciaCapital\" = ?, \"meiosTrasnporte\" = ?, latitude = ?, longitude = ?, populacao= ? WHERE \"idMunicipio\" = ?;";

        $this->prepare();

        $this->setParam($municipio->getNome());
        $this->setParam($municipio->getIdhm());
        $this->setParam($municipio->getIdEstado());
        $this->setParam($municipio->getArea());
        $this->setParam($municipio->getDensidadePopulacional());
        $this->setParam($municipio->getDistanciaCapital());
        $this->setParam($municipio->getMeiosTransporte());
        $this->setParam($municipio->getLatitude());
        $this->setParam($municipio->getLongitude());
        $this->setParam($municipio->getPopulacao());
        $this->setParam($municipio->getId());

        $this->execute();
    }
}
