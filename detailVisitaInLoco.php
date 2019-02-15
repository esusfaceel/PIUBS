<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::controller('ControllerVisitaInLoco');
Import::controller('ControllerUbs');
Import::controller('ControllerTipoPergunta');
Import::controller('ControllerArquivo');
Import::library('Redirect');

$tipoPergunta = new ControllerTipoPergunta();
$controller = new ControllerVisitaInLoco();
$arquivo = new ControllerArquivo();
$ubs = new ControllerUbs();

$visita = $controller->getById($controller->Get('id'));
$arquivos = $arquivo->getByIdVisita($controller->Get('id'));
$empresa = $controller->getEmpresaVisitaByIdVisita($controller->Get('id'));
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Visita in Loco</span>

				<div class="row border">
					<div class="row col s12">
						<div class="col m6 s6">
							<label>Data:</label><br> <span><?php echo $visita->getData();?></span>
						</div>
						<div class="col m6 s6">
							<label>UBS:</label><br> <span>
	<?php
foreach ($ubs->getAll() as $u) {
    if ($u->getId() == $visita->getIdUbs())
        echo $u->getNome();
}
?>
								</span>
						</div>
						<div class="row col s12">
	<?php
foreach ($empresa as $e) {
    echo "<div class=\"col m6 s6\"><label>Empresa:</label><br> <span>" . $e['razaoSocial'] . "</span>";
}
?>
								
						</div>
					</div>
				</div>
			</div>
			<b>Avaliação de implantação do sistema</b>
			<div class="row border">
					<?php $tipoPergunta->listPerguntas($controller->Get('id'));?>
					</div>
			<b>Anexos</b>
			<div class="row border">
				<?php

    foreach ($arquivos as $a) {
        ?>
					<div class="row col s12">
					<a
						href="../temp/<?php echo str_replace(' ', '%20', utf8_encode($a['nome']));?>"
						target="_blank"><?php echo $a['nome'];?><i class="material-icons">file_download</i></a>
				</div>
				<?php } ?>
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

<?php Import::template('footer');?>
</body>
</html>