<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::entidade('VisitaInLoco');
Import::library('Request');
Import::library('Redirect');
Import::controller('ControllerArquivo');
Import::dao('VisitaInLocoDao');
Import::dao('RespostaDao');
Import::controller('ControllerPergunta');
Import::config('Configuracao');
Import::controller('ControllerLog');

class ControllerVisitaInLoco extends Request
{

    private $dao;

    private function getDao()
    {
        if ($this->dao == null) {
            $this->dao = new VisitaInLocoDao();
        }
        return $this->dao;
    }

    public function save()
    {
        if ($this->validaPost('salvar')) {
            $controller = new ControllerPergunta();
            $resposta = new RespostaDao();
            $upload = new ControllerArquivo();
            $idRelatorio = date('YmdHis');
            $empresas = array_unique($this->Post('empresa'));
            $this->getDao()->insert($this->montaVisita($this->Post('date'), null, date('H:i:s'), $idRelatorio, $this->Post('ubs'), $this->getSession('login')
                ->getId(), TRUE));

            foreach ($empresas as $e)
                $this->getDao()->insertEmpresaVisita($idRelatorio, $e);

            if ($this->File('arquivo')['size'][0] != null) {
                $this->validaFile();
                $upload->insertVisita("arquivo", $idRelatorio);
            }
            $perguntas = $controller->getAllAtivos();
            for ($i = 1; $i <= count($perguntas); $i ++) {
                $idResposta = $resposta->insert($perguntas[$i - 1]->getId(), $perguntas[$i - 1]->getIdTipoResposta(), $this->Post("resposta$i"), $this->Post("obs$i"));
                $this->getDao()->insertRespostaRelatorio($idRelatorio, $idResposta);
            }

            $log = new ControllerLog();
            $log->log(ControllerLog::CADASTRO_VISITA, $idRelatorio);
            $this->setSession("sucesso", 'Visita in Loco ' . $idRelatorio . ' cadastrado com sucesso!');
            Redirect::Redirect_To_View('listVisitaInLoco');
        }
    }

    public function update()
    {
        if ($this->validaPost('salvar')) {
            $controller = new ControllerPergunta();
            $resposta = new RespostaDao();
            $upload = new ControllerArquivo();
            $empresas = array_unique($this->Post('empresa'));
            if ($this->File('arquivo')['size'][0] != null) {
                $this->validaFile();
                $upload->insertVisita("arquivo", $this->Get('id'));
            }
            $this->getDao()->update($this->montaVisita($this->Post('date'), null, null, $this->Get('id'), $this->Post('ubs'), null, TRUE));
            $this->getDao()->deleteEmpresaVisitaByIdVisita($this->Get('id'));
            foreach ($empresas as $e)
                $this->getDao()->insertEmpresaVisita($this->Get('id'), $e);
            $perguntas = $controller->getAllAtivos();
            $r = $resposta->findByIdRelatorio($this->Get('id'));
            for ($i = 1; $i <= count($perguntas); $i ++) {
                $resposta->update($this->Post("resposta$i"), $this->Post("obs$i"), $r[$i - 1]['idResposta']);
            }

            $log = new ControllerLog();
            $log->log(ControllerLog::ALTERACAO_VISITA, $this->Get('id'));

            $this->setSession("sucesso", 'Visita in Loco alterado com sucesso!');
            Redirect::Redirect_To_View('listVisitaInLoco');
        }
    }

    private function validaFile()
    {
        $upload = new ControllerArquivo();
        $arquivos = $this->File('arquivo');
        for ($i = 0; $i < count($arquivos['name']); $i ++) {
            if (! is_uploaded_file($arquivos['tmp_name'][$i])) {
                $this->setSession("err", 'Problemas no upload do arquivo, por favor, tente novamente!<br>Se o problema persistir contate o suporte!<br> <a href="mailto:' . Configuracao::EMAIL . '?Subject=Problemas%20no%20upload%20de%20arquivos" target="_top">' . Configuracao::EMAIL);
                Redirect::Back();
                return;
            }
        }
        if ($upload->tiposPermitidos("arquivo") == FALSE) {
            $this->setSession("err", 'Tipo de arquivo não suportado!');
            Redirect::Back();
            return;
        }
    }

    public function getAllAtivos()
    {
        return $this->getDao()->findAllAtivos();
    }

    public function getById($id)
    {
        return $this->getDao()->findById($id);
    }

    public function getEmpresaVisitaByIdVisita($idVisita)
    {
        return $this->getDao()->findEmpresaVistaById($idVisita);
    }

    public function inativa()
    {
        if ($this->validaPost('del')) {
            $this->getDao()->inativa($this->Get('id'));

            $log = new ControllerLog();
            $log->log(ControllerLog::EXCLUSAO_VISITA, $this->Get('id'));

            $this->setSession("sucesso", 'Visita in Loco deletada com sucesso!');
            Redirect::Redirect_To_View('listVisitaInLoco');
        }
    }

    public function montaVisita($data, $entrevistado, $horario, $id, $idUbs, $idUsuario, $ativo)
    {
        $visita = new VisitaInLoco();
        $visita->setData($data);
        $visita->setEntrevistado($entrevistado);
        $visita->setHorario($horario);
        $visita->setId($id);
        $visita->setIdUbs($idUbs);
        $visita->setIdUsuario($idUsuario);
        $visita->setAtivo($ativo);
        return $visita;
    }
}