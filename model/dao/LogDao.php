<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('Log');
Import::controller('ControllerLog');

class LogDao extends AbstractDao
{

    private $controller;

    private function getController()
    {
        if ($this->controller == null)
            $this->controller = new ControllerLog();
        return $this->controller;
    }

    private function montaLog($res)
    {
        return $this->getController()->montaLog($res['idLog'], $res['idTipoLog'], $res['idAlteracao'], $res['idUsuario'], $res['data']);
    }

    public function insert(Log $log)
    {
        $this->sql = "INSERT INTO log (\"idTipoLog\", \"idAlteracao\", \"idUsuario\", data) VALUES(?, ?, ?, CURRENT_TIMESTAMP);";

        $this->prepare();

        $this->setParam($log->getIdTipoLog());
        $this->setParam($log->getIdAlteracao());
        $this->setParam($log->getIdUsuario());

        $this->execute();
    }

    public function findAllAcessosByPeriodo($inicio, $fim)
    {
        $this->sql = "select * from log where TO_CHAR(data, 'MM/YYYY') >= ? AND TO_CHAR(data, 'MM/YYYY') <= ? AND \"idTipoLog\" = 1;";

        $this->prepare();

        $this->setParam($inicio);
        $this->setParam($fim);

        $log = array();
        foreach ($this->fetchAll() as $res) {
            array_push($log, $this->montaLog($res));
        }
        return $log;
    }
}
