function validar_ip(ip_address){
	if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip_address)){
    	return (true);
  	}else{
		alert("La dirección IP no es valida");
		return (false);
	}
}

function validacion_datos(){
	var ip = document.getElementById("direccion").value;
	if(validar_ip(ip)){
		var nombre_estacion = document.getElementById("Nombre").value;
		if(nombre_estacion.trim() ==""){
			alert("Llena el campo nombre");
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}

}