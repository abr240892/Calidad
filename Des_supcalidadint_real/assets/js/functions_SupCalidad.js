var control;
var play;

//asignar fecha de hoy a todos los inputs

var date_control_supervicion  = document.getElementById("date_fecha");

date_control_supervicion.setAttribute("max",MyDateString);

//date_control_supervicion.value = MyDateString;


function validacionDatos(e){
	
  
 // var numCentro = $('#txt_centro' ).val().length;
	var numempleado = $('#txt_numEmpleado' ).val().length;
	
 // if(numCentro == 6){
    $('#txt_numEmpleado' ).focus();
      
	 
        if (numempleado  == 8) {

            llamarEmpleado();
			
               $('#date_fecha').focus();
       }
	   	
    
  }
//}

function llamarEmpleado(){
	
	
	var parametros = "opc=llamarEmpleado"+"&empleado="+ $('#txt_numEmpleado').val();
		//+"&centro=" 	+ $('#txt_centro').val() 
		

		
	$.ajax ({
      cache: false,
      url: 'assets/php/funciones_supCalidad.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
      	if (response.estado == 't') {
      		$('#txt_nombre').val( response.nombrecompleto );
      		$('#txt_jefe').val( response.nombrejefe );
			$('#txt_centro').val(response.centro);
      	}else{
      		Swal.fire(" No existe el numero de centro o empleado favor de verificar");
      	}
      },
      error:function(xhr,status,error) {
        // $("#imgLoading").hide("true");
        Swal.fire("error caracter no valido");
      }
  });
}

$( '#btn_limpiar' ).click(function() {
  limpiarTxt();
});

function limpiarTxt(){
//	$('#txt_centro' ).focus();

	$('#txt_nombre').val( "" );
    $('#txt_jefe').val( "" );
    $('#txt_centro').val("");
	$('#txt_numEmpleado').val("");
	$('#date_fecha').val("");
	$('#selectServicio').val("");
	$('#finGestion').val("");

	$('#pruebadecss').remove();
	
	$("#tableGeneral").hide();
}

var CargaHtmlServicio = function(){
    var parametros = "opc=nomCampanas"
    	+"&id=";
		console.log(parametros);
    $.ajax({
    	cache: false,
        async: false,
        //timeout: 1000,
        url: 'assets/php/funciones_supCalidad.php',
        type: 'POST',
        dataType: 'JSON',
        data: parametros,
        success: function(response){
            var HtmlServicio = '';
            if(response.response ) {
            	HtmlServicio +='<option value="0">SELECCIONE</option>';
                $.each(response.arrayTable, function( key, value ) {
                    HtmlServicio +='<option value="'+value["id_campana"]+'">'+value["campana"]+'</option>';
                });
            }
            $('#selectServicio').html(HtmlServicio);
            $('#serv_admin').html(HtmlServicio);
             CargaHtmlFinGestion();

             
        },
        error:function(xhr,status,error){
          	bootbox.alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
        }
    });
}

var CargaHtmlFinGestion = function(){
	var id_campana = $("#selectServicio").val();
    var parametros = "opc=nomFinGestion"
    	+ "&id_campana="+id_campana;
				
    $.ajax({
            cache: false,
            async: false,
            url: 'assets/php/funciones_supCalidad.php',
            type: 'POST',
            dataType: 'JSON',
            data: parametros,
            success: function(response){
                var HtmlServicio = '';
                if(response.response) {
                	HtmlServicio +='<option value="">SELECCIONE</option>';
                    $.each(response.arrayTable, function( key, value ) {
                        HtmlServicio +='<option value="'+value["descripcion"]+'">'+value["descripcion"]+'</option>';
                    });
                }
				
				else if(response.atencion_coppel)
				{
					HtmlServicio +='<option value="">SELECCIONE</option>';
                    $.each(response.arrayTable, function( key, value ) {
                        HtmlServicio +='<option value="'+value["value"]+'">'+value["descripcion"]+'</option>';
                    });
							
				}else if(response.atencion_argentina)
				{
                   HtmlServicio +='<option value="">SELECCIONE</option>';
                    $.each(response.arrayTable, function( key, value ) {
                        HtmlServicio +='<option value="'+value["value"]+'">'+value["descripcion"]+'</option>';
                    });

				}else if(response.atencion_zuum)
				{
					  HtmlServicio +='<option value="">SELECCIONE</option>';
                    $.each(response.arrayTable, function( key, value ) {
                        HtmlServicio +='<option value="'+value["value"]+'">'+value["descripcion"]+'</option>';
                    });
				
				}else if(response.atencion_soporte)
				{
                    HtmlServicio +='<option value="">SELECCIONE</option>';
                    $.each(response.arrayTable, function( key, value ) {
                        HtmlServicio +='<option value="'+value["value"]+'">'+value["descripcion"]+'</option>';  
					 
					});
				}			
				
                $('#finGestion').html(HtmlServicio);
            },
            error:function(xhr,status,error){
				console.log("error");
            	//bootbox.alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
            }
    });
}

$( '#btn_buscar' ).click(function() {
  validarBuscar();

});
function validarBuscar(){
  var empleado    = $('#txt_numEmpleado').val();
  var fecha       = $('#date_fecha').val();
  var servicio    = $('#selectServicio').val();
  var finGestion  = $('#finGestion').val();

  if (empleado != "") {
    if (fecha != "") {
      if (servicio != "") {
        if (finGestion != "") {
          MostrarSupCalidad();
        }else{
          Swal.fire('Seleccione fin de gestion');
        }
      }else{
        Swal.fire('Seleccione servicio');
      }
    }else{
      Swal.fire('Se requiere fecha');
    }
  }else{
    // alertify.error('Ingrese # de empleado');
  }
}
function MostrarSupCalidad(){
	
	var bandera = 1;
	
	
	var parametros = 
		" opc=tablaCalidad"
      + "&numEmpleado=" + $("#txt_numEmpleado").val()
  		+ "&idServicio=" 	+ $("#selectServicio").val()
  		+ "&idfinGestion="  + $("#finGestion").val()
		+ "&bandera="		+ bandera
  		+ "&FechaTabla="  	+ $("#date_fecha").val().substring(0,4) + $("#date_fecha").val().substring(5,7)
  		+ "&idFecha="  		+ $("#date_fecha").val();
        

		console.log(parametros);
				
	$.ajax({
        cache: false,
        async: false,
        url: 'assets/php/funciones_supCalidad.php',
        type: 'POST',
        dataType: 'JSON',
        data: parametros,
        success: function(response){
            console.log(response);
        	if (response.estado == 1) {
		
			
        		$('#tableGeneral').html(response.table);
        		$('#tableGeneral').show();
			
				
        	}else if (response.estado == -200){
            alert('No Se encontro información !');
          
          }
      	},
      	error:function(xhr,status,error) {
        	//$("#imgLoading").hide("true");
        	alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
      	}
  	});
}

function descarga_audio(elemen,count){

	 
      	var boton = document.getElementById(elemen.id);
		

  
	     var algo = boton.getAttribute("dataID");
		 console.log(algo);
		 
		 var bandera;
	    
	
		
	var parametros = "opc=verAudio"+"&dataID="+algo;
	
	    console.log(parametros);
		
		$.ajax ({
      cache: false,
      url: 'assets/php/funciones_supCalidad.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
   
             Swal.fire("audio descargado");
			 boton.parentNode.removeChild(boton);
			var celda = document.getElementById("col-audio"+count); 
             	console.log(celda);
			
			var control = document.createElement("audio");
			control.setAttribute("controls","true");
			control.setAttribute("id","my-audio"+count);
			control.setAttribute("preload","auto");
			control.setAttribute("class","control-audio");
			
			
			
			control.setAttribute("src","assets/php/"+response.ruta);
			
            celda.appendChild(control);

           control.onplaying = function(){			   
			   

			$( "audio" ).each(function() {				
				if($(this).attr("id") != control.getAttribute("id") )
				{				
					this.pause();
					this.currentTime = 0;
				}
			});
			
			
           };
		   
		   /*
		   control.onpause = function(){
			   
			 alert("the audio is stoping");
			   
			 control.setAttribute("control","pause");
			 
			   
		   }*/
		   
		  var btn_danger = document.getElementById("btn"+count);
		  btn_danger.disabled=false;
		   

		   	
     
      },
      error:function(xhr,status,error) {
     
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
  });
	
	
		
	   	
		
	
}





