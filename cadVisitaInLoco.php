<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::controller('ControllerVisitaInLoco');
Import::controller('ControllerTipoPergunta');
Import::controller('ControllerEstado');
Import::controller('ControllerEmpresa');
Import::library('Redirect');

$tipoPergunta = new ControllerTipoPergunta();
$controller = new ControllerVisitaInLoco();
$estados = new ControllerEstado();
$empresa = new ControllerEmpresa();

$controller->save();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Visita in Loco</span>

				<form method="post" enctype="multipart/form-data">
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s12">
								<label for="date" class="active">Data:<i class="blue-text">*</i></label>
								<input id="date" type="date" name="date" required="required"
									value="<?php echo date('Y-m-d');?>">
							</div>
							<div class="col m6 s12">
								<label class="active">Estado:<i class="blue-text">*</i></label>
								<select name="estado" id="estado" class="browser-default">
									<?php
        foreach ($estados->getEstados() as $estado) {
            echo "<option value='" . $estado->getId() . "'>" . $estado->getSigla() . "</option>";
        }
        ?>
								</select>
							</div>
						</div>
						<div class="row col s12">
							<div class="col m6 s12">
								<label class="active">Município:<i class="blue-text">*</i></label>
								<select name="municipio" id="municipio"
									class="municipio browser-default">
									<option>---SELECIONE UM ESTADO---</option>
								</select>
							</div>
							<div class="col m6 s12">
								<label class="active">UBS:<i class="blue-text">*</i></label> <select
									name="ubs" class="ubs browser-default">
									<option>---SELECIONE UM MUNICÍPIO---</option>
								</select>
							</div>
						</div>
						<div class="row col s12" id="list_empresa">
							<div class="col m6 s12">
								<a class="waves-effect waves-light green-text right"
									id="add_field_empresa" title="Adicionar campo para empresas"><i
									class="material-icons left">add_circle</i></a> <label
									class="active">Empresa:<i class="blue-text">*</i></label> <select
									name="empresa[]" class="browser-default">
									<?php

        foreach ($empresa->getAll() as $empresas) {
            echo "<option value='" . $empresas->getId() . "'>" . $empresas->getRazaoSocial() . "</option>";
        }
        ?>	
								</select>
							</div>
						</div>
					</div>
					<b>Avaliação de implantação do sistema</b>
					<div class="row border">
					<?php $tipoPergunta->perguntas();?>
					</div>
					<b>Anexar arquivos</b>
					<div class="row border col s12">
							<div class="col s10 m11 center">Selecione os arquivos para constar no
								relatório</div>
							<div class="row col s1 m1 offset-s1">
								<a class="waves-effect waves-light green-text right"
									id="add_field" title="Adicionar campo para anexos"><i
									class="material-icons left">add_circle</i></a>
							</div>
						<div class="input-field col s12">
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
						<!-- 						<div class="col s12"> -->
						<!-- 							<small class="blue-text">Limite máximo de 5 (cinco) arquivos.</small> -->
						<!-- 						</div> -->
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
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
  });
ClassicEditor
.create( document.querySelector( '.resposta' ) )
.then( editor => {
    console.log( editor );
} )
.catch( error => {
    console.error( error );
} );

<?php

echo "$(document).ready(function() {	
	var campos_max = 10;
    var x = 1;
    $('#add_field_empresa').click (function(e) {
        e.preventDefault();
        if (x < campos_max) {
            $('#list_empresa').append('<div class=\"col m6 s12\">'+
            		'<a class=\"waves-effect waves-light red-text right remover_campo\"'+
            		'title=\"Remover campo para anexos\"><i'+
					'class=\"left\"><img src=\"" . Configuracao::HOST_SERVER . "/model/img/icone/lixeira.png\"</i></a>'+
            		'<label class=\"active\">Empresa:<i class=\"blue-text\">*</i></label>'+
					'<select name=\"empresa[]\" class=\"browser-default\">'+";
foreach ($empresa->getAll() as $empresas) {
    echo "'<option value=\"" . $empresas->getId() . "\">" . $empresas->getRazaoSocial() . "</option>'+";
}
echo "'</select>'+
				'</div>');
            x++;
        }
    });
 
    // Remover o div anterior
    $('#list_empresa').on(\"click\",\".remover_campo\",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
    
});";
?>
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