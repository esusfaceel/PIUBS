<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::config('Configuracao');
Import::library('Request');
Import::entidade('Usuario');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset='utf-8' />
<title><?php echo Configuracao::NAME_APP;?></title>

<!--Import Google Icon Font-->
<link
	href="<?php echo Configuracao::HOST_SERVER;?>/assets/css/Materialicon.css"
	rel="stylesheet">
<!--Import materialize.css-->
<link type="text/css" rel="stylesheet"
	href="<?php echo Configuracao::HOST_SERVER;?>/assets/css/materialize.min.css"
	media="screen,projection" />
<link type="text/css" rel="stylesheet"
	href="<?php echo Configuracao::HOST_SERVER;?>/assets/css/style.css"
	media="screen,projection" />

<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
<link
	href="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/perfect-scrollbar/perfect-scrollbar.css"
	type="text/css" rel="stylesheet" media="screen,projection">
<link
	href="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/jvectormap/jquery-jvectormap.css"
	type="text/css" rel="stylesheet" media="screen,projection">
<link
	href="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/chartist-js/chartist.min.css"
	type="text/css" rel="stylesheet" media="screen,projection">
<!--Import base.css-->

<link rel="shortcut icon"
	href="<?php echo Configuracao::HOST_SERVER; ?>/model/img/logo.png">
<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script type="text/javascript"
	src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER; ?>/assets/js/materialize.min.js"></script>
<script type="text/javascript">
function showToast(message, duration, color) {
    Materialize.toast(message, duration, color);
}
</script>
</head>