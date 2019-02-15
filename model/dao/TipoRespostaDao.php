<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');

class TipoRespostaDao extends AbstractDao
{

    public function findAll()
    {
        $this->sql = "SELECT * FROM tiporesposta;";
        
        $this->prepare();
        
        $respostas = array();
        foreach ($this->fetchAll() as $res) {
            array_push($respostas, array(
                "id" => $res["idTipoResposta"],
                "descricao" => $res["descricao"],
                "ativo" => $res["ativo"]
            ));
        }
        return $respostas;
    }

    public function findAllAtivos()
    {
        $this->sql = "SELECT * FROM tiporesposta WHERE ativo = TRUE;";
        
        $this->prepare();
        
        $respostas = array();
        foreach ($this->fetchAll() as $res) {
            array_push($respostas, array(
                "id" => $res["idTipoResposta"],
                "descricao" => $res["descricao"],
                "ativo" => $res["ativo"]
            ));
        }
        return $respostas;
    }
}
