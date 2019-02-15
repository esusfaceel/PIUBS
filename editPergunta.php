<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::ADM())
    Import::template('header');
Import::dao('TipoRespostaDao');
Import::library('Redirect');
Import::config('Configuracao');
Import::controller('ControllerPergunta');

$tipoRespostas = new TipoRespostaDao();

$controller = new ControllerPergunta();
$pergunta = $controller->getById($controller->Get('id'));
$controller->update();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar Pergunta</span>

				<form method="post">
					<b>Pergunta</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m12 s12">
								<input id="pergunta" type="text" name="pergunta"
									required="required"
									value="<?php echo $pergunta->getDescricao(); ?>"> <label
									for="pergunta">Pergunta:<i class="blue-text">*</i></label>
							</div>
						</div>
						<div class="row col s12">
							<div class="col s12 m6">
								<label class="active" for="tresposta">Tipo resposta:<i
									class="blue-text">*</i></label> <select name="tresposta"
									class="browser-default">
	<?php
foreach ($tipoRespostas->findAllAtivos() as $resposta) {
    if ($resposta['id'] == $pergunta->getIdTipoResposta())
        echo "<option value='" . $resposta['id'] . "' selected>" . $resposta['descricao'] . "</option>";
    else
        echo "<option value='" . $resposta['id'] . "'>" . $resposta['descricao'] . "</option>";
}
?>
								</select>
							</div>
							<div class="col s12 m6 center">
								<br> <br> <input type="checkbox" id="required" name="required"
									<?php echo ($pergunta->isObrigatoria()) ? "checked='checked'" : "";?> />
								<label for="required">Obrigatória</label>
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
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/form.js"></script>
</body>
</html>