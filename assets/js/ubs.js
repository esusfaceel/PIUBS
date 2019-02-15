$(document).ready(function() {
	$('#municipio').change(function(e) {
		$.get("consultaUbs.php?id=" + $('#municipio').val(), function(data) {
			$(".ubs").html(data).show();
		});
	});
	$('#municipioRequerente').change(function(e) {
		$.get("consultaUbs.php?id=" + $('#municipioRequerente').val(), function(data) {
			$(".ubsRequerente").html(data).show();
		});
	});
	$('#municipioRequerido').change(function(e) {
		$.get("consultaUbs.php?id=" + $('#municipioRequerido').val(), function(data) {
			$(".ubsRequerido").html(data).show();
		});
	});
});