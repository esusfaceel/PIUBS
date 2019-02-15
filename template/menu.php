<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::config('Configuracao');
Import::library('Request');
Import::entidade('Usuario');
?>
<ul id="slide-out" class="side-nav">
	<li>
		<ul class="collapsible collapsible-accordion">
			<li><a class="collapsible-header"
				href="<?php echo Configuracao::HOST_SERVER;?>/"><img
					class="img-menu"
					src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/home.png"><b>
						Início</b></a></li>
		</ul>
	</li>
	<li>
		<ul class="collapsible collapsible-accordion">
			<li><a class="collapsible-header"><img class="img-menu"
					src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/usuarios.png"><b>Cadastros</b><i
					class="material-icons right">arrow_drop_down</i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadUser"><i
								class="material-icons">face</i>Usuário</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadMunicipio"><i
								class="material-icons">location_city</i>Município</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadIes"><i
								class="material-icons">account_balance</i>IES</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadEmpresa"><i
								class="material-icons">business</i>Empresa</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadUbs"><i
								class="material-icons">local_hospital</i>UBS</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/cadPergunta"><i
								class="material-icons">help</i>Pergunta Visita In Loco</a></li>
					</ul>
				</div></li>
		</ul>
	</li>
	<li>
		<ul class="collapsible collapsible-accordion">
			<li><a class="collapsible-header"><img class="img-menu"
					src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/search.png"><b>Consultas</b><i
					class="material-icons right">arrow_drop_down</i></a>
				<div class="collapsible-body">
					<ul>
						<li><a
							href="<?php echo Configuracao::HOST_SERVER;?>/listVisitaInLoco"><i
								class="material-icons">check_circle</i>Visita in Loco</a></li>
						<li><a
							href="<?php echo Configuracao::HOST_SERVER;?>/listSolucaoControversia"><i
								class="material-icons">swap_horiz</i>Solução de controvérsia</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/listUsers"><i
								class="material-icons">face</i>Usuário</a></li>
						<li><a
							href="<?php echo Configuracao::HOST_SERVER;?>/listMunicipio"><i
								class="material-icons">location_city</i>Município</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/listIes"><i
								class="material-icons">account_balance</i>IES</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/listEmpresa"><i
								class="material-icons">business</i>Empresa</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/listUbs"><i
								class="material-icons">local_hospital</i>UBS</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/listPergunta"><i
								class="material-icons">help</i>Pergunta Visita In Loco</a></li>
					</ul>
				</div></li>
		</ul>
	</li>
	<li>
		<ul class="collapsible collapsible-accordion">
			<li><a class="collapsible-header"><img class="img-menu"
					src="<?php echo Configuracao::HOST_SERVER; ?>/model/img/icone/relatorio.png"><b>Relatório
						Técnicos</b><i class="material-icons right">arrow_drop_down</i></a>
				<div class="collapsible-body">
					<ul>
						<li><a
							href="<?php echo Configuracao::HOST_SERVER;?>/cadVisitaInLoco"><i
								class="material-icons">check_circle</i>Visita in Loco</a></li>
						<li><a
							href="<?php echo Configuracao::HOST_SERVER;?>/cadSolucaoControversia"><i
								class="material-icons">swap_horiz</i>Solução de controvérsia</a></li>
					</ul>
				</div></li>
		</ul>
	</li>
	<!-- 	<li><ul class="collapsible collapsible-accordion"> -->
	<!-- 			<li><a class="collapsible-header"><img class="img-menu" -->
	<!-- 					src="<?php //echo Configuracao::HOST_SERVER; ?>/model/img/icone/relatorios.png"><b>Relatórios</b><i -->
	<!-- 					class="material-icons right">arrow_drop_down</i></a> -->
	<!-- 				<div class="collapsible-body"> -->
	<!-- 					<ul> -->
	<!-- 						<li><a href="#!"><i class="material-icons">face</i>Visita in Loco</a></li> -->
	<!-- 						<li><a href="#!"><i class="material-icons">location_city</i>Solução -->
	<!-- 								de controvérsia</a></li> -->
	<!-- 					</ul> -->
	<!-- 				</div></li> -->
	<!-- 		</ul></li> -->
	<li>
		<ul class="collapsible collapsible-accordion">
			<li><a class="collapsible-header" title="Ajuda" target="_blank"
				href="<?php echo Configuracao::HOST_SERVER;?>/documentacao/manual.pdf"><i
					class="material-icons">help_outline</i>Help</a></li>
		</ul>
	</li>
	<li><div class="divider"></div></li>
	<li><ul class="collapsible collapsible-accordion">
			<li><a class="collapsible-header"><img class="img-menu" width="40"
					src="<?php echo Configuracao::HOST_SERVER . "/model/img/avatar/" . Request::getSession('login')->getIdAvatar() . ".png"; ?>"><b>
					<?php echo Request::getSession('login')->getNome(); ?></b><i
					class="material-icons right">arrow_drop_down</i></a>
				<div class="collapsible-body">
					<ul>
						<li><a
							href="<?php echo Configuracao::HOST_SERVER;?>/editUser/<?php echo Request::getSession('login')->getId();?>"><i
								class="material-icons">mode_edit</i>Alterar meus dados</a></li>
						<li><a href="<?php echo Configuracao::HOST_SERVER;?>/logout"><i
								class="material-icons">exit_to_app</i>Logoff</a></li>
					</ul>
				</div></li>
		</ul></li>
</ul>