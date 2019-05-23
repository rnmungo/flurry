var product;
function Product() {

	this.init_vars = function () {
		var table = $('#productsTable').DataTable({ 
			"info": false,			// Oculto 'mostrando x de n registros'
			//"dom": 'lrtip',		// Oculto el searchbox nativo
			"dom": '<"top"i>rt<"bottom"lp><"clear">',
			"pageLength": 10,
			"lengthMenu": [ [10, 20, 50, -1], [10, 20, 50, "Todo"] ],
			aoColumns: [
			    { "bSortable": false, "bSearchable": false},
			    null,
			    null,
			    null,
			    null,
			    { "bSortable": false, "bSearchable": false },
			    { "bSortable": false, "bSearchable": false }
			],
			order: [],			// elimino orden por defecto
			language: {
				"info":           "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty":      "Mostrando 0 de 0",
				"emptyTable":     "No hay datos disponibles en la tabla.",
				"infoFiltered":   " (filtrando entre _MAX_ productos)",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"zeroRecords":    "No se encontró nada.",
			 	"lengthMenu":     "Mostrar _MENU_ productos",
			 	"paginate": {
			 	    "first":    "Primera",
			 	    "last":     "Última",
			 	    "next":     "Siguiente",
			 	    "previous": "Anterior"
			 	},
			 	"aria": {
			 	    "sortAscending":  ": activar para ordenar de forma ascendente",
			 	    "sortDescending": ": activar para ordenar de forma descendente"
			 	}
			}
		});
		$('#searchText').on('keyup', function () {
			table.search($(this).val()).draw();
		});
	};

}