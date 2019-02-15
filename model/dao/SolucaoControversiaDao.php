<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('SolucaoControversia');

class SolucaoControversiaDao extends AbstractDao
{

    private $controllerSolucao;

    private function getController()
    {
        if ($this->controllerSolucao == null)
            $this->controllerSolucao = new ControllerSolucaoControversia();
        return $this->controllerSolucao;
    }

    private function montaSolucao($res)
    {
        return $this->getController()->montaSolucao($res['idSolucao'], $res['requeridoUbs'], $res['requeridoEmpresa'], $res['requeridoArgumentacao'], $res['requerenteUbs'], $res['requerenteEmpresa'], $res['requerenteDescricao'], $res['requerenteArgumentacao'], $res['avaliacaoDescricao'], $res['status'], $res['ativo'], $res['data'], $res['horario'], $res['idUsuario']);
    }

    public function findAllAtivas()
    {
        $this->sql = "SELECT sc.*, e.\"razaoSocial\" as \"requeridoEmpresa\", e1.\"razaoSocial\" as \"requerenteEmpresa\", u.nome as \"requeridoUbs\", u1.nome as \"requerenteUbs\" FROM solucaocontroversia sc 
left join empresa e on(sc.\"requeridoEmpresa\" = e.\"idEmpresa\") 
left join empresa e1 on(sc.\"requerenteEmpresa\" = e1.\"idEmpresa\")
left join ubs u on(sc.\"requeridoUbs\" = u.\"idUbs\") 
left join ubs u1 on(sc.\"requerenteUbs\" = u1.\"idUbs\")
WHERE sc.ativo = TRUE;";

        $this->prepare();

        $solucao = array();
        foreach ($this->fetchAll() as $res) {
            array_push($solucao, $this->montaSolucao($res));
        }
        return $solucao;
    }

    public function findAllAtivasAndNotFinalizada()
    {
        $this->sql = "SELECT sc.*, e.\"razaoSocial\" as \"requeridoEmpresa\", e1.\"razaoSocial\" as \"requerenteEmpresa\", u.nome as \"requeridoUbs\", u1.nome as \"requerenteUbs\" FROM solucaocontroversia sc
left join empresa e on(sc.\"requeridoEmpresa\" = e.\"idEmpresa\")
left join empresa e1 on(sc.\"requerenteEmpresa\" = e1.\"idEmpresa\")
left join ubs u on(sc.\"requeridoUbs\" = u.\"idUbs\")
left join ubs u1 on(sc.\"requerenteUbs\" = u1.\"idUbs\")
WHERE sc.ativo = TRUE AND status = 1;";

        $this->prepare();

        $solucao = array();
        foreach ($this->fetchAll() as $res) {
            array_push($solucao, $this->montaSolucao($res));
        }
        return $solucao;
    }

    public function findAllAtivasFinalizada()
    {
        $this->sql = "SELECT sc.*, e.\"razaoSocial\" as \"requeridoEmpresa\", e1.\"razaoSocial\" as \"requerenteEmpresa\", u.nome as \"requeridoUbs\", u1.nome as \"requerenteUbs\" FROM solucaocontroversia sc
left join empresa e on(sc.\"requeridoEmpresa\" = e.\"idEmpresa\")
left join empresa e1 on(sc.\"requerenteEmpresa\" = e1.\"idEmpresa\")
left join ubs u on(sc.\"requeridoUbs\" = u.\"idUbs\")
left join ubs u1 on(sc.\"requerenteUbs\" = u1.\"idUbs\")
WHERE sc.ativo = TRUE AND status = 2;";

        $this->prepare();

        $solucao = array();
        foreach ($this->fetchAll() as $res) {
            array_push($solucao, $this->montaSolucao($res));
        }
        return $solucao;
    }

    public function findByIdAtivo($id)
    {
        $this->sql = "SELECT sc.*, e.\"razaoSocial\" as \"requeridoEmpresa\", e1.\"razaoSocial\" as \"requerenteEmpresa\", u.nome as \"requeridoUbs\", u1.nome as \"requerenteUbs\" FROM solucaocontroversia sc
left join empresa e on(sc.\"requeridoEmpresa\" = e.\"idEmpresa\")
left join empresa e1 on(sc.\"requerenteEmpresa\" = e1.\"idEmpresa\")
left join ubs u on(sc.\"requeridoUbs\" = u.\"idUbs\")
left join ubs u1 on(sc.\"requerenteUbs\" = u1.\"idUbs\")
WHERE sc.ativo = TRUE AND sc.\"idSolucao\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaSolucao($res);
        }
        return null;
    }

    public function insert(SolucaoControversia $solucao)
    {
        $this->sql = "INSERT INTO solucaocontroversia (\"requeridoUbs\", \"requeridoEmpresa\", \"requeridoArgumentacao\", \"requerenteUbs\", \"requerenteEmpresa\", \"requerenteDescricao\", \"requerenteArgumentacao\", \"avaliacaoDescricao\", status, ativo, data, horario, \"idUsuario\", \"idSolucao\") VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->prepare();

        $this->setParam($solucao->getRequeridoUbs());
        $this->setParam($solucao->getRequeridoEmpresa());
        $this->setParam($solucao->getRequeridoArgumentacao());
        $this->setParam($solucao->getRequerenteUbs());
        $this->setParam($solucao->getRequerenteEmpresa());
        $this->setParam($solucao->getRequerenteDescricao());
        $this->setParam($solucao->getRequerenteArgumentacao());
        $this->setParam($solucao->getAvaliacaoDescricao());
        $this->setParam($solucao->getStatus());
        $this->setParam($solucao->getAtivo());
        $this->setParam($solucao->getData());
        $this->setParam($solucao->getHorario());
        $this->setParam($solucao->getIdUsuario());
        $this->setParam($solucao->getId());

        return $this->isPersist("solucaocontroversia", "idSolucao");
    }

    public function update(SolucaoControversia $solucao)
    {
        $this->sql = "UPDATE solucaocontroversia SET \"requeridoUbs\" = ?, \"requeridoEmpresa\" = ?, \"requeridoArgumentacao\" = ?, \"requerenteUbs\" = ?, \"requerenteEmpresa\" = ?, \"requerenteDescricao\" = ?, \"requerenteArgumentacao\" = ?, \"avaliacaoDescricao\" = ?, status = ?, data = ?, horario = ? WHERE \"idSolucao\" = ?;";

        $this->prepare();

        $this->setParam($solucao->getRequeridoUbs());
        $this->setParam($solucao->getRequeridoEmpresa());
        $this->setParam($solucao->getRequeridoArgumentacao());
        $this->setParam($solucao->getRequerenteUbs());
        $this->setParam($solucao->getRequerenteEmpresa());
        $this->setParam($solucao->getRequerenteDescricao());
        $this->setParam($solucao->getRequerenteArgumentacao());
        $this->setParam($solucao->getAvaliacaoDescricao());
        $this->setParam($solucao->getStatus());
        $this->setParam($solucao->getData());
        $this->setParam($solucao->getHorario());
        $this->setParam($solucao->getId());

        $this->execute();
    }

    public function inative($id)
    {
        $this->sql = "UPDATE solucaocontroversia SET ativo = FALSE WHERE \"idSolucao\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $this->execute();
    }
}
