<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::dao('LogDao');
Import::library('Request');
Import::entidade('Log');

class ControllerLog extends Request
{

    const ACESSO = 1;

    const CADASTRO_USUARIO = 21;

    const CADASTRO_IES = 22;

    const CADASTRO_MUNICIPIO = 23;

    const CADASTRO_UBS = 24;

    const CADASTRO_PERGUNTA = 25;

    const CADASTRO_VISITA = 26;

    const CADASTRO_SOLUCAO = 27;

    const CADASTRO_EMPRESA = 28;

    const ALTERACAO_USUARIO = 31;

    const ALTERACAO_IES = 32;

    const ALTERACAO_MUNICIPIO = 33;

    const ALTERACAO_UBS = 34;

    const ALTERACAO_PERGUNTA = 35;

    const ALTERACAO_VISITA = 36;

    const ALTERACAO_SOLUCAO = 37;

    const ALTERACAO_EMPRESA = 37;

    const EXCLUSAO_USUARIO = 41;

    const EXCLUSAO_PERGUNTA = 45;

    const EXCLUSAO_VISITA = 46;

    const EXCLUSAO_SOLUCAO = 47;

    const SOLICITACAO_RECOVERY_PASSWORD = 51;

    const RECOVERY_PASSWORD = 52;

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new LogDao();
        }
        return $this->dao;
    }

    public function log($idTipoLog, $idAlteracao = null, $idUsuario = null)
    {
        $idUsuario = ($idUsuario == null) ? Request::getSession('login')->getId() : $idUsuario;
        $log = $this->montaLog(null, $idTipoLog, $idAlteracao, $idUsuario, null);
        return $this->getDao()->insert($log);
    }

    public function getAllLoginByPeriodo($inicio, $fim)
    {
        return $this->getDao()->findAllAcessosByPeriodo($inicio, $fim);
    }

    public function montaLog($id, $idTipoLog, $idAlteracao, $idUsuario, $data)
    {
        $log = new Log();
        $log->setId($id);
        $log->setIdTipoLog($idTipoLog);
        $log->setIdAlteracao($idAlteracao);
        $log->setIdUsuario($idUsuario);
        $log->setData($data);
        return $log;
    }
}
