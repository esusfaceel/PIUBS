<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
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
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">IES</span> <b>Instituição</b>
				<div class="row border">
					<div class="row col s12">
						<div class="col m6 s12">
							<label>Razão Social: </label><br> <span><?php echo $ies->getRazaoSocial();?></span>
						</div>
						<div class="col m6 s12">
							<label>Sigla:</label><br> <span><?php echo $ies->getSigla();?></span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col m6 s4">
							<label>Estado:</label><br> <span>
	<?php
foreach ($estados->getEstados() as $estado) {
    if ($estado->getId() == $municipioOrigem->getIdEstado())
        echo $estado->getNome() . " - " . $estado->getSigla();
}
?>
								</span>
						</div>
						<div class="col m6 s8">
							<label>Município:</label><br> <span>
	<?php
foreach ($municipios->getMunicipiosByEstado($municipioOrigem->getIdEstado()) as $municipio) {
    if ($municipio->getId() == $ies->getIdMunicipio())
        echo $municipio->getNome();
}
?>
								</span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Contato:</label><br> <span><?php echo $ies->getTelefone();?></span>
						</div>
						<div class="col m6 s6">
							<label>E-mail:</label><br> <span><?php echo $ies->getEmail();?></span>
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
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/mascaras.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/cidades.js"></script>
</body>
</html>