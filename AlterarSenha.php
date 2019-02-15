<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::library('Security');
if (Security::RECOVERY_PASSWORD())
    Import::template('headerOuter');
Import::library('Redirect');
Import::config('Configuracao');

Import::controller('ControllerUsuario');
$controller = new ControllerUsuario();
$controller->recoveryPassword($controller->getSession('recovery'));
?>
<body bgcolor="#3B5D75">
	<div class="row">
		<div class="col s12 m8 offset-m2 l6 offset-l3">
			<div class="card">
				<div class="card-content">
					<form method="post">
						<div class="row col s12">
							<div class="center">
								<h4>
									<font color="#3B5D75">Redefinir sua senha</font>
								</h4>
							</div>
							<div class="row">
								<div class="row col s6 offset-s3">
									<div class="input-field">
										<input id="senha" type="password" class="validate"
											name="senha" required="required"> <label for="senha">Nova
											Senha:<i class="blue-text">*</i>
										</label>
									</div>
								</div>
								<div class="row col s6 offset-s3">
									<div class="input-field">
										<input id="csenha" type="password" class="validate"
											name="csenha" required="required"> <label for="csenha">Confirmar
											Senha:<i class="blue-text">*</i>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row center">
							<button type="button"
								onclick="<?php Redirect::BackForOnclick();?>"
								class="btn waves-effect grey">Voltar</button>
							<button type="submit" name="recuperar"
								class="btn waves-effect waves-green grey">Recuperar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<noscript>Seu dispositivo não suporta essa aplicação. Por favor,
		utilize outro dispositivo!</noscript>
	<!-- 	<script -->
	<!-- 		src='https://www.google.com/recaptcha/api.js?render=6LeEDXkUAAAAAO9BlztBurNPcyYflRvSsil48x8q'></script> -->
</body>
</html>