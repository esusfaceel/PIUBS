$(document).ready(function() {
	$('#municipio').change(function(e) {
		$.get("consultaEmpresa.php?id=" + $('#municipio').val(), function(data) {
			$(".empresa").html(data).show();
		});
	})
});