<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('Pergunta');
Import::controller('ContreollerPergunta');

class PerguntaDao extends AbstractDao
{

    private $controller;

    private function getController()
    {
        if ($this->controller == null)
            $this->controller = new ControllerPergunta();
        return $this->controller;
    }

    public function findAll()
    {
        $this->sql = "SELECT * FROM pergunta;";

        $this->prepare();

        $perguntas = array();
        foreach ($this->fetchAll() as $res) {
            array_push($perguntas, $this->getController()->montaPergunta($res["idPergunta"], $res["descricao"], $res["idUbs"], $res["idTipoResposta"], $res["ativo"], $res["obrigatoria"]));
        }
        return $perguntas;
    }

    public function findAllAtivos()
    {
        $this->sql = "SELECT * FROM pergunta WHERE ativo = TRUE ORDER BY \"idPergunta\";";

        $this->prepare();

        $perguntas = array();
        foreach ($this->fetchAll() as $res) {
            array_push($perguntas, $this->getController()->montaPergunta($res["idPergunta"], $res["descricao"], $res["idUbs"], $res["idTipoResposta"], $res["ativo"], $res["obrigatoria"]));
        }
        return $perguntas;
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM pergunta WHERE \"idPergunta\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->getController()->montaPergunta($res["idPergunta"], $res["descricao"], $res["idUbs"], $res["idTipoResposta"], $res["ativo"], $res["obrigatoria"]);
        }
        return null;
    }

    public function insert(Pergunta $pergunta)
    {
        $this->sql = "INSERT INTO pergunta (descricao, \"idTipoResposta\", \"idUbs\", ativo) VALUES(?, ?, ?, ?);";

        $this->prepare();

        $this->setParam($pergunta->getDescricao());
        $this->setParam($pergunta->getIdTipoResposta());
        $this->setParam($pergunta->getIdUbs());
        $this->setParam($pergunta->isAtivo());

        $this->execute();
    }

    public function update(Pergunta $pergunta)
    {
        $this->sql = "UPDATE pergunta SET descricao = ?, \"idTipoResposta\" = ?, \"idUbs\" = ?, obrigatoria = ";
        $this->sql .= ($pergunta->isObrigatoria() == false) ? "false" : "true";
        $this->sql .= ", ativo = ? WHERE \"idPergunta\" = ?;";
        $this->prepare();

        $this->setParam($pergunta->getDescricao());
        $this->setParam($pergunta->getIdTipoResposta());
        $this->setParam($pergunta->getIdUbs());
        $this->setParam($pergunta->isAtivo());
        $this->setParam($pergunta->getId());

        $this->execute();
    }

    public function inative($id)
    {
        $this->sql = "UPDATE pergunta SET ativo = FALSE WHERE \"idPergunta\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $this->execute();
    }
}
