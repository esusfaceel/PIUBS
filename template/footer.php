<?php
if (file_exists('library/Import.php'))
    include_once 'library/Import.php';
else
    include_once '../library/Import.php';

Import::config('Configuracao');
?>
<noscript>Seu dispositivo não suporta essa aplicação. Por favor, utilize
	outro dispositivo!</noscript>
<!-- <footer class="page-footer cyan darken-4 fixed footer-fixed"> -->
<!-- 	<div class="footer-copyright"> -->
<!-- 		<div class="row center"> -->
<!-- 			© 2018  -->
<!-- 		</div> -->
<!-- 	</div> -->
<!-- </footer> -->
<script type="text/javascript">
$('.button-collapse').sideNav();
$('.dropdown-trigger').dropdown();
</script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript"
	src="<?php echo Configuracao::HOST_SERVER . "/assets/";?>js/ckeditor.js"></script>