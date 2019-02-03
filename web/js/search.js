function getCountries(){
	var city = $('.city--select option:selected').text();
	$.ajax({
		url: '/web/country/list',
		data: 'city='+city,
		type: "POST",
		success: function(data){
			$('.countries--list').html(data);
		}
	});
}

$(function(){
	getCountries();

	$('.city--select').change(function(){
		getCountries();
	});

	$('.search--form').submit(function(){
		$.ajax({
			url: '/web/site/tour',
			data: $(this).serialize(),
			type: "POST",
			success: function(data){
				$('.search-module .result').html(data);
			}
		});
		return false;
	});
});