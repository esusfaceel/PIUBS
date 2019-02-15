<?php
include_once 'library/Import.php';

Import::library('Security');

Import::controller('ControllerVisitaInLoco');
$controller = new ControllerVisitaInLoco();
$visita = $controller->getById($controller->Get('id'));
if (Security::SelfAndADM($visita->getIdUsuario()))
    Import::template('header');
Import::controller('ControllerUbs');
Import::controller('ControllerTipoPergunta');
Import::controller('ControllerEmpresa');
Import::library('Redirect');
Import::controller('ControllerArquivo');
Import::config('Configuracao');

$tipoPergunta = new ControllerTipoPergunta();
$ubs = new ControllerUbs();
$arquivo = new ControllerArquivo();
$controllerEmpresa = new ControllerEmpresa();

$empresas = $controller->getEmpresaVisitaByIdVisita($controller->Get('id'));
$arquivos = $arquivo->getByIdVisita($controller->Get('id'));
$controller->update();
$arquivo->deleteVisita();

if (basename(dirname(dirname($_SERVER['REQUEST_URI']))) == "deleteFile") {
    Import::template('modal/deleteFile');
}
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Editar Visita in Loco</span>

				<form method="post" enctype="multipart/form-data">
					<div class="row border">
						<div class="row col s12">
							<div class="input-field col m6 s6">
								<label for="date" class="active">Data:<i class="blue-text">*</i></label>
								<input id="date" type="date" name="date" required="required"
									value="<?php echo $visita->getData();?>">
							</div>
							<div class="col m6 s6">
								<label class="active">UBS:<i class="blue-text">*</i></label> <select
									name="ubs" class="browser-default">
	<?php
foreach ($ubs->getAll() as $u) {
    if ($u->getId() == $visita->getIdUbs())
        echo "<option value='" . $u->getId() . "' selected>" . $u->getNome() . "</option>";
    else
        echo "<option value='" . $u->getId() . "'>" . $u->getNome() . "</option>";
}
?>
								</select>
							</div>
						</div>
						<div class="row col s12" id="list_empresa">
									<?php foreach ($empresas as $e) {?>
							<div class="col m6 s6">
								<label class="active">Empresa:<i class="blue-text">*</i></label>
								<select name="empresa[]" class="browser-default">
	<?php
            foreach ($controllerEmpresa->getAll() as $empresa) {
                if ($empresa->getId() == $e['idEmpresa'])
                    echo "<option value='" . $empresa->getId() . "' selected>" . $empresa->getRazaoSocial() . "</option>";
                else
                    echo "<option value='" . $empresa->getId() . "'>" . $empresa->getRazaoSocial() . "</option>";
            }
            ?>
								</select>
							</div>
							<?php }?>
						</div>

					</div>
					<b>Avaliação de implantação do sistema</b>
					<div class="row border">
					<?php $tipoPergunta->editPerguntas($controller->Get('id'));?>
						</div>
					<b>Anexos</b>
					<div class="row border">
						<?php
    foreach ($arquivos as $a) {
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
									href='<?php echo Configuracao::HOST_SERVER . "/deleteFile/" . $a['idArquivo'] . "/" . $controller->Get('id'); ?>'
									title="Deletar"><i class='material-icons right'>delete</i></a>
							</div>
						</div>
				<?php } ?>
						<div class="row input-field col s12">
							<input type="file" name="arquivo[]"
								accept=".png, .jpg, .jpeg, .pdf, .zip, .rar" multiple="multiple" />
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
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/form.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.modal').modal();
    $('#modal1').modal('open');
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
</body>
</html>