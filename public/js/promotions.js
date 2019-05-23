$(function() {
	def_dates = getTodayDates();

	$('.date').datetimepicker({
    	timeZone: 'America/Argentina/Buenos_Aires',
    	format: 'L',
    	locale: 'es',
    	stepping: 10,
    	showClose: true,
    	showClear: false,
    	ignoreReadonly: true,
		allowInputToggle: true,
    	maxDate: def_dates[1],
    	tooltips: {
		  	today: 'Hoy',
		  	clear: 'Limpiar selección',
		  	close: 'Cerrar calendario',
		  	selectMonth: 'Mes',
		  	prevMonth: 'Mes pasado',
		  	nextMonth: 'Mes siguiente',
		  	selectYear: 'Año',
		  	prevYear: 'Año pasado',
		  	nextYear: 'Año siguiente',
		  	selectDecade: 'Década',
		  	prevDecade: 'Década pasada',
		  	nextDecade: 'Década siguiente',
		  	prevCentury: 'Siglo pasado',
		  	nextCentury: 'Siglo siguiente',
		  	pickHour: 'Hora',
		  	incrementHour: 'Aumentar hora',
		  	decrementHour: 'Disminuir hora',
		  	pickMinute: 'Minutos',
		  	incrementMinute: 'Aumentar minutos',
		  	decrementMinute: 'Disminuir minutos',
		  	pickSecond: 'Segundos',
		  	incrementSecond: 'Aumentar segundos',
		  	decrementSecond: 'Disminuir segundos',
		  	togglePeriod: 'Invertir período',
		  	selectTime: 'Seleccionar hora'
		}
    });
    $('#from_date').data("DateTimePicker").defaultDate(def_dates[0]);
    $('#to_date').data("DateTimePicker").defaultDate(def_dates[1]);

    $("#from_date").on("dp.change", function (e) {
        $('#to_date').data("DateTimePicker").minDate(e.date);
    });
    $("#to_date").on("dp.change", function (e) {
        $('#from_date').data("DateTimePicker").maxDate(e.date);
    });
} );


// ------ Funciones para el datetimepicker ------ //
function getTodayDates() {
	var fromdate = new Date();
	var todate = new Date();
	if (fromdate.getHours() >= 6) {
		fromdate.setHours(6,0,0);
		todate.setDate(todate.getDate() + 1);
		todate.setHours(5,0,0);
	}
	else {
		fromdate.setDate(todate.getDate() - 1);
		fromdate.setHours(6,0,0);
		todate.setHours(5,0,0);
	}
	return [fromdate, todate];
}
