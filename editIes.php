<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::ADM())
    Import::template('header');
Import::controller('ControllerIes');
Import::controller('ControllerMunicipio');
Import::controller('ControllerEstado');
Import::library('Redirect');
Import::config('Configuracao');

$controller = new ControllerIes();
$municipios = new ControllerMunicipio();
$estados = new ControllerEstado();

$ies = $controller->getById($controller->Get('id'));
$municipioOrigem = $municipios->getById($ies->getIdMunicipio());

$controller->update();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar IES</span>

				<form method="post">
					<b>Instituição</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s12">
								<input id="razao" type="text" name="razao" required="required"
									value="<?php echo $ies->getRazaoSocial();?>"> <label
									for="razao">Razão Social:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s12">
								<input id="sigla" type="text" name="sigla" required="required"
									value="<?php echo $ies->getSigla();?>"> <label for="sigla">Sigla:<i
									class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="col m6 s4">
								<label class="active">Estado:<i class="blue-text">*</i></label>
								<select name="estado" class="browser-default" id="estado">
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
    if ($municipio->getId() == $ies->getIdMunicipio())
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
								<input id="telefone" type="tel" pattern="\(\d{2}\) \d{5}-\d{4}"
									class="telefone" name="telefone" maxlength="15"
									required="required" value="<?php echo $ies->getTelefone();?>" /><label
									for="telefone">Contato:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input id="email" type="email" name="email" required="required"
									value="<?php echo $ies->getEmail();?>"> <label for="email">E-mail:<i
									class="blue-text">*</i></label>
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