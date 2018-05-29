function cargardatos(){
	//document.getElementById("viajes").innerHTML = "Hello JavaScript"
	$("#loader").html("<img src='loader2.gif'/>");
	$.get("cargarviajes.php?pagina=" + pagina,
	function(data){
		if (data != "") {
			$("#viajes").append(data); 
		}
		//$('#loader').empty();
	});
}
var pagina=0;
$(document).ready(function() {
	cargardatos();	
});
$(window).scroll(function(){
	if ($(window).scrollTop() == $(document).height() - $(window).height()){
		pagina++;
		cargardatos()
	}					
});