var cadet;
function Cadet() {

	this.init_vars = function () {
		var table = $('#cadetsTable').DataTable({
			info: false,
		  	searching: false,
		  	paging:   false,
		  	aoColumns: [
			    null,
			    { "bSortable": false },
			    { "bSortable": false }
			],
			language: {
				"emptyTable":     "No hay datos disponibles en la tabla.",
			 	"aria": {
			 	    "sortAscending":  ": activar para ordenar de forma ascendente",
			 	    "sortDescending": ": activar para ordenar de forma descendente"
			 	}
			}
		});
	};

	this.setName = function(cadet_name = null, cadet_id = null) {
		if (cadet_name && cadet_id){
			var form = document.getElementById('form_edit' + cadet_id);
			text = "Ingrese un nuevo nombre para el cadete " + cadet_name + ".";
			input_id = "updateCadetName";
		}
		else {
			var form = document.getElementById("new_form");
			text = "Ingrese el nombre del nuevo cadete.";
			input_id = "newCadetName";
		}
	    swal({
	        text: text,
	        icon: "info",
	        content: "input",
	        closeModal: false,
            buttons: {			   
  			    confirm: true,
  			    cancel: {
  				    text: "Cancelar",
  			    	visible: true,
  			    }
  			}
	    }).then((name) => {
            if (name) {
                form.elements[input_id].value = name;
                form.submit();
           	}
            else if (name == '') {
            	swal("¡Debe ingresar un nombre!", {icon:"error", buttons: false, timer: 1400});
            }
            else {
                swal("Operación cancelada.", {buttons: false, timer: 900});
            }
	    });
	};

}