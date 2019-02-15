<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::SelfAndADM())
    Import::template('header');
Import::controller('ControllerIes');
Import::controller('ControllerTitulacao');
Import::controller('ControllerUsuario');
Import::library('Redirect');
Import::entidade('Usuario');
Import::config('Configuracao');

$ies = new ControllerIes();
$titulacao = new ControllerTitulacao();
$controller = new ControllerUsuario();

$user = $controller->getById($controller->Get('id'));
$controller->update();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar usuário</span>

				<form method="post">
					<b>Dados pessoais</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field">
								<input id="name" type="text" class="validate" name="name"
									required="required" value="<?php echo $user->getNome();?>"> <label
									for="name">Nome:<i class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="col m6 s6">
								<label class="active">Sexo:<i class="blue-text">*</i></label> <select
									name="sexo" class="browser-default">
									<option value="Masculino"
										<?php echo ($user->getSexo() == "Masculino") ? "selected" : "";?>>Masculino</option>
									<option value="Feminino"
										<?php echo ($user->getSexo() == "Feminino") ? "selected" : "";?>>Feminino</option>
								</select>
							</div>
							<div class="input-field col m6 s6">
								<input id="dataNac" type="date" name="dataNac"
									required="required" max="<?php echo date('Y-m-d');?>"
									value="<?php echo $user->getDataNasc();?>"> <label
									for="dataNac" class="active">Data de Nascimento:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input id="telefone" type="tel" pattern="\(\d{2}\) \d{5}-\d{4}"
									class="validate telefone" name="telefone" maxlength="15"
									value="<?php echo $user->getCelular();?>" required="required" /><label
									for="telefone">Contato:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input id="email" type="email" name="email" class="validate"
									value="<?php echo $user->getEmail();?>" required="required"> <label
									for="email">E-mail:<i class="blue-text">*</i></label>
							</div>
						</div>
					</div>
					<b>Documentos</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input type="number" max="9999999" id="rg" name="rg"
									required="required" value="<?php echo $user->getRg();?>"
									class="validate"><label for="rg">RG:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input type="text" id="cpf" name="cpf" class="validate"
									required="required" value="<?php echo $user->getCpf();?>"
									pattern="\d{3}.\d{3}.\d{3}-\d{2}"><label for="cpf">CPF:<i
									class="blue-text">*</i></label>
							</div>
						</div>
					</div>
					<b>Dados institucionais</b>
					<div class="row border">
						<div class="row col s12">
							<div class="col m6 s6">
								<label class="active">IES:<i class="blue-text">*</i></label> <select
									name="ies" class="browser-default">
									<?php

        foreach ($ies->getAll() as $i) {
            if ($i->getId() == $user->getIdIes())
                echo "<option value='" . $i->getId() . "' selected>" . $i->getSigla() . "</option>";
            else
                echo "<option value='" . $i->getId() . "' >" . $i->getSigla() . "</option>";
        }
        ?>
								</select>
							</div>
							<div class="col m6 s6">
								<label class="active">Titulação:<i class="blue-text">*</i></label>
								<select name="titulacao" class="browser-default">
									<?php

        foreach ($titulacao->getTitulacoes() as $titulo) {
            if ($titulo->getId() == $user->getIdTitulacao())
                echo "<option value='" . $titulo->getId() . "' selected>" . $titulo->getDescricao() . "</option>";
            else
                echo "<option value='" . $titulo->getId() . "'>" . $titulo->getDescricao() . "</option>";
        }
        ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row center">
						<button type="button" class="waves-effect waves-light btn grey"
							onclick="<?php Redirect::BackForOnclick();?>">
							Cancelar <i class="material-icons left">close</i>
						</button>
						<button type="button" class="waves-effect waves-light btn grey"
							onclick="cancelar();">
							Limpar <i class="material-icons left">delete</i>
						</button>
						<button type="submit" name="salvar"
							class="waves-effect waves-light btn grey">
							Salvar <i class="material-icons left">save</i>
						</button>
					</div>

				</form>
				<div class="row center">
					<button type="button"
						onclick="<?php Redirect::Redirect_To_View_For_OnClick("editAvatar/" . $controller->Get('id'));?>"
						class="waves-effect waves-light btn grey">
						Alterar Avatar <i class="material-icons left">account_circle</i>
					</button>
					<button type="button"
						onclick="<?php Redirect::Redirect_To_View_For_OnClick("editLogin/" . $controller->Get('id'));?>"
						class="waves-effect waves-light btn grey">
						Alterar login <i class="material-icons left">account_box</i>
					</button>
					<button type="button"
						onclick="<?php Redirect::Redirect_To_View_For_OnClick("editSenha/" . $controller->Get('id'));?>"
						class="waves-effect waves-light btn grey">
						Alterar senha <i class="material-icons left">vpn_key</i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php Import::template('footer');?>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/mascaras.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/form.js"></script>
</body>
</html>