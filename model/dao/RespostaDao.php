<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');

class RespostaDao extends AbstractDao
{

    public function findAll()
    {
        $this->sql = "SELECT * FROM resposta;";
        
        $this->prepare();
        
        return $this->fetchAll();
    }

    public function findById($id)
    {
        $this->sql = "SELECT * FROM resposta WHERE \"idResposta\" = ?;";
        
        $this->prepare();
        
        $this->setParam($id);
        
        return $this->singleResult();
    }

    public function findByIdRelatorio($id)
    {
        $this->sql = "SELECT * FROM respostarelatorio WHERE \"idRelatorio\" = ?;";
        
        $this->prepare();
        
        $this->setParam($id);
        
        return $this->fetchAll();
    }

    public function insert($idPergunta, $idTipoResposta, $resposta, $obs)
    {
        $this->sql = "INSERT INTO resposta (\"idPergunta\", \"idTipoResposta\", resposta, obs) VALUES(?, ?, ?, ?);";
        
        $this->prepare();
        
        $this->setParam($idPergunta);
        $this->setParam($idTipoResposta);
        $this->setParam($resposta);
        $this->setParam($obs);
        
        return $this->isPersist();
    }

    public function update($resposta, $obs, $id)
    {
        $this->sql = "UPDATE resposta SET resposta = ?, obs  = ? WHERE \"idResposta\" = ?;";
        
        $this->prepare();

        $this->setParam($resposta);
        $this->setParam($obs);
        $this->setParam($id);
        
        $this->execute();
    }
}
