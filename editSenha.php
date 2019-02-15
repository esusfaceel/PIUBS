<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::SelfAndADM())
    Import::template('header');
Import::controller('ControllerUsuario');
Import::library('Redirect');
Import::dao('CargoDao');

$controller = new ControllerUsuario();
$cargoDao = new CargoDao();
$cargos = $cargoDao->findAll();

$user = $controller->getById($controller->Get('id'));
$controller->updateAcesso();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar usuário</span>

				<form method="post">
					<b>Dados de acesso</b>
					<div class="row border">
						<div class="row col s6 offset-s3">
							<div class="input-field">
								<input id="senhaAtual" type="password" class="validate"
									name="senhaAtual" required="required"> <label for="senhaAtual">Sua
									Senha Atual:<i class="blue-text">*</i>
								</label>
							</div>
						</div>
						<div class="row col s6 offset-s3">
							<div class="input-field">
								<input id="senha" type="password" class="validate" name="senha"
									required="required"> <label for="senha">Nova Senha:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s6 offset-s3">
							<div class="input-field">
								<input id="csenha" type="password" class="validate"
									name="csenha" required="required"> <label for="csenha">Confirme
									a Sua Nova Senha:<i class="blue-text">*</i>
								</label>
							</div>
						</div>
						<?php if ($controller->getUsuarioLogado()->getIdCargo() === Security::ADM){?>
						<div class="row col s6 offset-s3">
							<label class="active">Cargo:<i class="blue-text">*</i></label> <select
								name="cargo" class="browser-default">
									<?php

        foreach ($cargos as $cargo) {
            if ($cargo['id'] == $user->getIdCargo())
                echo "<option value='" . $cargo['id'] . "' selected>" . $cargo['descricao'] . "</option>";
            else
                echo "<option value='" . $cargo['id'] . "'>" . $cargo['descricao'] . "</option>";
        }
        ?>
							</select>
						</div>
						<?php } ?>
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