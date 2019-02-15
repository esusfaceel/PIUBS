<?php
include_once 'library/Import.php';

Import::library('Security');

Import::controller('ControllerSolucaoControversia');
$controller = new ControllerSolucaoControversia();
$solucao = $controller->getById($controller->Get('id'));
if (Security::SelfAndADM($solucao->getIdUsuario()))
    Import::template('header');
Import::library('Redirect');
Import::controller('ControllerArquivo');
Import::controller('ControllerUbs');
Import::controller('ControllerEmpresa');
Import::config('Configuracao');

$ubs = new ControllerUbs();
$empresa = new ControllerEmpresa();
$arquivo = new ControllerArquivo();

$arquivosRequerente = $arquivo->getByIdSolucao($controller->Get('id'), ControllerArquivo::REQUIRENTE);
$arquivosRequerido = $arquivo->getByIdSolucao($controller->Get('id'), ControllerArquivo::REQUERIDO);
$arquivosAvaliacao = $arquivo->getByIdSolucao($controller->Get('id'), ControllerArquivo::AVALIACAO);

$controller->update();
$arquivo->deleteSolucaoControversia();
if (basename(dirname(dirname($_SERVER['REQUEST_URI']))) == "deleteFileSolucao") {
    Import::template('modal/deleteFileSolucao');
}
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Solução de Controvérsia</span>

				<form method="post" enctype="multipart/form-data">
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<label for="date" class="active">Data:<i class="blue-text">*</i></label>
								<input id="date" type="date" name="date" required="required"
									value="<?php echo $solucao->getData();?>">
							</div>
						</div>
					</div>
					<b>Requerente</b>
					<div class="row border">
						<div class="row col s12">
							<div class="switch center">
								<label><font size="3">UBS</font><input type="checkbox"
									<?php echo ($solucao->getRequerenteEmpresa()) ? "checked" : "";?>
									onload="switchs();" onchange="switchs();" id="switch"
									name="switch"> <span class="lever"></span> <font size="3">Empresa</font></label>
							</div>
						</div>
						<div class="row col s12">
							<div id="ubs1">
								<div class="col m6 s6">
									<label class="active">UBS:<i class="blue-text">*</i></label> <select
										name="ubs" class="browser-default">
	<?php
foreach ($ubs->getAll() as $u) {
    if ($u->getId() == $solucao->getRequerenteUbs())
        echo "<option value='" . $u->getId() . "' selected>" . $u->getNome() . "</option>";
    else
        echo "<option value='" . $u->getId() . "'>" . $u->getNome() . "</option>";
}
?>
								</select>
								</div>
							</div>
							<div id="empresa1">
								<div class="col m6 s6">
									<label class="active">Empresa:<i class="blue-text">*</i></label>
									<select name="requerenteEmpresa" class="browser-default">
									<?php
        foreach ($empresa->getAll() as $empresas) {
            if ($empresas->getRazaoSocial() == $solucao->getRequerenteEmpresa())
                echo "<option value='" . $empresas->getId() . "' selected>" . $empresas->getRazaoSocial() . "</option>";
            else
                echo "<option value='" . $empresas->getId() . "'>" . $empresas->getRazaoSocial() . "</option>";
        }
        ?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<b>Requerido</b>
					<div class="row border">
						<div id="ubs2">
							<div class="col m6 s6">
								<label class="active">UBS:<i class="blue-text">*</i></label> <select
									name="requeridoUbs" class="ubsRequerido browser-default">
									<?php
        foreach ($ubs->getAll() as $u) {
            if ($u->getId() == $solucao->getRequeridoUbs())
                echo "<option value='" . $u->getId() . "' selected>" . $u->getNome() . "</option>";
            else
                echo "<option value='" . $u->getId() . "'>" . $u->getNome() . "</option>";
        }
        ?>
								</select>
							</div>
						</div>
						<div id="empresa2">
							<div class="col m6 s6">
								<label class="active">Empresa:<i class="blue-text">*</i></label>
								<select name="requeridoEmpresa" class="browser-default">
									<?php
        foreach ($empresa->getAll() as $empresas) {
            if ($empresas->getRazaoSocial() == $solucao->getRequeridoEmpresa())
                echo "<option value='" . $empresas->getId() . "' selected>" . $empresas->getRazaoSocial() . "</option>";
            else
                echo "<option value='" . $empresas->getId() . "'>" . $empresas->getRazaoSocial() . "</option>";
        }
        ?>
								</select>
							</div>
						</div>
					</div>

					<b>Informações do Requerente</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col s12">
								Descrição:
								<textarea id="requerenteDescricao" name="requerenteDescricao"
									class="bigtextarea"><?php echo $solucao->getRequerenteDescricao();?></textarea>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col s12">
								Argumentação:
								<textarea id="requerenteArgumentacao"
									name="requerenteArgumentacao" class="bigtextarea">
									<?php echo $solucao->getRequerenteArgumentacao();?></textarea>
							</div>
						</div>
						<b>Anexos</b>
						<div class="row">
						<?php
    foreach ($arquivosRequerente as $a) {
        ?>
        				<div class="row">
								<div class="col s6 m6">
									<a
										href="<?php echo Configuracao::HOST_SERVER . "/temp/" . str_replace(' ', '%20', utf8_encode($a['nome']));?>"
										target="_blank" title="Download"><?php echo $a['nome'];?>&nbsp;<i
										class="material-icons">file_download</i></a>
								</div>
								<div class="col s6 m6">
									<a
										href='<?php echo Configuracao::HOST_SERVER . "/deleteFileSolucao/" . $a['idArquivo'] . "/" . $controller->Get('id'); ?>'
										title="Deletar"><i class='material-icons right'>delete</i></a>
								</div>
							</div>
				<?php } ?>
							<div class="row col s12 m12">
								<input type="file" name="arquivo[]"
									accept=".png, .jpg, .jpeg, .pdf, .zip, .rar"
									multiple="multiple" />
							</div>
						</div>
					</div>

					<b>Informações do Requerido</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col s12">
								Argumentação:
								<textarea id="requeridoArgumentacao"
									name="requeridoArgumentacao" class="bigtextarea">
									<?php echo $solucao->getRequeridoArgumentacao();?></textarea>
							</div>
						</div>

						<b>Anexos</b>
						<div class="row">
						<?php
    foreach ($arquivosRequerido as $a) {
        ?>
        				<div class="row">
								<div class="col s6 m6">
									<a
										href="<?php echo Configuracao::HOST_SERVER . "/temp/" . str_replace(' ', '%20', utf8_encode($a['nome']));?>"
										target="_blank" title="Download"><?php echo $a['nome'];?>&nbsp;<i
										class="material-icons">file_download</i></a>
								</div>
								<div class="col s6 m6">
									<a
										href='<?php echo Configuracao::HOST_SERVER . "/deleteFileSolucao/" . $a['idArquivo'] . "/" . $controller->Get('id'); ?>'
										title="Deletar"><i class='material-icons right'>delete</i></a>
								</div>
							</div>
				<?php } ?>

							<div class="row col s12 m12">
								<input type="file" name="arquivoRequerido[]"
									accept=".png, .jpg, .jpeg, .pdf, .zip, .rar"
									multiple="multiple" />
							</div>
						</div>
					</div>

					<b>Avaliação Controvérsia</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col s12">
								Descrição:
								<textarea id="avaliacaoDescricao" name="avaliacaoDescricao"
									class="bigtextarea">
									<?php echo $solucao->getAvaliacaoDescricao();?></textarea>
							</div>
						</div>

						<b>Anexos</b>
						<div class="row">
						<?php
    foreach ($arquivosAvaliacao as $a) {
        ?>
        				<div class="row">
								<div class="col s6 m6">
									<a
										href="<?php echo Configuracao::HOST_SERVER . "/temp/" . str_replace(' ', '%20', utf8_encode($a['nome']));?>"
										target="_blank" title="Download"><?php echo $a['nome'];?>&nbsp;<i
										class="material-icons">file_download</i></a>
								</div>
								<div class="col s6 m6">
									<a
										href='<?php echo Configuracao::HOST_SERVER . "/deleteFileSolucao/" . $a['idArquivo'] . "/" . $controller->Get('id'); ?>'
										title="Deletar"><i class='material-icons right'>delete</i></a>
								</div>
							</div>
				<?php } ?>
							<div class="row col s12 m12">
								<input type="file" name="arquivoControversia[]"
									accept=".png, .jpg, .jpeg, .pdf, .zip, .rar"
									multiple="multiple" />
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
<script type="text/javascript">
$(document).ready(function() {
    $('.modal').modal();
    $('#modal1').modal('open');
  });
ClassicEditor
.create( document.querySelector( '#requerenteDescricao' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );
ClassicEditor
.create( document.querySelector( '#requerenteArgumentacao' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );
ClassicEditor
.create( document.querySelector( '#requeridoArgumentacao' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );
ClassicEditor
.create( document.querySelector( '#avaliacaoDescricao' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );
</script>
</body>
</html>