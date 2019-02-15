<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::SelfAndADM())
    Import::template('header');
Import::controller('ControllerUsuario');
Import::library('Redirect');
Import::dao('CargoDao');

$controller = new ControllerUsuario();

$user = $controller->getById($controller->Get('id'));
$controller->updateLogin();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar usuário</span>

				<form method="post">
					<b>Alterar Login</b>
					<div class="row border">
						<div class="row col s6 offset-s3">
							<div class="input-field">
								<input id="login" type="text" class="validate" name="login"
									required="required" value="<?php echo $user->getLogin();?>"> <label
									for="login">Login:<i class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s6 offset-s3">
							<div class="input-field">
								<input id="senhaAtual" type="password" class="validate"
									name="senhaAtual" title="Sua senha atual" required="required">
								<label for="senhaAtual">Sua Senha:<i class="blue-text">*</i></label>
							</div>
						</div>
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
<script type="text/javascript">
$(document).ready(function() {
    $('.modal').modal();
  });
</script>
</body>
</html>