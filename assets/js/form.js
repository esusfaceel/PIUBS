function cancelar() {
	if (confirm("Deseja realmente limpar todos os campos do formulário?")) {
		$('form').each(function() {
			this.reset();
		});
	}
}
function switchs() {
	var $j = jQuery.noConflict();
	if ($j("#switch").prop('checked')) {
		$j("#ubs1").hide();
		$j("#empresa2").hide();
		$j('#ubs2').show();
		$j('#empresa1').show();
	} else {
		$j("#ubs2").hide();
		$j("#empresa1").hide();
		$j('#ubs1').show();
		$j('#empresa2').show();
	}
}
$(document).ready(function() {
	var $j = jQuery.noConflict();
	$j("#ubs2").hide();
	$j("#empresa1").hide();
	$j('#ubs1').show();
	$j('#empresa2').show();
});