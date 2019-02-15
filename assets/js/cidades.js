$(document).ready(function() {
	$('#estado').change(function(e) {
		$.get("consultaMunicipio.php?id=" + $('#estado').val(), function(data) {
			$(".municipio").html(data).show();
		});
	});
	$('#estadoRequerente').change(function(e) {
		$.get("consultaMunicipio.php?id=" + $('#estadoRequerente').val(), function(data) {
			$(".municipioRequerente").html(data).show();
		});
	});
	$('#estadoRequerido').change(function(e) {
		$.get("consultaMunicipio.php?id=" + $('#estadoRequerido').val(), function(data) {
			$(".municipioRequerido").html(data).show();
		});
	});
});