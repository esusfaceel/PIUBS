<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::controller('ControllerUbs');
$controller = new ControllerUbs();

if (empty($controller->getAllByIdMunicipio($_GET['id'])))
    echo "<option>---NENHUMA UBS ENCONTRADA---</option>";
else {
    foreach ($controller->getAllByIdMunicipio($_GET['id']) as $ubs) {
        echo "<option value='" . $ubs->getId() . "'>" . $ubs->getNome() . "</option>";
    }
}
