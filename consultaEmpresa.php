<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::controller('ControllerEmpresa');
$controller = new ControllerEmpresa();

if (empty($controller->getByIdMunicipio($_GET['id'])))
    echo "<option>---NENHUMA EMPRESA ENCONTRADA---</option>";
else {
    foreach ($controller->getAllByIdMunicipio($_GET['id']) as $ubs) {
        echo "<option value='" . $ubs->getId() . "'>" . $ubs->getNome() . "</option>";
    }
}
