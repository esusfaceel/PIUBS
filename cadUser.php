<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::ADM())
    Import::template('header');
Import::controller('ControllerIes');
Import::controller('ControllerTitulacao');
Import::controller('ControllerUsuario');
Import::library('Redirect');
Import::config('Configuracao');

$ies = new ControllerIes();
$titulacao = new ControllerTitulacao();
$controller = new ControllerUsuario();

$controller->cacheSave("cadUser2");
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Cadastro de usuário</span>

				<form method="post">
					<b>Dados pessoais</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field">
								<input id="name" type="text" class="validate" name="name"
									required="required"> <label for="name">Nome:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="col m6 s6">
								<label class="active">Sexo:<i class="blue-text">*</i></label> <select
									name="sexo" class="browser-default">
									<option value="Masculino">Masculino</option>
									<option value="Feminino">Feminino</option>
								</select>
							</div>
							<div class="input-field col m6 s6">
								<input id="dataNac" type="date" name="dataNac"
									required="required" max="<?php echo date('Y-m-d');?>"> <label
									for="dataNac" class="active">Data de Nascimento:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input id="telefone" type="tel" pattern="\(\d{2}\) \d{5}-\d{4}"
									class="validate telefone" name="telefone" maxlength="15"
									required="required" /><label for="telefone">Contato:<i
									class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input id="email" type="email" name="email" class="validate"
									required="required"> <label for="email">E-mail:<i
									class="blue-text">*</i></label>
							</div>
						</div>
					</div>
					<b>Documentos</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input type="number" max="9999999" id="rg" name="rg"
									required="required" class="validate"><label for="rg">RG:<i
									class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input type="text" id="cpf" name="cpf" class="validate"
									required="required" pattern="\d{3}.\d{3}.\d{3}-\d{2}"><label
									for="cpf">CPF:<i class="blue-text">*</i></label>
							</div>
						</div>
					</div>
					<b>Dados institucionais</b>
					<div class="row border">
						<div class="row col s12">
							<div class="col m6 s6">
								<label class="active">IES:<i class="blue-text">*</i></label> <select
									class="browser-default" name="ies">
									<?php

        foreach ($ies->getAll() as $i) {
            echo "<option value='" . $i->getId() . "'>" . $i->getSigla() . "</option>";
        }
        ?>
								</select>
							</div>
							<div class="col m6 s6">
								<label class="active">Titulação:<i class="blue-text">*</i></label>
								<select name="titulacao" class="browser-default">
									<?php

        foreach ($titulacao->getTitulacoes() as $titulo) {
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
						<button type="submit" name="avancar"
							class="waves-effect waves-light btn grey">
							Avançar <i class="material-icons left">arrow_forward</i>
						</button>
					</div>
				</form>
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