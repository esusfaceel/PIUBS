<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::ADM())
    Import::template('header');
Import::controller('ControllerMunicipio');
Import::controller('ControllerEstado');
Import::controller('ControllerUbs');
Import::library('Redirect');
Import::config('Configuracao');

$municipios = new ControllerMunicipio();
$estados = new ControllerEstado();
$controller = new ControllerUbs();

$ubs = $controller->getById($controller->Get('id'));
$municipioOrigem = $municipios->getById($ubs->getIdMunicipio());
$controller->update();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar UBS</span>

				<form method="post">
					<b>Unidade básica de saúde</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s7">
								<input id="nome" type="text" name="nome" required="required"
									value="<?php echo $ubs->getNome();?>"> <label for="nome">Unidade:<i
									class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s5">
								<input id="cnpj" type="text" name="cnpj" required="required"
									value="<?php echo $ubs->getCnpj();?>"> <label for="cnpj">CNPJ:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m6 s7">
								<input id="end" type="text" name="end" required="required"
									value="<?php echo $ubs->getEndereco();?>"> <label for="end">Endereço:<i
									class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s5">
								<input id="bairro" type="text" name="bairro" required="required"
									value="<?php echo $ubs->getBairro();?>"> <label for="bairro">Bairro:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="col m6 s4">
								<label class="active">Estado:<i class="blue-text">*</i></label>
								<select name="estado" id="estado" class="browser-default">
	<?php
foreach ($estados->getEstados() as $estado) {
    if ($estado->getId() == $municipioOrigem->getIdEstado())
        echo "<option value='" . $estado->getId() . "' selected>" . $estado->getSigla() . "</option>";
    else
        echo "<option value='" . $estado->getId() . "'>" . $estado->getSigla() . "</option>";
}
?>
								</select>
							</div>
							<div class="col m6 s8">
								<label class="active">Município:<i class="blue-text">*</i></label>
								<select name="municipio" class="municipio browser-default">
	<?php
foreach ($municipios->getMunicipiosByEstado($municipioOrigem->getIdEstado()) as $municipio) {
    if ($municipio->getId() == $ubs->getIdMunicipio())
        echo "<option value='" . $municipio->getId() . "' selected>" . $municipio->getNome() . "</option>";
    else
        echo "<option value='" . $municipio->getId() . "'>" . $municipio->getNome() . "</option>";
}
?>
								</select>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input id="cep" type="text" name="cep" required="required"
									value="<?php echo $ubs->getCep();?>"> <label for="cep">CEP:<i
									class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input id="email" type="text" name="email" required="required"
									value="<?php echo $ubs->getEmail();?>"> <label for="email">E-mail:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input id="telefone1" name="telefone1" type="tel"
									pattern="\(\d{2}\) \d{5}-\d{4}" maxlength="15"
									required="required" class="telefone"
									value="<?php echo $ubs->getTelefone1();?>"> <label
									for="telefone1">Telefone:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input id="telefone2" name="telefone2" type="tel"
									class="telefone" pattern="\(\d{2}\) \d{5}-\d{4}" maxlength="15"
									value="<?php echo $ubs->getTelefone2();?>"> <label
									for="telefone2">Telefone:</label>
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
</body>
</html>