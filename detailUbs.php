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
Import::controller('ControllerUbs');
Import::library('Redirect');
Import::config('Configuracao');

$municipios = new ControllerMunicipio();
$estados = new ControllerEstado();
$controller = new ControllerUbs();

$ubs = $controller->getById($controller->Get('id'));
$municipioOrigem = $municipios->getById($ubs->getIdMunicipio());
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">UBS</span> <b>Unidade básica de
					saúde</b>
				<div class="row border">
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Unidade:</label><br> <span><?php echo $ubs->getNome();?></span>
						</div>
						<div class="col m6 s6">
							<label>CNPJ:</label><br> <span><?php echo $ubs->getCnpj();?></span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Endereço:</label><br> <span><?php echo $ubs->getEndereco();?></span>
						</div>
						<div class="col m6 s6">
							<label>Bairro:</label><br> <span><?php echo $ubs->getBairro();?></span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Estado:</label><br> <span>
	<?php
foreach ($estados->getEstados() as $estado) {
    if ($estado->getId() == $municipioOrigem->getIdEstado())
        echo $estado->getNome() . " - " . $estado->getSigla();
}
?>
								</span>

						</div>
						<div class="col m6 s6">
							<label>Município:</label><br> <span>
	<?php
foreach ($municipios->getMunicipiosByEstado($municipioOrigem->getIdEstado()) as $municipio) {
    if ($municipio->getId() == $ubs->getIdMunicipio())
        echo $municipio->getNome();
}
?>
								</span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col m6 s6">
							<label>CEP:</label><br> <span><?php echo $ubs->getCep();?></span>
						</div>
						<div class="col m6 s6">
							<label>E-mail:</label><br> <span><?php echo $ubs->getEmail();?></span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Telefone:</label><br> <span><?php echo $ubs->getTelefone1();?></span>
						</div>
						<div class="col m6 s6">
							<label>Telefone:</label><br> <span><?php echo $ubs->getTelefone2();?></span>
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