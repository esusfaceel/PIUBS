<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::config('Configuracao');

class ArquivoDao extends AbstractDao
{

    public function insertArquivo($nome, $arquivo)
    {
        $this->sql = "insert into arquivo (nome, arquivo) values (?, lo_import(?));";

        $this->prepare();

        $this->setParam($nome);
        $this->setParam($arquivo);

        return $this->isPersist("arquivo", "idArquivo");
    }

    public function insertArquivoRelatorioVisita($idArquivo, $idVisita)
    {
        $this->sql = "insert into arquivorelatorio (\"idArquivo\", \"idVisita\") values (?, ?);";

        $this->prepare();

        $this->setParam($idArquivo);
        $this->setParam($idVisita);

        $this->isPersist();
    }

    public function insertArquivoRelatorioSolucao($idArquivo, $idSolucao, $tipoSolucao)
    {
        $this->sql = "insert into arquivorelatorio (\"idArquivo\", \"idSolucaoControversia\", \"tipoSolucao\") values (?, ?, ?);";
        $this->prepare();

        $this->setParam($idArquivo);
        $this->setParam($idSolucao);
        $this->setParam($tipoSolucao);

        $this->isPersist();
    }

    public function selectAllByIdVisita($idVIsita)
    {
        $this->sql = "SELECT lo_export(a.arquivo, '" . Configuracao::EXPORT_ARQUIVO . "' || '' || a.nome), a.nome, a.\"idArquivo\" FROM arquivo a join arquivorelatorio ar on(a.\"idArquivo\" = ar.\"idArquivo\") WHERE ar.\"idVisita\" = ?;";

        $this->prepare();

        $this->setParam($idVIsita);

        return $this->fetchAll();
    }

    public function selectAllByIdSolucao($idVIsita, $tipoSolucao)
    {
        $this->sql = "SELECT lo_export(a.arquivo, '" . Configuracao::EXPORT_ARQUIVO . "' || '' || a.nome), a.nome, a.\"idArquivo\" FROM arquivo a join arquivorelatorio ar on(a.\"idArquivo\" = ar.\"idArquivo\") WHERE ar.\"idSolucaoControversia\" = ? AND ar.\"tipoSolucao\" = ?;";
        $this->prepare();

        $this->setParam($idVIsita);
        $this->setParam($tipoSolucao);

        return $this->fetchAll();
    }

    public function selectById($id)
    {
        $this->sql = "SELECT lo_export(arquivo, '" . Configuracao::EXPORT_ARQUIVO . "' || ' ' || nome) FROM arquivo WHERE \"idArquivo\" = ?;";

        $this->prepare();

        $this->setParam($id);

        return $this->fetchAll();
    }

    public function deletetById($id)
    {
        $this->sql = "DELETE FROM arquivo WHERE \"idArquivo\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $this->execute();
    }

    public function deletetRelatorioById($id)
    {
        $this->sql = "DELETE FROM arquivorelatorio WHERE \"idArquivo\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $this->execute();
    }
}
