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
Import::controller('ControllerSolucaoControversia');
Import::controller('ControllerArquivo');
Import::library('Redirect');

$controller = new ControllerSolucaoControversia();
$arquivo = new ControllerArquivo();

$solucao = $controller->getById($controller->Get('id'));
$arquivosRequerente = $arquivo->getByIdSolucao($controller->Get('id'), ControllerArquivo::REQUIRENTE);
$arquivosRequerido = $arquivo->getByIdSolucao($controller->Get('id'), ControllerArquivo::REQUERIDO);
$arquivosAvaliacao = $arquivo->getByIdSolucao($controller->Get('id'), ControllerArquivo::AVALIACAO);
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Solução de Controvérsia</span>

				<div class="row border">
					<div class="row col s12">
						<label>Data:</label><br> <?php echo $solucao->getData();?>
					</div>
				</div>
				<b>Requerente</b>
				<div class="row border">
					<div class="row col s12">
						<div class="switch center">
							<label><font size="3">UBS</font><input type="checkbox"
								onload="switchs();" onchange="switchs();" id="switch"
								name="switch" disabled> <span class="lever"></span> <font
								size="3">Empresa</font></label>
						</div>
					</div>
					<div class="col m6 s12">
						<label>Requerente:</label><br>
								<?php echo ($solucao->getRequerenteEmpresa()) ? $solucao->getRequerenteEmpresa() : $solucao->getRequerenteUbs();?>
					</div>
				</div>

				<b>Requerido</b>
				<div class="row border">
					<div class="col m6 s6">
						<label>Requerido:</label> <br>
						<?php echo ($solucao->getRequeridoEmpresa()) ? $solucao->getRequeridoEmpresa() : $solucao->getRequeridoUbs();?>
					</div>
				</div>

				<b>Informações do Requerente</b>
				<div class="row border">
					<div class="row col s12">
						<label>Descrição:</label><br>
							<?php echo $solucao->getRequerenteDescricao();?>
					</div>
					<div class="row col s12">
						<label>Argumentação:</label><br>
							<?php echo $solucao->getRequerenteArgumentacao();?>
					</div>
					<b>Anexos</b>
					<div>
				<?php
    if ($arquivosRequerente) {
        foreach ($arquivosRequerente as $a) {
            ?>
     					<div class="row col s12">
							<a
								href="../temp/<?php echo str_replace(' ', '%20', utf8_encode($a['nome']));?>"
								target="_blank"><?php echo $a['nome'];?><i
								class="material-icons">file_download</i></a>
						</div>
				<?php
        }
    } else
        echo "Não há anexos!";
    ?>
					</div>
				</div>

				<b>Informações do Requerido</b>
				<div class="row border">
					<div class="row col s12">
						<label>Argumentação:</label><br>
							<?php echo $solucao->getRequeridoArgumentacao();?>
					</div>
					<b>Anexos</b>
					<div>
				<?php
    if ($arquivosRequerido) {
        foreach ($arquivosRequerido as $a) {
            ?>
     					<div class="row col s12">
							<a
								href="../temp/<?php echo str_replace(' ', '%20', utf8_encode($a['nome']));?>"
								target="_blank"><?php echo $a['nome'];?><i
								class="material-icons">file_download</i></a>
						</div>
				<?php
        }
    } else
        echo "Não há anexos!";
    ?>
					</div>
				</div>

				<b>Avaliação Controvérsia</b>
				<div class="row border">
					<div class="row col s12">
						<label>Descrição:</label><br>
							<?php echo $solucao->getAvaliacaoDescricao();?>
					</div>
					<b>Anexos</b>
					<div>
				<?php
    if ($arquivosAvaliacao) {
        foreach ($arquivosAvaliacao as $a) {
            ?>
     					<div class="row col s12">
							<a
								href="../temp/<?php echo str_replace(' ', '%20', utf8_encode($a['nome']));?>"
								target="_blank"><?php echo $a['nome'];?><i
								class="material-icons">file_download</i></a>
						</div>
				<?php
        }
    } else
        echo "Não há anexos!";
    ?>
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