//var qtde = 0;
$(document).ready(function() {	
//	$('#qtdArquivos').html('<div class="row col s11 center">Total de aquivos: '+qtde+'</div>');
	var campos_max = 10;
    var x = 1;
    $('#add_field').click (function(e) {
        e.preventDefault();
        if (x < campos_max) {
            $('#listas').append('<div class="row col s12">\
            		<input type="file" name="arquivo[]"\
					accept=".png, .jpg, .jpeg, .pdf, .zip, .rar" multiple="multiple"/>\
            		<a class="waves-effect waves-light red-text right remover_campo"\
            		title="Remover campo para anexos"><i\
					class="material-icons left">delete</i></a>\
                    </div>');
            x++;
        }
    });
 
    // Remover o div anterior
    $('#listas').on("click",".remover_campo",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
    
});
$(document).ready(function() {	
//	$('#qtdArquivos').html('<div class="row col s11 center">Total de aquivos: '+qtde+'</div>');
	var campos_max = 10;
	var y = 1;
	$('#add_field_list1').click (function(e) {
		e.preventDefault();
		if (y < campos_max) {
			$('#listas_requerido').append('<div class="row col s12">\
					<input type="file" name="arquivoRequerido[]"\
					accept=".png, .jpg, .jpeg, .pdf, .zip, .rar" multiple="multiple"/>\
					<a class="waves-effect waves-light red-text right remover_campo"\
					title="Remover campo para anexos"><i\
					class="material-icons left">delete</i></a>\
			</div>');
			y++;
		}
	});
	
	// Remover o div anterior
	$('#listas_requerido').on("click",".remover_campo",function(e) {
		e.preventDefault();
		$(this).parent('div').remove();
		y--;
	});
	
});
$(document).ready(function() {	
//	$('#qtdArquivos').html('<div class="row col s11 center">Total de aquivos: '+qtde+'</div>');
	var campos_max = 10;
	var z = 1;
	$('#add_field_list2').click (function(e) {
		e.preventDefault();
		if (z < campos_max) {
			$('#listas_controversia').append('<div class="row col s12">\
					<input type="file" name="arquivoControversia[]"\
					accept=".png, .jpg, .jpeg, .pdf, .zip, .rar" multiple="multiple"/>\
					<a class="waves-effect waves-light red-text right remover_campo"\
					title="Remover campo para anexos"	><i\
					class="material-icons left">delete</i></a>\
			</div>');
			z++;
		}
	});
	
	// Remover o div anterior
	$('#listas_controversia').on("click",".remover_campo",function(e) {
		e.preventDefault();
		$(this).parent('div').remove();
		z--;
	});
	
});
