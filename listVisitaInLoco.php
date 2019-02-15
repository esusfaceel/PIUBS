<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::controller('ControllerVisitaInLoco');
Import::library('Redirect');
Import::config('Configuracao');

$controller = new ControllerVisitaInLoco();

$controller->inativa();

if ($controller->Get('id')) {
    Import::template('modal/deleteVisita');
}
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Visitas in Loco</span>

				<form method="post">
					<div class="row border">
						<div class="row col s12">
							<table id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>UBS</th>
										<th>Detalhar</th>
										<th>Editar</th>
										<th>Deletar</th>
									</tr>
								</thead>

								<tbody>
						<?php
    if ($controller->getSession('login')->getIdCargo() == Security::ADM) {
        foreach ($controller->getAllAtivos() as $visita) {
            echo "<tr><td>" . $visita['idRelatorioVisita'] . "</td><td>" . $visita['ubs'] . " (" . implode("/", array_reverse(explode("-", $visita['data']))) . ")" . "</td><td><a href='detailVisitaInLoco/" . $visita['idRelatorioVisita'] . "'><i class='material-icons'>search</i></a></td><td><a href='editVisitaInLoco/" . $visita['idRelatorioVisita'] . "'><i class='material-icons'>edit</i></a></td><td><a href='" . Configuracao::HOST_SERVER . "/deleteVisita/" . $visita['idRelatorioVisita'] . "'><i class='material-icons'>delete</i></a></td></tr>";
        }
    } else {
        foreach ($controller->getAllAtivos() as $visita) {
            echo "<tr><td>" . $visita['idRelatorioVisita'] . "</td><td>" . $visita['ubs'] . " (" . implode("/", array_reverse(explode("-", $visita['data']))) . ")" . "</td><td><a href='detailVisitaInLoco/" . $visita['idRelatorioVisita'] . "'><i class='material-icons'>search</i></a></td><td><a href='editVisitaInLoco/" . $visita['idRelatorioVisita'] . "'><i class='material-icons'>edit</i></a></td><td>";
            echo ($visita['idUsuario'] == $controller->getSession('login')->getId()) ? "<a href='" . Configuracao::HOST_SERVER . "/deleteVisita/" . $visita['idRelatorioVisita'] . "'><i class='material-icons'>delete</i></a>" : "";
            echo "</td></tr>";
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