<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::SelfAndADM())
    Import::template('header');
Import::controller('ControllerUsuario');
Import::library('Redirect');

$controller = new ControllerUsuario();
$controller->updateAvatar();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar usuário</span>

				<form method="post">
					<b>Avatar</b>
					<div class="row border">
							<?php $controller->listAvatar();?>
					</div>
					<div class="row center">
						<button type="button"
							onclick="<?php Redirect::Redirect_To_Index_For_OnClick();?>"
							class="waves-effect waves-light btn grey">
							Cancelar <i class="material-icons left">close</i>
						</button>
						<button type="button" class="waves-effect waves-light btn grey"
							onclick="<?php Redirect::BackForOnclick();?>">
							Voltar <i class="material-icons left">arrow_back</i>
						</button>
						<button type="submit" name="salvar"
							class="waves-effect waves-light btn grey">
							Salvar <i class="material-icons left">save</i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php Import::template('footer');?>
</body>
</html>