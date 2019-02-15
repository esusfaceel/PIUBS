<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::library('Redirect');
Import::config('Configuracao');
Import::controller('ControllerUsuario');
Import::template('headerOuter');
?>
<body bgcolor="#3B5D75">
<?php
$controller = new ControllerUsuario();
$controller->solicitacaoRecoveryPassword();
$controller->validaToken();
    
?>

	<div class="row">
		<div class="col s12 m10 offset-m1 l6 offset-l3">
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
								<div class="input-field col s12 m8 offset-m2">
									<i class="material-icons prefix">account_circle</i> <input
										required="required" id="login" type="text" class="validate"
										name="login" /> <label for="login">Login</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m8 offset-m2">
									<i class="material-icons prefix">email</i> <input
										required="required" id="email" type="email" class="validate"
										name="email" /> <label for="email">E-mail</label>
								</div>
							</div>
							<!-- 							<script> -->
							<!-- grecaptcha.ready(function() { -->
							<!-- grecaptcha.execute('6LeEDXkUAAAAAO9BlztBurNPcyYflRvSsil48x8q', {action: 'action_name'}) -->
							<!-- .then(function(token) { -->
							<!-- // Verify the token on the server. -->
							<!-- }); -->
							<!-- }); -->
							<!-- </script> -->
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