<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::controller('ControllerEmpresa');
Import::controller('ControllerEstado');
Import::library('Redirect');
Import::config('Configuracao');

$controller = new ControllerEmpresa();
$estados = new ControllerEstado();

$controller->cadastro();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<h5 class="center">Cadastro de Empresa</h5>

				<form method="post">
					<b>Instituição</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6  s12">
								<input id="razao" type="text" name="razao" required="required">
								<label for="razao">Razão Social:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s12">
								<input id="cnpj" type="text" name="cnpj" required="required"> <label
									for="cnpj">CNPJ:<i class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="col m6 s4">
								<label class="active">Estado:<i class="blue-text">*</i></label>
								<select name="estado" id="estado" class="browser-default">
									<?php
        foreach ($estados->getEstados() as $estado) {
            echo "<option value='" . $estado->getId() . "'>" . $estado->getSigla() . "</option>";
        }
        ?>
								</select>
							</div>
							<div class="col m6 s8">
								<label class="active">Município:<i class="blue-text">*</i></label>
								<select name="municipio" class="municipio browser-default">
									<option>---SELECIONE UM ESTADO---</option>
								</select>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input id="email" type="email" name="email" required="required">
								<label for="email">E-mail:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input id="telefone" type="tel" pattern="\(\d{2}\) \d{5}-\d{4}"
									class="validate telefone" name="telefone" maxlength="15"
									required="required" /><label for="telefone">Contato:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m12 s12">
								<input id="telefone2" type="tel" pattern="\(\d{2}\) \d{5}-\d{4}"
									class="validate telefone" name="telefone2" maxlength="15" /><label
									for="telefone2">Contato alternativo:</label>
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
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/cidades.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/form.js"></script>
</body>
</html>