<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::config('Configuracao');
Import::controller('ControllerUsuario');
Import::template('headerOuter');
Import::library('Alert');
?>
<body bgcolor="#3B5D75">
<?php
$controller = new ControllerUsuario();
$controller->login();
Alert::showMensage();
?>

	<div class="row">
		<div class="col s12 m10 offset-m1 l6 offset-l3">
			<div class="card">
				<div class="card-content">
					<form method="post">
						<div class="row col s12">
							<div class="center">
								<img alt="logo" id="logo" src="model/img/loginlogo.png">
								<h3>
									<font color="#3B5D75">Login</font>
								</h3>
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
									<i class="material-icons prefix">vpn_key</i> <input
										required="required" id="password" type="password"
										class="validate" name="password" /> <label for="login">Senha</label>
								</div>
							</div>
						</div>
						<div class="row center">
							<button type="submit" name="entrar"
								class="btn waves-effect waves-green grey">Entrar</button>
						</div>
						<div class="row">
							<a href="recoveryPassword" class="col s12 m8 offset-m2">Esqueceu a senha?</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<noscript>Seu dispositivo não suporta essa aplicação. Por favor,
		utilize outro dispositivo!</noscript>
</body>
</html>