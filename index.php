<?php
include_once 'library/Import.php';

Import::library('Security');
Security::PerfilPermitido(array(
    Security::ADM,
    Security::COLABORADOR
));

Import::controller('ControllerUsuario');
Import::controller('ControllerVisitaInLoco');
Import::controller('ControllerSolucaoControversia');
Import::controller('ControllerRelatorio');
Import::controller('ControllerLog');
$usuario = new ControllerUsuario();
$visita = new ControllerVisitaInLoco();
$solucao = new ControllerSolucaoControversia();
$relatorio = new ControllerRelatorio();
$log = new ControllerLog();

Import::template('header');
?>
<div class="row">
	<div class="col s12 m10 offset-m1 l10 offset-l1">
		<div class="card white darken-1">
			<div class="card-content">
				<section id="content">
					<div id="card-stats">
						<div class="row">
							<div class="col s12 m6 l3 center">
								<div class="card">
									<div class="card-action green darken-2 white-text">
										<p class="card-stats-title">
											<i class="tiny material-icons">face</i> Total de usuários
										</p>
									</div>
									<div class="card-content green white-text">
										<h4 class="card-stats-number"><?php echo count($usuario->getAllAtivos());?></h4>
									</div>
								</div>
							</div>
							<div class="col s12 m6 l3  center">
								<div class="card">
									<div class="card-action purple darken-2 white-text">
										<p class="card-stats-title">
											<i class="tiny material-icons">check_circle</i> Visitas In
											Loco realizadas
										</p>
									</div>
									<div class="card-content purple white-text">
										<h4 class="card-stats-number"><?php echo count($visita->getAllAtivos());?></h4>
										<p class="card-stats-compare">
											<i class="mdi-hardware-keyboard-arrow-up"></i><?php echo count($visita->getAllAtivos()) * 100 / 40;?>% <span
												class="purple-text text-lighten-5">do objetivo</span>
										</p>
									</div>
									<!-- 								<div class="card-action purple darken-2"> -->
									<!-- 									<div id="sales-compositebar"></div> -->
									<!-- 								</div> -->
								</div>
							</div>
							<div class="col s12 m6 l3 center">
								<div class="card">
									<div class="card-action blue-grey darken-2 white-text">
										<p class="card-stats-title">
											<i class="tiny material-icons">swap_horiz</i> Controvérsias
										</p>
									</div>
									<div class="card-content blue-grey white-text">
										<h4 class="card-stats-number"><?php echo count($solucao->getAllAtivos());?></h4>
										<!-- 										<p class="card-stats-compare"> -->
										<!-- 											<i class="mdi-hardware-keyboard-arrow-up"></i> 80% <span -->
										<!-- 												class="blue-grey-text text-lighten-5">from yesterday</span> -->
										<!-- 										</p> -->
									</div>
									<!-- 								<div class="card-action blue-grey darken-2"> -->
									<!-- 									<div id="profit-tristate"></div> -->
									<!-- 								</div> -->
								</div>
							</div>
							<div class="col s12 m6 l3 center">
								<div class="card">
									<div class="card-action  pink darken-2 white-text">
										<p class="card-stats-title">
											<i class="tiny material-icons">trending_up</i> Controvérsias
											resolvidas
										</p>
									</div>
									<div class="card-content pink lighten-2 white-text">
										<h4 class="card-stats-number"><?php echo count($solucao->getAllAtivosFinalizadas());?></h4>
										<p class="card-stats-compare">
											<i class="mdi-hardware-keyboard-arrow-down"></i> <?php echo count($solucao->getAllAtivosFinalizadas()) * 100 /count($solucao->getAllAtivos());?>% <span
												class="deep-purple-text text-lighten-5">das controvérsias</span>
										</p>
									</div>
									<!-- 								<div class="card-action  pink darken-2"> -->
									<!-- 									<div id="invoice-line"></div> -->
									<!-- 								</div> -->
								</div>
							</div>

						</div>
					</div>
					<div id="chart-dashboard">
						<div class="row">
							<div class="col s12 m8 l8">
								<div class="card">
									<div class="card-move-up waves-effect waves-block waves-light">
										<div class="move-up cyan darken-1">
											<div>
												<span class="chart-title white-text">Revenue</span>
											</div>
											<div class="trending-line-chart-wrapper">
												<canvas id="trending-line-chart" height="70"></canvas>
											</div>
										</div>
									</div>
									<div class="card-content">
										<!-- 										<a -->
										<!-- 											class="btn-floating btn-move-up waves-effect waves-light darken-2 right"><i -->
										<!-- 											class="mdi-content-add activator"></i></a> -->
										<div class="col s12 m3 l3">
											<div id="doughnut-chart-wrapper">
												<canvas id="doughnut-chart" height="0"></canvas>
												<div class="doughnut-chart-status"></div>
											</div>
										</div>
										<div class="col s12 m5 l6">
											<div class="trending-bar-chart-wrapper">
												<canvas id="trending-bar-chart" height="90"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col s12 m8 l4">
								<div class="card">
									<div
										class="card-move-up teal card-action waves-effect waves-block waves-light darken-2">
										<p class="white-text">Acessos por mês</p>
										<div
											class="card-move-up teal waves-effect waves-block waves-light darken-1">
											<div class="card-content">
												<canvas id="trending-radar-chart" height="0"></canvas>
												<div class="line-chart-wrapper">
													<canvas id="line-chart" height="170"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
</body>
<?php Import::template('footer');?>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/chartist-js/chartist.min.js"></script>

<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/chartjs/chart.min.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/chartjs/chart-script.js"></script>

<!-- sparkline -->
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins/sparkline/sparkline-script.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/plugins.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/enjoyhint.min.js"></script>
<script type="text/javascript">
var lineChartData = {
		labels : [
		<?php
for ($i = 5; $i > 0; $i --) {
    echo '"' . $relatorio->dateSubMonth($i) . '",';
}
echo '"' . strftime('%b') . '"';
?>
],
		datasets : [
			{
				label: "Acess",
				fillColor : "rgba(255,255,255,0)",
				strokeColor : "#fff",
				pointColor : "#00796b ",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(220,220,220,1)",
				data: [<?php echo count($log->getAllLoginByPeriodo($relatorio->monthAndYearSubMonth(5), $relatorio->monthAndYearSubMonth(5))) . ", " . count($log->getAllLoginByPeriodo($relatorio->monthAndYearSubMonth(4), $relatorio->monthAndYearSubMonth(4))). ", " . count($log->getAllLoginByPeriodo($relatorio->monthAndYearSubMonth(3), $relatorio->monthAndYearSubMonth(3))). ", " . count($log->getAllLoginByPeriodo($relatorio->monthAndYearSubMonth(2), $relatorio->monthAndYearSubMonth(2))). ", " . count($log->getAllLoginByPeriodo($relatorio->monthAndYearSubMonth(1), $relatorio->monthAndYearSubMonth(1))). ", " . count($log->getAllLoginByPeriodo($relatorio->monthAndYearSubMonth(), $relatorio->monthAndYearSubMonth())); ?>]
			}
		]

	}
</script>
<?php
$usuario->firstAccess();
$usuario->removeFirstAccess();
?>
</html>