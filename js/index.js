function actualizar_estado_base_datos(status,id){
  var url_string = "update_status_lampara.php".concat("?status=",status,"&id_lampara=",id);
  console.log(url_string);
  $.ajax({
    type:"GET",
    dataType:"json",
    url:url_string,
    success: function(lampara){
        var status = lampara.status;
        console.log("La actualizacion fue",status);
    }
  });
}

/**
 * Esta función sirve para remover la clase button gray
 * la cual sera ejecutarda por la funcion current_status_system periodicamente
 * @param {*} id 
 * @param {*} status 
 */
function actualizar_status_bottons(id,status){
 var aux_id = "#input_"+id;
 if(status){
   $(aux_id).removeClass("button_grey");
 }
}

function current_status_system(id_area){
  $.ajax({
    type:"GET",
    dataType:"json",
    url:"current_status_system.php",
    data:{id_area: id_area},
    success: function(datos){
        var lamparas = datos.Lamparas;
        for(var i=0;i<lamparas.length;i++){
          var id = lamparas[i].id_lampara;
          var status_lampara = lamparas[i].status_lampara;
          actualizar_status_bottons(id,status_lampara);
        }
    }
  });
}
/** Se manda llamar cuando se da click en un apartado del calendario
 * donde, se agrega o se elimina un evento si este ya existe 
*/
function insertar_eliminar_evento(fecha,id_lampara,tag_ejecucion){
  $.ajax({
    type:"Get",
    dataType:"json",
    url:"insertar_eliminar_evento.php",
    data:{fecha: fecha, id_lampara: id_lampara,tag_ejecucion: tag_ejecucion},
    success: function(mensaje){
        var status = mensaje.status;
        console.log("Se eliminino o se inserto", status);
    }
  });
}

function obtener_eventos_ajax(id_lampara){
  return $.ajax({
          dataType:"json",
          url:"obtener_eventos.php",
          data:{id_lampara: id_lampara},
          global:false, /*revisar estas instrucciones global async*/
          async:false,
          success:function(datos){
             var aux_events = datos;
             return aux_events;
          }
  }).responseText;
}

function ejecutar_calendario(id_lampara,id_area){
  var aux_url;

  if(id_lampara){
     aux_url = './obtener_eventos.php?id_lampara='.concat(id_lampara);
  }else{
    aux_url = './obtener_eventos.php';
  }
  
  calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid'],
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'dayGridMonth'
    },
    selectable:true,
    contentHeight: 350,
    editable: false,
    dateClick:function(info){
      var bandera = true;
      var fecha = info.dateStr;
      for (var i = 0; i<eventos.length; i++) {
        var fecha_evento = eventos[i].start 
        if(!fecha.localeCompare(fecha_evento)){
          insertar_eliminar_evento(fecha,id_lampara,'eliminar');
          bandera = false;
          break;
        }
      }
      if(bandera){
        insertar_eliminar_evento(fecha,id_lampara,'insertar');
      }
      var url_redir ="index.php?id_lampara="+id_lampara+"&area="+id_area; 
      window.location.href=url_redir; 
    },
    events:{
      url: aux_url,
      method:'GET',
      failure: function(){
        alert("Error al cargar eventos");
      }
    }
  });
  calendarEl.innerHTML = "";
  calendar.render();
}

function hacer_peticion_http(url){
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      var esp_response = xhttp.responseText;
      document.getElementById("response").innerHTML = esp_response;
      console.log(esp_response);
      var n = esp_response.search("<p>");
      var n2 = esp_response.search("</p>")

      if(n > -1 && n2 > -1){
        var esp_response_status = esp_response.slice(n+3,n2);
        console.log(esp_response_status);
        if(esp_response_status.localeCompare("on") == 0){
          actualizar_estado_base_datos(1,id_lampara);
        }else if(esp_response_status.localeCompare("off") == 0){
          actualizar_estado_base_datos(0,id_lampara);
        }
      }
    }
  };  

  xhttp.open("GET",url, true);
  xhttp.send();

}

$("#Prueba").on('click',function(e){
  var url
  if($(this).hasClass("btn-warning")){
    url = "http://192.168.0.9/control_off";
  }else{
    url = "http://192.168.0.9/control_on";
  }

  console.log(url);
  hacer_peticion_http(url);
  $(this).toggleClass("btn-warning");

});

$( ".button_red" ).on('click',function(e) {
  var control_manual = $(this).data("control_manual");
  console.log(control_manual);
  if(control_manual){
    alert('desative el control manual');
  }else{
    var direccion_ip = $(this).data("direccion_ip");
    var id_lampara = $(this).data("id_lampara");
    if($(this).hasClass("button_grey")){
      var url = "http://"+direccion_ip+"/on";
    }else{
      var url = "http://"+direccion_ip+"/off";
    }
    hacer_peticion_http(url);
    $( this ).toggleClass( "button_grey" );
  }
  
});

/** se ejecutan para obtener los eventos que corresponden al id 
 * de la lampara y el area actual  
 */

$( ".button_recon" ).click(function() {
  var $this = $(this);
  $this.toggleClass("button_rebkg");
  var is_on = $this.hasClass("button_rebkg");
  if(is_on){
    var json_id = $this.attr('id');
    ids = JSON.parse(json_id);
    console.log(ids);
    id_lampara = ids[1];
    id_area = ids[0];
    eventos = JSON.parse(obtener_eventos_ajax(id_lampara));
    $(".button_rebkg").each(function(i,object){
      var aux_object = $(object).attr('id');
      if(aux_object != json_id){
        $(object).toggleClass("button_rebkg");
      }
    });
    ejecutar_calendario(id_lampara,id_area);
  }else{
    ejecutar_calendario(0);
  }
});
/** Esta funcion sirve para buscar los parametros get de la paguina */
function buscar_parametros_get() {
  var prmstr = window.location.search.substr(1);
  return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

/** se manda llamar para convertir la cadena de parametros GET en una array */
function transformToAssocArray( prmstr ) {
  var params = {};
  var prmarr = prmstr.split("&");
  for ( var i = 0; i < prmarr.length; i++) {
      var tmparr = prmarr[i].split("=");
      params[tmparr[0]] = tmparr[1];
  }
  return params;
}

/**
 * Esta función tiene como objetivo obtener el id_area de la primer
 * area que se creo dinamicamente end la base de datos en tipo texto 
 * la cual regresa un json
 */
function obtener_primer_area(){
  return $.ajax({
    dataType:"json",
    url:"obtener_primer_area.php",
    global:false, /*revisar estas instrucciones global async*/
    async:false,
    success:function(datos){
       var aux_events = datos;
       return aux_events;
    }
}).responseText;
}

/** Variables globales*/
var calendarEl = document.getElementById('calendar');
var eventos;

/**Al terminar de cargar la paguina se revisa si hay algun parametro GET,
 * donde si lo hay se asignan los cambias pertinentes css
 */
$(document).ready(function() {
  var params = buscar_parametros_get();
  if(params.id_lampara){
    ejecutar_calendario(parseInt(params.id_lampara));
    var tag = "["+params.area+","+params.id_lampara+"]";  
    $(".button_recon").each(function(i,object){
      var aux_object = $(object).attr('id');
      if(aux_object == tag){
        $(object).toggleClass("button_rebkg");
      }
    });
  }else{
    ejecutar_calendario(0);
  }

  /**
   * Este if sirve para revisar si hay parametros de area pasado por GET,
   * pero en caso de no ser asi se obtiene el ultimo id generado dinamicamente en la
   * base de datos llamando la funcion obtener primer area
   */
  if(params.id_area){
    setInterval(current_status_system,3000,params.id_area);
  }else{

  }

  
});