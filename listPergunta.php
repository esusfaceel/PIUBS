<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::controller('ControllerPergunta');
Import::library('Redirect');
Import::config('Configuracao');

$controller = new ControllerPergunta();

$controller->inative();

if ($controller->Get('id')) {
    Import::template('modal/deletePergunta');
}
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Pergunta</span>

				<form method="post">
					<div class="row border">
						<div class="row col s12">
							<table id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Pergunta</th>
										<th>Detalhar</th>
										<th>Editar</th>
										<th>Deletar</th>
									</tr>
								</thead>

								<tbody>
						<?php

    if ($controller->getSession('login')->getIdCargo() == Security::ADM) {
        foreach ($controller->getAllAtivos() as $pergunta) {
            echo "<tr><td>" . $pergunta->getId() . "</td><td>" . $pergunta->getDescricao() . "</td><td><a href='detailPergunta/" . $pergunta->getId() . "'><i class='material-icons'>search</i></a></td><td><a href='editPergunta/" . $pergunta->getId() . "'><i class='material-icons'>edit</i></a></td><td><a href='" . Configuracao::HOST_SERVER . "/deletePergunta/" . $pergunta->getId() . "'><i class='material-icons'>delete</i></a></td></tr>";
        }
    } else {
        foreach ($controller->getAllAtivos() as $pergunta) {
            echo "<tr><td>" . $pergunta->getId() . "</td><td>" . $pergunta->getDescricao() . "</td><td><a href='detailPergunta/" . $pergunta->getId() . "'><i class='material-icons'>search</i></a></td><td><a href='editPergunta/" . $pergunta->getId() . "'><i class='material-icons'>edit</i></a></td><td></td></tr>";
        }
    }
    ?>
								</tbody>
							</table>
						</div>
					</div>
				</form>
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
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/datatables.min.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER;?>/assets/js/customtable.js"></script>
<?php Import::template('footerOuter');?>
<script type="text/javascript">
$(document).ready(function() {
    $('.modal').modal();
    $('#modal1').modal('open');
  });
</script>
</body>
</html>