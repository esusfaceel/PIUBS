<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::controller('ControllerMunicipio');
Import::controller('ControllerEstado');
Import::library('Redirect');

$controller = new ControllerMunicipio();
$estados = new ControllerEstado();

$municipio = $controller->getById($controller->Get('id'));
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Município</span> <b>Município</b>
				<div class="row border">
					<div class="row col s12">
						<div class="col m6 s5">
							<label>Estado:</label> <br> <span><?php
    foreach ($estados->getEstados() as $estado) {
        if ($estado->getId() == $municipio->getIdEstado())
            echo $estado->getNome() . " - " . $estado->getSigla();
    }
    ?></span>
						</div>
						<div class="col m6 s7">
							<label>Município:</label> <br> <span><?php echo $municipio->getNome();?></span>
						</div>
					</div>
				</div>
				<b>Coordenadas Geográficas</b>
				<div class="row border">
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Latitude:</label><br> <span><?php echo $municipio->getLatitude();?></span>
						</div>
						<div class="col m6 s6">
							<label>Longitude:</label><br> <span><?php echo $municipio->getLongitude()?></span>
						</div>
					</div>
				</div>
				<b>Caracterização do Território</b>
				<div class="row border">
					<div class="row col s12">
						<div class="col m4 s4">
							<label>Área:</label><br> <span><?php echo $municipio->getArea();?></span>
						</div>
						<div class="col m4 s4">
							<label>IDMH:</label><br> <span><?php echo $municipio->getIdhm();?></span>
						</div>
						<div class="col m4 s4">
							<label>Populacao:</label><br> <span><?php echo $municipio->getPopulacao();?></span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Densidade Populacional: </label><br> <span><?php echo $municipio->getDensidadePopulacional();?></span>
						</div>
						<div class="col m6 s6">
							<label>Distância até capital: </label><br> <span><?php echo ($municipio->getDistanciaCapital() != null) ? $municipio->getDistanciaCapital() : "-";?></span>
						</div>
					</div>
				</div>
				<b>Meios de Transporte para Acesso</b>
				<div class="row border">
					<br>
					<div class="row col s12">
						<div class="col m3 s6">
							<input type="checkbox" name="transp" value="carro" id="carro"
								disabled="disabled" /> <label for="carro">Carro</label>
						</div>
						<div class="col m3 s6">
							<input type="checkbox" name="transp" value="barco" id="barco"
								disabled="disabled" /> <label for="barco">Barco</label>
						</div>
						<div class="col m3 s6">
							<input type="checkbox" name="transp" value="aviao" id="aviao"
								disabled="disabled" /> <label for="aviao">Avião</label>
						</div>
						<div class="col m3 s6">
							<input type="checkbox" name="transp" value="onibus" id="onibus"
								disabled="disabled" /> <label for="onibus">Ônibus</label>
						</div>
					</div>
				</div>
				<div class="row center">
					<button type="button" class="waves-effect waves-light btn grey"
						onclick="<?php Redirect::BackForOnclick();?>">
						Voltar <i class="material-icons left">arrow_back</i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php Import::template('footer');?>
</body>
</html>