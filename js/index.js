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

function current_status_lamparas(){
  $.ajax({
    type:"GET",
    dataType:"json",
    url:"current_status_lamparas.php",
    success: function(datos){
        var lamparas = datos.Lamparas;
        for(var i=0;i<lamparas.length;i++){
          var id = lamparas[i].id_lampara;
          var status_lampara = lamparas[i].status_lampara;
          console.log(id,status_lampara);
          actulizar_status_bottons(id,status_lampara);
        }
    }
  });
}

function insertar_eliminar_evento(fecha,id_lampara,tag_ejecucion,id_evento){
  $.ajax({
    type:"Get",
    dataType:"json",
    url:"insertar_eliminar_evento.php",
    success: function(datos){

    }
  });
}

$(document).ready(function() {
  var aux_events = $.ajax({
          dataType:"json",
          url:"obtener_eventos.php",
          global:false, /*revisar estas instrucciones global async*/
          async:false,
          success:function(datos){
             aux_events = datos.Eventos;
             return aux_events;
          }
  }).responseText;

  aux_events = JSON.parse(aux_events);
  aux_events = aux_events.Eventos;
  console.log(aux_events);

  var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid'],
      header: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      },
      selectable:true,
      contentHeight: 350,
      editable: false,
      dateClick:function(info){
        alert(info.dateStr);
      },
      events: aux_events    
      
    });

    calendar.render();

    setInterval(current_status_lamparas,3000);
});