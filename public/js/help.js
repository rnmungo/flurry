function slice(){
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
	    && location.hostname == this.hostname) {
	        var $target = $(this.hash);
	        $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
	        if ($target.length) {
	            var targetOffset = $target.offset().top - 50;
	            $('html,body').animate({scrollTop: targetOffset}, 1000);
	            return false;
	       }
	    }
}

function displayModal(element){
	var modal = document.getElementById('modal-div');
	var modalImg = document.getElementById("modal-img");
	var captionText = document.getElementById("modal-caption");

	modal.style.display = "block";
	modalImg.src = element.src;
	captionText.innerHTML = element.alt;
}

$(function(){
    $('a[href="#listado_pedidos"]').click(slice);
    $('a[href="#nuevo_pedido"]').click(slice);
    $('a[href="#pedido_detalle"]').click(slice);
    $('a[href="#nuevo_cliente"]').click(slice);
    $('a[href="#productos"]').click(slice);
    $('a[href="#gustos"]').click(slice);
    $('a[href="#motivos_cadetes"]').click(slice);
    $('a[href="#configuraciones"]').click(slice);
    $('a[href="#config_personal"]').click(slice);
    $('a[href="#navbarSupportedContent"]').click(slice);

	var modal = document.getElementById('modal-div');
	var close_button = document.getElementById("modal-close");
	close_button.onclick = function() { 
	    $(modal).fadeOut(500);
	}
});

$(document).keydown(function(event) { 
    if (event.keyCode == 27) { 
        $('#modal-div').fadeOut(500);
    }
});

