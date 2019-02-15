<?php
include_once 'library/Import.php';

Import::library('Security');
Security::ADM();
Import::config('Configuracao');
?>
<div id="modal1" class="modal">
	<div class="modal-content">
		<h4>Deletar Pergunta</h4>
		<p>Deseja realmente excluir?</p>
	</div>
	<div class="modal-footer">
		<form method="post">
			<a href="<?php echo Configuracao::HOST_SERVER . "/listPergunta";?>"
				class="modal-action modal-close waves-effect btn-flat red">Não</a>
			<button name="del" class="modal-action waves-effect btn-flat green">Sim</button>
		</form>
	</div>
</div>