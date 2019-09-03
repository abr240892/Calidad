
var date_control_consultacalif = document.getElementById("defecha");

		date_control_consultacalif.setAttribute("max",MyDateString);
		



var date_control_consultacalif2 = document.getElementById("afecha");


        date_control_consultacalif2.setAttribute("max",MyDateString);
			
			

function validacionDatos2(){
  //var numCentro = $('#txt_centro' ).val().length;
	var numempleado = $('#txt_numEmpleado2').val().length;
	
	var numcentro = $('#txt_centro2').val().length;
	
   // $('#txt_numEmpleado2' ).focus();
        

    if (numempleado  == 8) {
          
		   numempleado = $('#txt_numEmpleado2').val();
		  console.log(numempleado);
          llamarEmpleado2(numempleado);
  		  
		 
		 var inputcentro = document.getElementById("txt_centro2").disabled=true;
        
		
    }else if(numcentro == 6)
	{     
          
          numcentro = $('#txt_centro2').val();
		  console.log(numcentro);
          llamarEmpleado2(numcentro);
          		  
		var inputsempleado = document.getElementById("txt_numEmpleado2").disabled=true;  

	}
  
}

function llamarEmpleado2(x){
	
	var parametros = "opc=llamarEmpleado" + "&empleado=" + x;
		console.log(parametros);
		
		$.ajax ({
      cache: false,
      url: 'assets/php/funciones_consCalificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
      	if (response.mensaje == 1) {
      		$('#txt_nombre2').val( response.nombrecompleto );
      		$('#txt_jefe2').val( response.nombrejefe );
			$('#txt_gerente2').val( response.nombregerentetitular );
			//$('#txt_centro2').val(response.centro);
      	}else if(response.mensaje == 2)
      	{
          //$('#txt_nombre2').val( response.nombrecompleto );
      	  $('#txt_jefe2').val( response.nombrejefe );
		  $('#txt_gerente2').val( response.nombregerentetitular );

		}	
      	
      },
      error:function(xhr,status,error) {
        // $("#imgLoading").hide("true");
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
		//$("#resultado").html();
      }
  });
	
	
	
}

$( '#btn_buscar2' ).click(function() {
  validarBuscar2();

});

function validarBuscar2(){
	
	
    var selec = document.getElementById("Concentrado").value;
	var defecha = $('#defecha').val();
	var afecha = $('#afecha').val();

	
	if(selec=='ConcentradoDiario'){
	
	//console.log('true');

	
	if(defecha !='' && afecha !=''){
		
		mostrardatos();
		
	}else{
		
		Swal.fire('se nesesita ingresar fecha');
		
		
	}
	
	
	}else if(selec=='SemaforoSemanal')
	{
		
		if(defecha !='' && afecha !=''){
			
		
	
		mostrardatos2();
		
				
	}else{
		
		Swal.fire('se nesesita ingresar fecha');
		
		
	}
		
		
	}else if(selec=='SemaforoMensual')
	{
		console.log("SemaforoMensual");
		    
     
	   	if(defecha !='' && afecha !=''){
			
		
	
		mostrardatos3();
		
				
	}else{
		
		Swal.fire('se nesesita ingresar fecha');
		
		
	}
	 
	 
   


    }
    
}

function mostrardatos(){
	
	var parametros = "opc=llenarTablaConcentradodiario"+"&numempleado="+$('#txt_numEmpleado2').val()+"&defecha="+$('#defecha').val()+"&afecha="+$('#afecha').val()+"&nomjefe="+$('#txt_jefe2').val()+"&centro="+$('#txt_centro2').val();
	
	console.log(parametros);
	
			$.ajax ({
      cache: false,
      url: 'assets/php/funciones_consCalificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
      	if (response.estado == 1) {
			 $('#tableCalificaciones').html(response.table);
        		$('#tableCalificaciones').show();
				
		            callback();
    
      	}else{ 
      		Swal.fire("no se encontraron resultados");
      	}
      },
      error:function(xhr,status,error) {
        // $("#imgLoading").hide("true");
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
		//$("#resultado").html();
      }
  });
	
	
	
	
}

function mostrardatos2(){
	
	var parametros = "opc=llenarTablaSemaforoSemanal"+"&numempleado="+$('#txt_numEmpleado2').val()+"&defecha="+$('#defecha').val()+"&afecha="+$('#afecha').val()+"&nomjefe="+$('#txt_jefe2').val()+"&centro="+$('#txt_centro2').val();
	
	console.log(parametros);
	
			$.ajax ({
      cache: false,
      url: 'assets/php/funciones_consCalificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
		  
      	if (response.estado == 1) {
			 $('#tableCalificaciones').html(response.table);
        		$('#tableCalificaciones').show();
				
		            //callback();
    
      	}else{ 
      		Swal.fire("no se encontraron resultados");
      	}
      },
      error:function(xhr,status,error) {
        // $("#imgLoading").hide("true");
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
		//$("#resultado").html();
      }
  });
	
	
	
	
	
}



function mostrardatos3(){
	
	var parametros = "opc=llenarTablaSemaforoMensual"+"&numempleado="+$('#txt_numEmpleado2').val()+"&defecha="+$('#defecha').val()+"&afecha="+$('#afecha').val()+"&nomjefe="+$('#txt_jefe2').val()+"&centro="+$('#txt_centro2').val();
	
	console.log(parametros);
	
			$.ajax ({
      cache: false,
      url: 'assets/php/funciones_consCalificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
		  
      	if (response.estado == 1) {
			 $('#tableCalificaciones').html(response.table);
        		$('#tableCalificaciones').show();
				
		            //callback();
    
      	}else{ 
      		Swal.fire("no se encontraron resultados");
      	}
      },
      error:function(xhr,status,error) {
        // $("#imgLoading").hide("true");
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
		//$("#resultado").html();
      }
  });
	
	
	
	
	
}




function callback(){
	/*
	   debugger;
       console.log('callback');
	  // var t;
	  // t = 1;
	  // var th = document.getElementById('aspectostecnicos'+t).innerHTML;
	  // console.log(th);
	   
	for(var i=1; i < document.getElementById('aspectostecnicos'+i); i++ )
	{   
		
		var Aspectos = document.getElementById('aspectostecnicos'+i);
		
		console.log(Aspectos);
		
	}
	*/
	
}



$( '#btn_limpiar2' ).click(function() {
  limpiarTxt2();
});

function limpiarTxt2(){
	
	
	//$('#txt_centro' ).focus();

	$('#txt_nombre2').val( "" );
    $('#txt_jefe2').val( "" );
    $('#txt_gerente2').val("") 
	$('#txt_numEmpleado2').val("");
	$('#date_fecha2').val("");
	$('#defecha').val("");
	$('#afecha').val("");
	$('#txt_centro2').val("");
	
	$('#concentradoxdia').remove();

	var inputsempleado = document.getElementById("txt_numEmpleado2").disabled=false;
	var inputscentro = document.getElementById("txt_centro2").disabled=false;
	
	
	$("#tableCalificaciones").hide();
	
	
}



function guarda_valores_modal_replica(){
	
	console.log("guarda valores replica");

	
	var replica = document.getElementById("text_replica").value;
	var respuesta = document.getElementById("text_respuesta").value;
	var fecha = document.getElementById("replica_fecha_cal").innerText;
	var hora = document.getElementById("replica_hora_cal").innerText;
	var nombre = document.getElementById("replica_nombrecompleto").innerText;
	
	
	if($('#text_replica').val().length == 0)
	  {  
       console.log("replica");
       var parametros = "opc=ReplicaVacia"+"&respuesta="+respuesta+"&fecha="+fecha+"&hora="+hora+"&nombre="+nombre;

	}else if($('#text_respuesta').val().length == 0)
	  {   
        console.log("respuesta");
		var parametros = "opc=RespuestaVacia"+"&Replica="+replica+"&fecha="+fecha+"&hora="+hora+"&nombre="+nombre; 
	
	}else if(($('#text_replica').val().length > 0) && ($('#text_respuesta').val().length > 0)){
		
		console.log("replica y respuesta");
		var parametros = "opc=Respuesta_Replica"+"&Replica="+replica+"&Respuesta="+respuesta+"&fecha="+fecha+"&hora="+hora+"&nombre="+nombre; 
		
	}
	

	
	 $.ajax ({
      cache: false,
      url: 'assets/php/funciones_consCalificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
		 console.log(response.estado);
      if (response.estado == 1) {
	
	    Swal.fire("se guardo con exito");
		  $('#ModalReplica').hide();
		  $('.modal-backdrop').remove();
		
	
	    }else {
			
		 Swal.fire("no se inserto intente de nuevo");	
			
		}
      },
      error:function(xhr,status,error) {
     
        Swal.fire("error");
	
      }
  });
	 

		

}

function tipo_grafica(){
	
	var combo_grafica = document.getElementById("Concentrado").value;
	
	if(combo_grafica==="ConcentradoDiario")
	{
		console.log("concentrado diario");
		
		date_control_consultacalif.setAttribute("step",1);
		
		date_control_consultacalif2.setAttribute("step",1);

		
		
	}else if(combo_grafica==="SemaforoSemanal")
	{
		
		console.log("concentrado semanal");
		
			date_control_consultacalif.setAttribute("step",7);
		
		   date_control_consultacalif2.setAttribute("step",7);
		   
		   
		
	}else if(combo_grafica==="SemaforoMensual")
	{
		console.log("concentrado mensual");
		
			date_control_consultacalif.setAttribute("step",30);
		
		   date_control_consultacalif2.setAttribute("step",30);
		
		
		
	}
	
	
	
}

