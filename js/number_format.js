$('input.number').keyup(function(event) {
	console.log('111');
	// skip for arrow keys
	if(event.which >= 37 && event.which <= 40){
		event.preventDefault();
	}

	$(this).val(function(index, value) {
		value = value.replace(/,/g,'');
		return numberWithCommas(value);
	});
});
function numberWithCommas(x) {
	var parts = x.toString().split(".");
	parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	return parts.join(".");
}