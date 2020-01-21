function agregar_estacion(Nombre,ip_address){
	$.ajax({
		type:"GET",
		dataType:"json",
		url:"agregar_estacion.php",
		data:{Nombre: Nombre,ip_address: ip_address},
		success: function(mensaje){
			var response = mensaje.status;
			if(response.localeCompare("Error") == 0){
				alert("Error al agregar la estación");
			}
		}
	});
}

function actulizar_dispositvos_registrados_paguina(){
	$.ajax({
		url:"./buscar_facturas.php",
		success:function(data){
			$(".dipositivos_registrados").html(data).fadeIn('slow');
		}
	});
}

function validar_ip(ip_address){
	if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip_address)){
    	return (true);
  	}else{
		alert("You have entered an invalid IP address!");
		return (false);
	}
}