<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::library('Redirect');
Import::controller('ControllerEstado');
Import::controller('ControllerEmpresa');
Import::controller('ControllerSolucaoControversia');

$estados = new ControllerEstado();
$empresa = new ControllerEmpresa();
$controller = new ControllerSolucaoControversia();

$controller->save();
$controller->finalizar();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Solução de Controvérsia</span>

				<form method="post" enctype="multipart/form-data">
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s12">
								<label for="date" class="active">Data:<i class="blue-text">*</i></label>
								<input id="date" type="date" name="date" required="required"
									value="<?php echo date('Y-m-d');?>">
							</div>
						</div>
					</div>
					<b>Requerente</b>
					<div class="row border">
						<div class="row col s12">
							<div class="switch center">
								<label><font size="3">UBS</font><input type="checkbox"
									onload="switchs();" onchange="switchs();" id="switch"
									name="switch"> <span class="lever"></span> <font size="3">Empresa</font></label>
							</div>
						</div>
						<div class="row col s12">
							<div id="ubs1">
								<div class="col m6 s6">
									<label class="active">Estado:<i class="blue-text">*</i></label>
									<select name="estadoRequerente" id="estadoRequerente"
										class="browser-default">
									<?php
        foreach ($estados->getEstados() as $estado) {
            echo "<option value='" . $estado->getId() . "'>" . $estado->getSigla() . "</option>";
        }
        ?>
								</select>
								</div>
								<div class="col m6 s6">
									<label class="active">Município:<i class="blue-text">*</i></label>
									<select name="municipioRequerente" id="municipioRequerente"
										class="municipioRequerente browser-default">
										<option>---SELECIONE UM ESTADO---</option>
									</select>
								</div>
								<div class="col m6 s12">
									<label class="active">UBS:<i class="blue-text">*</i></label> <select
										name="requerenteUbs" class="ubsRequerente browser-default">
										<option>---SELECIONE UM MUNICÍPIO---</option>
									</select>
								</div>
							</div>
							<div id="empresa1">
								<div class="col m6 s6">
									<label class="active">Empresa:<i class="blue-text">*</i></label>
									<select name="requerenteEmpresa" class="browser-default">
									<?php
        foreach ($empresa->getAll() as $empresas) {
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
						<div class="row col s12">
							<div id="ubs2">
								<div class="col m6 s6">
									<label class="active">Estado:<i class="blue-text">*</i></label>
									<select name="estadoRequerido" id="estadoRequerido"
										class="browser-default">
									<?php
        foreach ($estados->getEstados() as $estado) {
            echo "<option value='" . $estado->getId() . "'>" . $estado->getSigla() . "</option>";
        }
        ?>
								</select>
								</div>
								<div class="col m6 s6">
									<label class="active">Município:<i class="blue-text">*</i></label>
									<select name="municipioRequerido" id="municipioRequerido"
										class="municipioRequerido browser-default">
										<option>---SELECIONE UM ESTADO---</option>
									</select>
								</div>
								<div class="col m6 s12">
									<label class="active">UBS:<i class="blue-text">*</i></label> <select
										name="requeridoUbs" class="ubsRequerido browser-default">
										<option>---SELECIONE UM MUNICÍPIO---</option>
									</select>
								</div>
							</div>
							<div id="empresa2">
								<div class="col m6 s6">
									<label class="active">Empresa:<i class="blue-text">*</i></label>
									<select name="requeridoEmpresa" class="browser-default">
									<?php
        foreach ($empresa->getAll() as $empresas) {
            echo "<option value='" . $empresas->getId() . "'>" . $empresas->getRazaoSocial() . "</option>";
        }
        ?>
								</select>
								</div>
							</div>
						</div>
					</div>

					<b>Informações do Requerente</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col s12">
								Descrição:
								<textarea id="requerenteDescricao" name="requerenteDescricao"
									class="bigtextarea"></textarea>
							</div>
						</div>
						<div class="row col s12">
							<div class="input-field col s12">
								Argumentação:
								<textarea id="requerenteArgumentacao"
									name="requerenteArgumentacao" class="bigtextarea"></textarea>
							</div>
						</div>
						<div class="input-field col s12">
							<div class="col s11 center">Selecione os arquivos para constar na
								argumentação</div>
							<div class="row col s1 m1">
								<a class="waves-effect waves-light green-text right"
									id="add_field" title="Adicionar campo para anexos"><i
									class="material-icons left">add_circle</i></a>
							</div>
							<div id="listas">
								<div class="row col s12 m12">
									<input type="file" name="arquivo[]"
										accept=".png, .jpg, .jpeg, .pdf, .zip, .rar"
										multiple="multiple" /> <a
										class="waves-effect waves-light red-text right remover_campo"
										title="Remover campo para anexos"><i
										class="material-icons left">delete</i></a>
								</div>
							</div>
						</div>
					</div>

					<b>Informações do Requerido</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col s12">
								Argumentação:
								<textarea id="requeridoArgumentacao"
									name="requeridoArgumentacao" class="bigtextarea"></textarea>
							</div>
						</div>

						<div class="input-field col s12">
							<div class="col s11 center">Selecione os arquivos para constar na
								argumentação</div>
							<div class="row col s1 m1">
								<a class="waves-effect waves-light green-text right"
									id="add_field_list1" title="Adicionar campo para anexos"><i
									class="material-icons left">add_circle</i></a>
							</div>
							<div id="listas_requerido">
								<div class="row col s12 m12">
									<input type="file" name="arquivoRequerido[]"
										accept=".png, .jpg, .jpeg, .pdf, .zip, .rar"
										multiple="multiple" /> <a
										class="waves-effect waves-light red-text right remover_campo"
										title="Remover campo para anexos"><i
										class="material-icons left">delete</i></a>
								</div>
							</div>
						</div>
					</div>

					<b>Avaliação Controvérsia</b>
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col s12">
								Descrição:
								<textarea id="avaliacaoDescricao" name="avaliacaoDescricao"
									class="bigtextarea"></textarea>
							</div>
						</div>
						<div class="input-field col s12">
							<div class="col s11 center">Selecione os arquivos para constar na
								argumentação</div>
							<div class="row col s1 m1">
								<a class="waves-effect waves-light green-text right"
									id="add_field_list2" title="Adicionar campo para anexos"><i
									class="material-icons left">add_circle</i></a>
							</div>
							<div id="listas_controversia">
								<div class="row col s12 m12">
									<input type="file" name="arquivoControversia[]"
										accept=".png, .jpg, .jpeg, .pdf, .zip, .rar"
										multiple="multiple" /> <a
										class="waves-effect waves-light red-text right remover_campo"
										title="Remover campo para anexos"><i
										class="material-icons left">delete</i></a>
								</div>
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
						<button type="submit" name="finalizar"
							class="waves-effect waves-light btn grey">
							Finalizar <i class="material-icons left">check</i>
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<?php Import::template('footer');?>
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
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
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/cidades.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/ubs.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER; ?>/assets/js/arquivos.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/form.js"></script>
</body>
</html>