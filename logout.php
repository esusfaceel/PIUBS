<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::config('Configuracao');
Import::library('Request');
Import::library('Redirect');

Request::deleteSession('login');
Redirect::Redirect_To_View('login');

?>
<noscript>Seu dispositivo não suporta essa aplicação. Por favor, utilize
	outro dispositivo!</noscript>