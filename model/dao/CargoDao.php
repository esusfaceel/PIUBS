<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');

class CargoDao extends AbstractDao
{

    public function findAll()
    {
        $this->sql = "SELECT * FROM cargo;";
        
        $this->prepare();
        
        $cargos = array();
        foreach ($this->fetchAll() as $res) {
            array_push($cargos, array(
                "id" => $res["idCargo"],
                "descricao" => $res["descricao"]
            ));
        }
        return $cargos;
    }
}
