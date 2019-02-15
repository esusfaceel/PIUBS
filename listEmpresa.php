<?php
include_once 'library/Import.php';

Import::library('Security');
if (Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
)))
    Import::template('header');
Import::controller('ControllerEmpresa');
Import::library('Redirect');

$controller = new ControllerEmpresa();
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<div class="card white darken-1">
			<div class="card-content">
				<span class="card-title center">Empresa</span>

				<form method="post">
					<div class="row border">
						<div class="row col s12">
							<table id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Empresa</th>
										<th>Detalhar</th>
										<th>Editar</th>
									</tr>
								</thead>

								<tbody>
						<?php

    foreach ($controller->getAll() as $empresa) {
        echo "<tr><td>" . $empresa->getId() . "</td><td>" . $empresa->getRazaoSocial() . "</td><td><a href='detailEmpresa/" . $empresa->getId() . "'><i class='material-icons'>search</i></a></td><td><a href='editEmpresa/" . $empresa->getId() . "'><i class='material-icons'>edit</i></a></td></tr>";
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
</body>
</html>