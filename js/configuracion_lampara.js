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