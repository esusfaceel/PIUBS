<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('VisitaInLoco');

class VisitaInLocoDao extends AbstractDao
{

    private $controller;

    private function getController()
    {
        if ($this->controller == null)
            $this->controller = new ControllerVisitaInLoco();
        return $this->controller;
    }

    private function montaVisita($res)
    {
        return $this->getController()->montaVisita($res['data'], $res['entrevistado'], $res['horario'], $res['idRelatorioVisita'], $res['idUbs'], $res['idUsuario'], $res['ativo']);
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM relatorioVisita ORDER BY data DESC;";

        $this->prepare();

        $relatorios = array();
        foreach ($this->fetchAll() as $res) {
            array_push($relatorios, $this->montaVisita($res));
        }
        return $relatorios;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM relatorioVisita WHERE ativo = TRUE AND \"idRelatorioVisita\" = ?;";

        $this->prepare();

        $this->setParam($id);

        return $this->montaVisita($this->singleResult());
    }

    public function findEmpresaVistaById($id)
    {
        $this->sql = "SELECT ev.*, e.\"razaosocial\" FROM empresavisita ev join empresa e on ev.\"idEmpresa\" = e.\"idEmpresa\" join relatoriovisita rv on rv.\"idRelatorio\" = ev.\"idRelatorioVisita\" WHERE rv.ativo = TRUE AND ev.\"idRelatorioVisita\" = ?;";

        $this->prepare();

        $this->setParam($id);

        return $this->fetchAll();
    }

    public function findAllAtivos()
    {
        $this->sql = "SELECT v.*, u.nome as ubs FROM relatorioVisita v JOIN ubs u ON (u.\"idUbs\" = v.\"idUbs\") WHERE v.ativo = TRUE;";

        $this->prepare();

        return $this->fetchAll();
    }

    public function insert(VisitaInLoco $visita)
    {
        $this->sql = "INSERT INTO relatoriovisita (data, horario, \"idUbs\", \"idUsuario\", entrevistado, ativo, \"idRelatorioVisita\") VALUES (?, ?, ?, ?, ?, ?, ?);";
        $this->prepare();

        $this->setParam($visita->getData());
        $this->setParam($visita->getHorario());
        $this->setParam($visita->getIdUbs());
        $this->setParam($visita->getIdUsuario());
        $this->setParam($visita->getEntrevistado());
        $this->setParam($visita->getAtivo());
        $this->setParam($visita->getId());

        return $this->isPersist("relatoriovisita", "idRelatorioVisita");
    }

    public function insertEmpresaVisita($idVisita, $idEmpresa)
    {
        $this->sql = "INSERT INTO empresavisita (\"idEmpresa\", \"idRelatorioVista\") VALUES (?, ?);";
        $this->prepare();

        $this->setParam($idEmpresa);
        $this->setParam($idVisita);

        return $this->isPersist();
    }

    public function deleteEmpresaVisitaByIdVisita($idVisita)
    {
        $this->sql = "delete FROM empresavisita where \"idRelatorioVista\" = ?;";
        $this->prepare();

        $this->setParam($idVisita);

        return $this->isPersist();
    }

    public function insertRespostaRelatorio($relatorio, $resposta)
    {
        $this->sql = "INSERT INTO respostarelatorio (\"idResposta\", \"idRelatorio\") VALUES(?, ?);";

        $this->prepare();

        $this->setParam($resposta);
        $this->setParam($relatorio);

        return $this->isPersist();
    }

    public function update(VisitaInLoco $visita)
    {
        $this->sql = "UPDATE relatoriovisita SET data = ?, \"idUbs\" = ?, entrevistado = ? WHERE \"idRelatorioVisita\" = ?;";
        $this->prepare();

        $this->setParam($visita->getData());
        $this->setParam($visita->getIdUbs());
        $this->setParam($visita->getEntrevistado());
        $this->setParam($visita->getId());

        $this->execute();
    }

    public function inativa($id)
    {
        $this->sql = "UPDATE relatoriovisita SET ativo = ? WHERE \"idRelatorioVisita\" = ?;";
        $this->prepare();

        $this->setParam(0);
        $this->setParam($id);

        $this->execute();
    }
}
