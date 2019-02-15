<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::ADM())
    Import::template('header');
Import::controller('ControllerMunicipio');
Import::controller('ControllerEstado');
Import::library('Redirect');

$controller = new ControllerMunicipio();
$estados = new ControllerEstado();

$municipio = $controller->getById($controller->Get('id'));

$controller->update();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar Município</span>

				<form method="post">
					<b>Município</b>
					<div class="row border">
						<div class="row col s12">
							<div class="col m6 s3">
								<label class="active">Estado:<i class="blue-text">*</i></label>
								<select name="estado" class="browser-default">
	<?php
foreach ($estados->getEstados() as $estado) {
    if ($estado->getId() == $municipio->getIdEstado())
        echo "<option value='" . $estado->getId() . "' selected>" . $estado->getSigla() . "</option>";
    else
        echo "<option value='" . $estado->getId() . "'>" . $estado->getSigla() . "</option>";
}
?>
								</select>
							</div>
							<div class="input-field col m6 s9">
								<input id="nome" type="text" name="nome" required="required"
									value="<?php echo $municipio->getNome();?>"> <label for="nome">Município:<i
									class="blue-text">*</i></label>
							</div>
						</div>
					</div>
					<b>Coordenadas Geográficas</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<input type="number" id="latitude" name="latitude"
									required="required" class="validate"
									value="<?php echo $municipio->getLatitude();?>"><label
									for="latitude">Latitude:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m6 s6">
								<input type="number" id="longitude" name="longitude"
									required="required" class="validate"
									value="<?php echo $municipio->getLongitude()?>"><label
									for="longitude">Longitude:<i class="blue-text">*</i></label>
							</div>
						</div>
					</div>
					<b>Caracterização do Território</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m4">
								<input type="number" id="area" name="area" required="required"
									class="validate" value="<?php echo $municipio->getArea();?>"><label
									for="area">Área:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m4">
								<input type="number" id="idmh" name="idmh" required="required"
									class="validate" value="<?php echo $municipio->getIdhm();?>"><label
									for="idmh">IDMH:<i class="blue-text">*</i></label>
							</div>
							<div class="input-field col m4">
								<input type="number" id="populacao" name="populacao"
									required="required" class="validate"
									value="<?php echo $municipio->getPopulacao();?>"><label
									for="populacao">Populacao:<i class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col m6 s12">
								<input type="number" id="dpopulacional" name="dpopulacional"
									required="required" class="validate"
									value="<?php echo $municipio->getDensidadePopulacional();?>"><label
									for="dpopulacional">Densidade Populacional:<i class="blue-text">*</i>
								</label>
							</div>
							<div class="input-field col m6 s12">
								<input type="number" id="dcapital" name="dcapital"
									required="required" class="validate"
									value="<?php echo $municipio->getDistanciaCapital();?>"><label
									for="dcapital">Distância até capital:<i class="blue-text">*</i>
								</label>
							</div>
						</div>
					</div>
					<b>Meios de Transporte para Acesso</b>
					<div class="row border">
						<br>
						<div class="row col s12">
							<div class="col m3 s6">
								<input type="checkbox" name="transp" value="carro" id="carro" />
								<label for="carro">Carro</label>
							</div>
							<div class="col m3 s6">
								<input type="checkbox" name="transp" value="barco" id="barco" />
								<label for="barco">Barco</label>
							</div>
							<div class="col m3 s6">
								<input type="checkbox" name="transp" value="aviao" id="aviao" />
								<label for="aviao">Avião</label>
							</div>
							<div class="col m3 s6">
								<input type="checkbox" name="transp" value="onibus" id="onibus" />
								<label for="onibus">Ônibus</label>
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
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/form.js"></script>
</body>
</html>