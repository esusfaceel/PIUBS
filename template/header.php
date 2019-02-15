<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::config('Configuracao');
Import::library('Request');
Import::library('Alert');
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
	media="screen,projection,print" />
<link type="text/css" rel="stylesheet"
	href="<?php echo Configuracao::HOST_SERVER;?>/assets/css/style.css"
	media="screen,projection,print" />
<link type="text/css" rel="stylesheet"
	href="<?php echo Configuracao::HOST_SERVER;?>/assets/css/enjoyhint.css"
	media="screen,projection" />
<link type="text/css" rel="stylesheet"
	href="<?php echo Configuracao::HOST_SERVER;?>/assets/css/datatables.min.css"
	media="screen,projection" />

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
    Materialize.toast(message, duration,  color);
}
</script>
</head>
<body bgcolor="#3B5D75">
<?php

Alert::showMensage();
$idAvatar = (Request::getSession('login')->getIdAvatar()) ? Request::getSession('login')->getIdAvatar() : 1;
?>
	<header>
		<div class="navbar-fixed">
			<nav>
				<a href="#" data-activates="slide-out" class="button-collapse"><i
					class="material-icons black-text">menu</i></a>
				<div class="nav-wrapper grey lighten-2" id="navbar">
					<div id="divMobile" class="center title">
						<a href="<?php echo Configuracao::HOST_SERVER;?>/"
							class="black-text">Saúde</a>
					</div>
					<ul id='cad' class='dropdown-content'>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadUser"
							class="black-text"><i class="material-icons">face</i>Usuário</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadMunicipio"
							class="black-text"><i class="material-icons">location_city</i>Município</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadIes"
							class="black-text"><i class="material-icons">account_balance</i>IES</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadEmpresa"
							class="black-text"><i class="material-icons">business</i>Empresa</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadUbs"
							class="black-text"><i class="material-icons">local_hospital</i>UBS</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadPergunta"
							class="black-text"><i class="material-icons">help</i>Pergunta
								Visita In Loco</a></li>
					</ul>
					<ul id='con' class='dropdown-content'>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listVisitaInLoco"><i
								class="material-icons">check_circle</i>Visita in Loco</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listSolucaoControversia"><i
								class="material-icons">swap_horiz</i>Solução de controvérsia</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listUsers"><i
								class="material-icons">face</i>Usuário</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listMunicipio"><i
								class="material-icons">location_city</i>Município</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listIes"><i
								class="material-icons">account_balance</i>IES</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listEmpresa"><i
								class="material-icons">business</i>Empresa</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listUbs"><i
								class="material-icons">local_hospital</i>UBS</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/listPergunta"><i
								class="material-icons">help</i>Pergunta Visita In Loco</a></li>
					</ul>
					<ul id='tec' class='dropdown-content'>
						<li><a class="black-text" id="visita"
							href="<?php echo Configuracao::HOST_SERVER;?>/cadVisitaInLoco"><i
								class="material-icons">check_circle</i>Visita in Loco</a></li>
						<li><a class="black-text" id="solucao"
							href="<?php echo Configuracao::HOST_SERVER;?>/cadSolucaoControversia"><i
								class="material-icons">swap_horiz</i>Solução de controvérsia</a></li>
					</ul>
					<ul id='rel' class='dropdown-content'>
						<li><a class="black-text" href="#!"><i class="material-icons">face</i>Visita
								in Loco</a></li>
						<li><a class="black-text" href="#!"><i class="material-icons">location_city</i>Solução
								de controvérsia</a></li>
					</ul>
					<ul id='user' class='dropdown-content'>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/editUser/<?php echo Request::getSession('login')->getId();?>"><i
								class="material-icons">mode_edit</i>Alterar meus dados</a></li>
						<li><a class="black-text"
							href="<?php echo Configuracao::HOST_SERVER;?>/logout"><i
								class="material-icons">exit_to_app</i>Logoff</a></li>
					</ul>
					<ul class="hide-on-med-and-down">
						<li><a class='black-text' data-beloworigin="true"
							href="<?php echo Configuracao::HOST_SERVER;?>/"
							data-activates="profileopt"><img class="img-menu"
								src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/home.png"><b>
									Início</b></a></li>
						<li><a class='dropdown-button black-text' data-beloworigin="true"
							href='#' data-constrainwidth="false" data-activates='cad'
							id="cadastro" data-activates="profileopt"><img class="img-menu"
								src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/usuarios.png">
								<b> Cadastros</b></a></li>
						<li><a class='dropdown-button black-text' data-beloworigin="true"
							href='#' data-constrainwidth="false" data-activates='con'
							id="consulta" data-activates="profileopt"><img class="img-menu"
								src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/search.png"><b>
									Consultas</b></a></li>
						<li><a class='dropdown-button black-text' data-beloworigin="true"
							href='#' data-constrainwidth="false" data-activates='tec'
							id="rtec" data-activates="profileopt"><img class="img-menu"
								src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/relatorio.png"><b>
									Relatório Técnicos</b></a></li>
						<!-- 						<li><a class='dropdown-button black-text' data-beloworigin="true" -->
						<!-- 							href='#' data-constrainwidth="false" data-activates='rel' -->
						<!-- 							data-activates="profileopt"><img class="img-menu" -->
						<!-- 								src="<?php //echo Configuracao::HOST_SERVER; ?>/model/img/icone/relatorios.png"><b> -->
						<!-- 									Relatórios</b></a></li> -->
						<li><a class='black-text' data-beloworigin="true"
							href="<?php echo Configuracao::HOST_SERVER;?>/documentacao/manual.pdf"
							data-activates="profileopt" title="Ajuda" target="_blank"><i
								class="material-icons">help_outline</i></a></li>
					</ul>
					<ul class="right hide-on-med-and-down">
						<li><a class='dropdown-button black-text' data-beloworigin="true"
							href='#' data-constrainwidth="false" data-activates='user'
							data-activates="profileopt"><img width="40"
								style="vertical-align: middle;"
								src="<?php echo Configuracao::HOST_SERVER . "/model/img/avatar/" . $idAvatar . ".png";?>"><b>
									<?php echo Request::getSession('login')->getNome(); ?></b></a></li>

					</ul>
				</div>
			</nav>
		</div>
	</header>
	<?php Import::template('menu');?>
	<!-- Navbar -->