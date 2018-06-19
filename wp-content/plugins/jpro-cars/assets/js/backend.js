jQuery(document).ready(function($) {
	
	$('.form-wrap h3').append(' or <a onclick="myFunction()" href="?taxonomy=car-model&post_type=car-classifieds&import_cars">Import 1100+ Car Models</a>');
	$('.form-wrap h3').append(' or <a onclick="myFunction2()" href="?taxonomy=car-model&post_type=car-classifieds&remove_cars">Remove All Car Models</a>');
	
});

function myFunction() {
	confirm("We are going to import about 1100+ car models! This could take about  5min so be patient & wait until page refresh by itself!");
}
function myFunction2() {
	confirm("Removing all categoris can take up to 5min, so be patient!");
}