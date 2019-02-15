<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::dao('TipoRespostaDao');
Import::library('Redirect');
Import::config('Configuracao');
Import::controller('ControllerPergunta');

$tipoRespostas = new TipoRespostaDao();

$controller = new ControllerPergunta();
$pergunta = $controller->getById($controller->Get('id'));
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Pergunta</span> <b>Pergunta</b>
				<div class="row border">
					<div class="row col s12">
						<div class="col m12 s12">
							<label>Pergunta:</label><br> <span><?php echo $pergunta->getDescricao(); ?></span>
						</div>
					</div>
					<div class="row col s12">
						<div class="col s12 m6">
							<label>Tipo resposta:</label><br> <span>
	<?php
foreach ($tipoRespostas->findAllAtivos() as $resposta) {
    if ($resposta['id'] == $pergunta->getIdTipoResposta())
        echo $resposta['descricao'];
}
?>
								</span>
						</div>
						<div class="col s12 m6 center">
							<br> <br> <input type="checkbox" id="required" name="required"
								disabled="disabled"
								<?php echo ($pergunta->isObrigatoria()) ? "checked='checked'" : "";?> />
							<label for="required">Obrigatória</label>
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
</div>

<?php Import::template('footer');?>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/mascaras.js"></script>
</body>
</html>