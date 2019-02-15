<?php
include_once 'library/Import.php';

Import::controller('ControllerUsuario');

$controller = new ControllerUsuario();
?>
<div id="modal1" class="modal">
	<div class="modal-content">
		<h4>Avatares</h4>
		<div class="row">
			<?php  $controller->listAvatar();?>
		</div>
		<div class="modal-footer">
			<button type="button"
				class="modal-action modal-close waves-effect btn-flat grey waves-green">Selecionar</button>
		</div>
	</div>
</div>