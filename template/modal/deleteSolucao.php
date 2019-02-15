<?php
include_once 'library/Import.php';

Import::library('Security');
Import::controller('ControllerSolucaoControversia');
$controller = new ControllerSolucaoControversia();
Security::SelfAndADM($controller->getById($controller->Get('id'))
    ->getIdUsuario());
Import::config('Configuracao');
?>
<div id="modal1" class="modal">
	<div class="modal-content">
		<h4>Deletar Solução de Controvérsia</h4>
		<p>Deseja realmente excluir?</p>
	</div>
	<div class="modal-footer">
		<form method="post">
			<a
				href="<?php echo Configuracao::HOST_SERVER . "/listSolucaoControversia";?>"
				class="modal-action modal-close waves-effect btn-flat red">Não</a>
			<button name="del" class="modal-action waves-effect btn-flat green">Sim</button>
		</form>
	</div>
</div>