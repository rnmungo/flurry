$(document).ready(function () {
    $('[data-toggle=tooltip]').tooltip({ 
        boundary: 'window', 
        html: true, 
        delay: { "show": 400, "hide": 200 }
    });
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('div').slideToggle(300);
    });
    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('div').slideToggle(300);
    });
});

function confirmDelete(recordName = 'registro') {
    /*
    alert(ev);
    ev.preventDefault(); 				// evito el submit
	revisar por que no anda en firefox.
    */
    event.preventDefault(); 			// evito el submit
    var form = event.target.form; 		// formulario a submitear luego

    swal({
          title: "¿Está seguro?",
          text: "No podrá recuperar el " + recordName + " luego de eliminarlo.",
          icon: "warning",
          buttons: {			   
				    cancel: {
				      text: "Cancelar",
				      value: false,
				      visible: true
				    },
				    confirm: {
				      text: "Sí",
				      value: true,
				      visible: true
				    }
				   },
          dangerMode: true
         })
		 .then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Operación cancelada.", {buttons: false, timer: 900});
           }
         });
}

function delete_from_form(form_id, recordName) {
	var form = document.getElementById(form_id);
    swal({
      	title: "¿Está seguro?",
        text: "No podrá recuperar el " + recordName + " luego de eliminarlo.",
        icon: "warning",
        buttons: {			   
		    cancel: {
			    text: "Cancelar",
		    	value: false,
		    	visible: true
			},
			confirm: {
			    text: "Sí",
			    value: true,
			    visible: true
			}
		},
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
        else {
            swal("Operación cancelada.", {buttons: false, timer: 900});
        }
    });
}

// Setea en el elemento img la imagen que el usuario sube al sitio
function readImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#picturePreview')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);

        // modifico el pseudo placeholder y muestro el nombre del archivo cargado.
        var label = document.getElementById('pictureLabel');
        label.innerHTML = input.files[0].name;
    	
    	// Muestro botón de eliminar imagen
    	$('#deleteBtn').show();
    }
}

function deleteImage(default_image) {
	var $image     = $('#picturePreview');
	var $fileinput = $('#picture');
    var label      = document.getElementById('pictureLabel');
    var flag       = document.getElementById('deletePictureFlag');
    var $deleteBtn = $('#deleteBtn');
    swal({
          title: "¿Está seguro?",
          text: "No podrá recuperar la imagen luego de eliminarla.",
          icon: "warning",
          buttons: {			   
				    cancel: {
				      text: "Cancelar",
				      value: false,
				      visible: true
				    },
				    confirm: {
				      text: "Sí, eliminar",
				      value: true,
				      visible: true
				    }
				   },
          dangerMode: true
         })
		 .then((willDelete) => {
            if (willDelete) {
               $image.attr('src', default_image);
               $fileinput.val("");
               $deleteBtn.hide();
               flag.value = '1';
               label.innerHTML = 'Seleccionar imagen...';
            } 
         });
}


// no utilizada, compatible con sweetalert 1.x, no con 2.0. La dejo por las dudas.
function confirmDelete_1_0() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
    swal({
          title: "¿Está seguro?",
          text: "No podrá recuperar el producto luego de eliminarlo.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
     	  showCancelButton: true,
          confirmButtonText: "Sí",
	      cancelButtonText: "Cancelar"
         }, function(isConfirm){
				if (isConfirm) {
				    form.submit();
				}
		    }
	    );
}

// no utilizada, la dejo a modo de ejemplo.
function swal_variosBotones() {
	swal("A wild Pikachu appeared! What do you want to do?", {
	  buttons: {
	    cancel: "Run away!",
	    catch: {
	      text: "Throw Pokéball!",
	      value: "catch",
	    },
	    defeat: true,
	  },
	})
	.then((value) => {
	  switch (value) {
	 
	    case "defeat":
	      swal("Pikachu fainted! You gained 500 XP!");
	      break;
	 
	    case "catch":
	      swal("Gotcha!", "Pikachu was caught!", "success");
	      break;
	 
	    default:
	      swal("Got away safely!");
	  }
	});
}

function validate_input(input, regex) {
	var re = new RegExp(regex);
	if (input.value == "" || input.value == undefined) {
		if (input.classList.contains('is-valid')) {
			input.classList.remove('is-valid')
		}
		if (input.classList.contains('is-invalid')) {
			input.classList.remove('is-invalid')
		}
		return;
	}
	if (!re.test(input.value)) {
		if (input.classList.contains('is-valid')) {
			input.classList.remove('is-valid')
		}
		if (!input.classList.contains('is-invalid')) {
			input.classList.add('is-invalid');
		}
	}
	else {
		if (!input.classList.contains('is-valid')) {
			input.classList.add('is-valid')
		}
		if (input.classList.contains('is-invalid')) {
			input.classList.remove('is-invalid');
		}
	}
}

function sendMail(url) {
	axios.get(url).then(function(res){
		console.log(res);
	}).catch(function(err){
		console.log(err);
	});
}