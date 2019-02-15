<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::entidade('SolucaoControversia');
Import::library('Request');
Import::library('Redirect');
Import::controller('ControllerArquivo');
Import::dao('SolucaoControversiaDao');
Import::config('Configuracao');
Import::controller('ControllerLog');

class ControllerSolucaoControversia extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new SolucaoControversiaDao();
        }
        return $this->dao;
    }

    public function save()
    {
        if ($this->validaPost('salvar')) {
            $upload = new ControllerArquivo();
            $idRelatorio = date('YmdHis');

            if ($this->Post('switch') === 'on')
                $this->getDao()->insert($this->montaSolucao($idRelatorio, $this->Post('requeridoUbs'), NULL, $this->Post('requeridoArgumentacao'), NULL, $this->Post('requerenteEmpresa'), $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));
            else
                $this->getDao()->insert($this->montaSolucao($idRelatorio, NULL, $this->Post('requeridoEmpresa'), $this->Post('requeridoArgumentacao'), $this->Post('requerenteUbs'), NULL, $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));
            if ($this->File('arquivo')['size'][0] != null) {
                $this->validaFile('arquivo');
                $upload->insertSolucao("arquivo", $idRelatorio, $upload::REQUIRENTE);
            }
            if ($this->File('arquivoRequerido')['size'][0] != null) {
                $this->validaFile('arquivoRequerido');
                $upload->insertSolucao("arquivoRequerido", $idRelatorio, $upload::REQUERIDO);
            }
            if ($this->File('arquivoControversia')['size'][0] != null) {
                $this->validaFile('arquivoControversia');
                $upload->insertSolucao("arquivoControversia", $idRelatorio, $upload::AVALIACAO);
            }
            $log = new ControllerLog();
            $log->log(ControllerLog::CADASTRO_SOLUCAO, $idRelatorio);

            $this->setSession("sucesso", 'Solução de controvérsia ' . $idRelatorio . ' salva com sucesso!');
            Redirect::Redirect_To_View('listSolucaoControversia');
        }
    }

    public function finalizar()
    {
        if ($this->validaPost('finalizar')) {
            $upload = new ControllerArquivo();

            if ($this->Post('switch') === 'on')
                $idRelatorio = $this->getDao()->insert($this->montaSolucao(date('YmdHis'), $this->Post('requeridoUbs'), NULL, $this->Post('requeridoArgumentacao'), NULL, $this->Post('requerenteEmpresa'), $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));
            else
                $idRelatorio = $this->getDao()->insert($this->montaSolucao(date('YmdHis'), NULL, $this->Post('requeridoEmpresa'), $this->Post('requeridoArgumentacao'), $this->Post('requerenteUbs'), NULL, $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));

            if ($this->File('arquivo') != null) {
                $this->validaFile('arquivo');
                $upload->insertSolucao("arquivo", $idRelatorio, $upload::REQUIRENTE);
            }
            if ($this->File('arquivoRequerido') != null) {
                $this->validaFile('arquivoRequerido');
                $upload->insertSolucao("arquivoRequerido", $idRelatorio, $upload::REQUERIDO);
            }
            if ($this->File('arquivoControversia') != null) {
                $this->validaFile('arquivoControversia');
                $upload->insertSolucao("arquivoControversia", $idRelatorio, $upload::AVALIACAO);
            }
            $log = new ControllerLog();
            $log->log(ControllerLog::CADASTRO_SOLUCAO, $idRelatorio);

            $this->setSession("sucesso", 'Solução de controvérsia cadastrado com sucesso!');
            Redirect::Redirect_To_View('listSolucaoControversia');
        }
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $upload = new ControllerArquivo();

            if ($this->Post('switch') === 'on')
                $this->getDao()->update($this->montaSolucao($this->Get('id'), $this->Post('requeridoUbs'), NULL, $this->Post('requeridoArgumentacao'), NULL, $this->Post('requerenteEmpresa'), $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));
            else
                $this->getDao()->update($this->montaSolucao($this->Get('id'), NULL, $this->Post('requeridoEmpresa'), $this->Post('requeridoArgumentacao'), $this->Post('requerenteUbs'), NULL, $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));

            if ($this->File('arquivo') != null) {
                $this->validaFile('arquivo');
                $upload->insertSolucao("arquivo", $this->Get('id'), $upload::REQUIRENTE);
            }
            if ($this->File('arquivoRequerido') != null) {
                $this->validaFile('arquivoRequerido');
                $upload->insertSolucao("arquivoRequerido", $this->Get('id'), $upload::REQUERIDO);
            }
            if ($this->File('arquivoControversia') != null) {
                $this->validaFile('arquivoControversia');
                $upload->insertSolucao("arquivoControversia", $this->Get('id'), $upload::AVALIACAO);
            }
            $log = new ControllerLog();
            $log->log(ControllerLog::alteracao_SOLUCAO, $this->Get('id'));

            $this->setSession("sucesso", 'Solução de controvérsia alterada com sucesso!');
            Redirect::Redirect_To_View('listSolucaoControversia');
        }
    }

    public function updateAndFinalizar()
    {
        if ($this->validaPost('finalizar')) {
            $upload = new ControllerArquivo();

            if ($this->Post('switch') === 'on')
                $this->getDao()->update($this->montaSolucao($this->Get('id'), $this->Post('requeridoUbs'), NULL, $this->Post('requeridoArgumentacao'), NULL, $this->Post('requerenteEmpresa'), $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));
            else
                $this->getDao()->update($this->montaSolucao($this->Get('id'), NULL, $this->Post('requeridoEmpresa'), $this->Post('requeridoArgumentacao'), $this->Post('requerenteUbs'), NULL, $this->Post('requerenteDescricao'), $this->Post('requerenteArgumentacao'), $this->Post('avaliacaoDescricao'), 1, TRUE, date('Y-m-d'), date('H:i:s'), $this->getSession('login')
                    ->getId()));

            if ($this->File('arquivo') != null) {
                $this->validaFile('arquivo');
                $upload->insertSolucao("arquivo", $this->Get('id'), $upload::REQUIRENTE);
            }
            if ($this->File('arquivoRequerido') != null) {
                $this->validaFile('arquivoRequerido');
                $upload->insertSolucao("arquivoRequerido", $this->Get('id'), $upload::REQUERIDO);
            }
            if ($this->File('arquivoControversia') != null) {
                $this->validaFile('arquivoControversia');
                $upload->insertSolucao("arquivoControversia", $this->Get('id'), $upload::AVALIACAO);
            }
            $log = new ControllerLog();
            $log->log(ControllerLog::alteracao_SOLUCAO, $this->Get('id'));

            $this->setSession("sucesso", 'Solução de controvérsia alterada com sucesso!');
            Redirect::Redirect_To_View('listSolucaoControversia');
        }
    }

    private function validaFile($name)
    {
        $upload = new ControllerArquivo();
        $arquivos = $this->File($name);
        for ($i = 0; $i < count($arquivos['name']); $i ++) {
            if (! is_uploaded_file($arquivos['tmp_name'][$i])) {
                $this->setSession("err", 'Problemas no upload do arquivo, por favor, tente novamente!<br>Se o problema persistir contate o suporte!<br> <a href="mailto:' . Configuracao::EMAIL . '?Subject=Problemas%20no%20upload%20de%20arquivos" target="_top">' . Configuracao::EMAIL);
                Redirect::Back();
                return;
            }
        }
        if ($upload->tiposPermitidos($name) == FALSE) {
            $this->setSession("err", 'Tipo de arquivo não suportado!');
            Redirect::Back();
            return;
        }
    }

    public function getAllAtivos()
    {
        return $this->getDao()->findAllAtivas();
    }

    public function getAllAtivosAndNotFinalizadas()
    {
        return $this->getDao()->findAllAtivasAndNotFinalizada();
    }

    public function getAllAtivosFinalizadas()
    {
        return $this->getDao()->findAllAtivasFinalizada();
    }

    public function getById($id)
    {
        return $this->getDao()->findByIdAtivo($id);
    }

    public function inativa()
    {
        if ($this->validaPost('del')) {
            $this->getDao()->inative($this->Get('id'));

            $log = new ControllerLog();
            $log->log(ControllerLog::EXCLUSAO_SOLUCAO, $this->Get('id'));

            $this->setSession("sucesso", 'Solução de controvérsia deletada com sucesso!');
            Redirect::Redirect_To_View('listSolucaoControversia');
        }
    }

    public function montaSolucao($id, $requeridoUbs, $requeridoEmpresa, $requeridoArgumentacao, $requerenteUbs, $requerenteEmpresa, $requerenteDescricao, $requerenteArgumentacao, $avaliacaoDescricao, $status, $ativo, $data, $horario, $idUsuario)
    {
        $solucao = new SolucaoControversia();
        $solucao->setId($id);
        $solucao->setRequeridoUbs($requeridoUbs);
        $solucao->setRequeridoEmpresa($requeridoEmpresa);
        $solucao->setRequeridoArgumentacao($requeridoArgumentacao);
        $solucao->setRequerenteUbs($requerenteUbs);
        $solucao->setRequerenteEmpresa($requerenteEmpresa);
        $solucao->setRequerenteDescricao($requerenteDescricao);
        $solucao->setRequerenteArgumentacao($requerenteArgumentacao);
        $solucao->setAvaliacaoDescricao($avaliacaoDescricao);
        $solucao->setAtivo($ativo);
        $solucao->setStatus($status);
        $solucao->setData($data);
        $solucao->setHorario($horario);
        $solucao->setIdUsuario($idUsuario);

        return $solucao;
    }
}