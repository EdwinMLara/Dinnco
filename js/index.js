function change_class(id){
  var btn = document.getElementById(id);
  var aux = btn.innerHTML;
  if(aux == "On"){
    btn.className = "btn btn-danger"; 
    btn.innerHTML = "Off";
  }else if(aux == "Off"){
    btn.className = "btn btn-success"; 
    btn.innerHTML = "On";
  }
}

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

function encender(url,response,id){
  var btn = document.getElementById("btn-".concat(id));
  var btn_class = btn.className; 
  console.log(btn_class);
  if(btn_class.localeCompare("btn btn-success") == 0){
    url = url.concat("/on");
  }else if(btn_class.localeCompare("btn btn-danger") == 0){
    url = url.concat("/off");
  }

  console.log(url);

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        var esp_response = xhttp.responseText;
        document.getElementById(response).innerHTML = esp_response;
        change_class("btn-".concat(id));
        console.log(esp_response);
        var n = esp_response.search("<p>");
        var n2 = esp_response.search("</p>")

        if(n > -1 && n2 > -1){
          var esp_response_status = esp_response.slice(n+3,n2);
          console.log(esp_response_status);
          if(esp_response_status.localeCompare("on") == 0){
            actualizar_estado_base_datos(1,id);
          }else if(esp_response_status.localeCompare("off") == 0){
            actualizar_estado_base_datos(0,id);
          }
        }
      }
  };  
  xhttp.open("GET",url, true);
  xhttp.send();
}

function actulizar_status_bottons(id,status){
  var btn = document.getElementById("btn-".concat(id));
  console.log("btn-".concat(id));

  switch(status){
    case "0":
      btn.className = "btn btn-success";
      btn.innerHTML = "On";
      break;
    case "1":
      btn.className = "btn btn-danger";
      btn.innerHTML = "Off";
      break;
    case "2":
      btn.className = "btn btn-warning disabled";
      btn.innerHTML = "Desactivado";
      break;
    default:
      console.log("Error");
  }
}

function current_status_lamparas(incio,fin){
  $.ajax({
    type:"GET",
    dataType:"json",
    url:"current_status_lamparas.php",
    data:{incio: incio,fin: fin},
    success: function(datos){
        var lamparas = datos.Lamparas;
        for(var i=0;i<lamparas.length;i++){
          var id = lamparas[i].id_lampara;
          var status_lampara = lamparas[i].status_lampara;
          actulizar_status_bottons(id,status_lampara);
        }
    }
  });
}

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

function obtener_eventos_ajax(){
  return $.ajax({
          dataType:"json",
          url:"obtener_eventos.php",
          global:false, /*revisar estas instrucciones global async*/
          async:false,
          success:function(datos){
             var aux_events = datos;
             return aux_events;
          }
  }).responseText;
}


var calendarEl = document.getElementById('calendar');
var eventos;

$(document).ready(function() {
    eventos = JSON.parse(obtener_eventos_ajax());
    console.log(eventos);

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
            insertar_eliminar_evento(fecha,1,'eliminar');
            bandera = false;
            break;
          }
        }
        if(bandera){
          insertar_eliminar_evento(fecha,1,'insertar');
        }
         location.reload();
      },
      events:{
        url: './obtener_eventos.php',
        method:'POST',
        failure: function(){
          alert("Error al cargar eventos");
        }
      }
    });

    calendar.render();

    //var datos_taps = document.getElementById("Seccion");
    //setInterval(current_status_lamparas,3000,0,6);
});

$( ".button_red" ).click(function() {
  $( this ).toggleClass( "button_grey" );
});

$( ".button_recon" ).click(function() {
  $( this ).toggleClass( "button_rebkg" );
});

function change(id) {
    var elem = document.getElementById(id);
    if (elem.value=="Apagado") 
    elem.value = "Encendido";
    else 
    elem.value = "Apagado";
}