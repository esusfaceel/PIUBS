<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::controller('ControllerMunicipio');
$controller = new ControllerMunicipio();

foreach ($controller->getMunicipiosByEstado($_GET['id']) as $municipio) {
    echo "<option value='" . $municipio->getId() . "'>" . $municipio->getNome() . "</option>";
}
