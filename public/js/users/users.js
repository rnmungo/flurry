var user;
function User () {

	var roles;

	this.init_vars = function () {
		charge_roles();
		$('#btn_new_user').tooltip({ boundary: 'window', "show": 500, "hide": 100 });
	};


	// EN DESUSO
	this.select_role = function (form_id, username, role_id) {
	    var form = document.getElementById(form_id);
	    var options = document.createElement("div");
	  	var html = "";
	  	for (var i = 0; i < roles.length; i++) {
	  		var role = roles[i];
	  		if (role.id == role_id) {
	  			html += "<option value='" + role.id + "' selected>" + role.name + "</option>";
	  		}
	  		else {
	  			html += "<option value='" + role.id + "'>" + role.name + "</option>";
	  		}
	  	}
	  	myselect  = "<select id='select_roles' class='form-control form-control-sm shadow-sm'>";
	  	myselect += html;
	  	myselect += "</select>";
	  	options.innerHTML += myselect;
	    swal({
    		title: "¿Está seguro?",
          	text: "Modificará los permisos de " + username + ".",
          	icon: "info",
          	content: options,
          	dangerMode: true,
          	buttons: {
			    cancel: {
			      	text: "Cancelar",
			      	value: false,
			      	visible: true
			    },
			    confirm: {
			      	text: "Confirmar",
			      	value: 1,
			      	visible: true
			    }
			}
	    }).then((value) => {
		 	if (value) {
		 		var selected_role = document.getElementById('select_roles');
				form.action += selected_role.options[selected_role.selectedIndex].value;
			    form.submit();
		 	}
		 	else {
		 		swal("Operación cancelada.", {buttons: false, timer: 900});
		 	}
	    });
	};

	this.check_equal_inputs = function (name1, name2) {
		var input_1 = document.getElementsByName(name1)[0];
		var input_2 = document.getElementsByName(name2)[0];
		if (input_1.value != "" && input_1.value != undefined && input_2.value) {
			if (input_1.value != input_2.value) {
				if (input_2.classList.contains('is-valid')) {
					input_2.classList.remove('is-valid')
				}
				if (!input_2.classList.contains('is-invalid')) {
					input_2.classList.add('is-invalid')
				}
				return;
			}
			else {
				if (input_2.classList.contains('is-invalid')) {
					input_2.classList.remove('is-invalid')
				}
				if (!input_2.classList.contains('is-valid')) {
					input_2.classList.add('is-valid')
				}
				return;
			}
		}
		else if (!input_1.value && input_2.value) {
			if (input_2.classList.contains('is-valid')) {
				input_2.classList.remove('is-valid')
			}
			if (!input_2.classList.contains('is-invalid')) {
				input_2.classList.add('is-invalid');
			}
			return;
		}
		else {
			if (input_2.classList.contains('is-valid')) {
				input_2.classList.remove('is-valid')
			}
			if (input_2.classList.contains('is-invalid')) {
				input_2.classList.remove('is-invalid');
			}
			return;
		}
	};

	this.check_strength_password = function (input) {
        // Var's.
        var characters = 0;
        var capitalletters = 0;
        var loweletters = 0;
        var number = 0;
        var special = 0;
        var strength = 0;
        // RegExp's.
        var upperCase= new RegExp('[A-Z]');
        var lowerCase= new RegExp('[a-z]');
        var numbers = new RegExp('[0-9]');
        var specialchars = new RegExp('([!,%,&,@,#,$,^,*,?,_,~])');
        // Calculate Strength.
        if (input.value.length > 8) { characters = 1; } else { characters = -1; };
        if (input.value.match(upperCase)) { capitalletters = 1} else { capitalletters = 0; };
        if (input.value.match(lowerCase)) { loweletters = 1} else { loweletters = 0; };
        if (input.value.match(numbers)) { number = 1} else { number = 0; };
        if (input.value.match(specialchars)) { special = 1} else { special = 0; };
        // Total.
        strength = characters + capitalletters + loweletters + number + special;
        asign_color_class(strength, input);
	};

	this.check_values = function (check_pwd = false, check_mail = false) {
		if (check_pwd) {
			var password1 = document.getElementsByName('password')[0];
			var password2 = document.getElementsByName('password2')[0];
			if (password1.value != password2.value) {
				return swal('Esperá', 'Las contraseñas deben coincidir', 'error');
			}
		}
		if (check_mail) {
			var email1 = document.getElementsByName('email')[0];
			var email2 = document.getElementsByName('email2')[0];
			if (email1.value != email2.value) {
				return swal('Esperá', 'Los mail\'s deben coincidir', 'error');
			}
		}
		document.getElementById('user_form').submit();
	};

	function asign_color_class (strength, input) {
		// Remove All Colors.
		var badge = document.getElementById('strength_badge');
		if (badge.classList.contains('badge-secondary')) {
			badge.classList.remove('badge-secondary');
		}
		if (badge.classList.contains('badge-danger')) {
			badge.classList.remove('badge-danger');
		}
		if (badge.classList.contains('badge-warning')) {
			badge.classList.remove('badge-warning');
		}
		if (badge.classList.contains('badge-info')) {
			badge.classList.remove('badge-info');
		}
		if (badge.classList.contains('badge-success')) {
			badge.classList.remove('badge-success');
		}
		badge.innerHTML = "";
		// Assign Strict Color.
		if (strength == 1) {
            badge.classList.add('badge-secondary');
            badge.innerHTML = "Muy Débil";
        }
        else if (strength == 2) {
            badge.classList.add('badge-danger');
            badge.innerHTML = "Débil";
        }
        else if (strength == 3) {
            badge.classList.add('badge-warning');
            badge.innerHTML = "Intermedio";
        }
        else if (strength == 4) {
            badge.classList.add('badge-info');
            badge.innerHTML = "Fuerte";
        }
        else if (strength == 5) {
            badge.classList.add('badge-success');
            badge.innerHTML = "Muy Fuerte";
        }
	};

	function charge_roles () {
		axios.get('/roles').then(function(res) {
			roles = res.data;
		}).catch(function(err) {
			console.log(err);
		});
	};

}