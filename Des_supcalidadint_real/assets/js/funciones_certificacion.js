
var count;
var puesto = $('#puesto').val();

function certificacionAlta(){
	var html ='';
	html=`
	    <div class="col-md-4">
        <div class="input-group fade in active input-group-sm" aling="center" style="position:fixed;left:40%">
		
            <button  id="btn_alta_usuario"  data-toggle="modal" data-target="#ModalAlta" class="btn btn-outline-primary" >Alta Usuario</button>
            &nbsp;
            <button id="btn_alta_servicio"  data-toggle="modal" data-target="#ModalAltaServicio" class="btn btn-outline-primary" onclick="CargaModalAltaServicio()">Alta Servicio</button>
            &nbsp;
            <button id="btn_alta_check" data-toggle="modal" data-target="#ModalAltaCheck" class="btn btn-outline-primary" >Alta Check</button>
      
          </div>
        </div>
	<div class="col-md-2" align="left">	    
    </div>`;   

    $('#btns_certificacionAlta').html(html);
	
	
	
}


function certificacionBaja(){
	
	$('#btn_alta_usuario').hide();
	
	$('#btn_alta_servicio').hide();
	
	$('#btn_alta_check').hide();
	
	
	var html ='';
	html=`
	    <div class="col-md-4">
        <div class="input-group fade in active input-group-sm" aling="center" style="position:fixed;left:40%">
		
            <button  id="btn_baja_usuario"  data-toggle="modal" data-target="#ModalBajaUsuario" class="btn btn-outline-primary">Baja Usuario</button>
            &nbsp;
            <button id="btn_baja_servicio"  data-toggle="modal" data-target="#ModalBajaServicio" class="btn btn-outline-primary" onclick="modal_baja_servicio()">Baja Servicio</button>
            &nbsp;
            <button id="btn_baja_check" data-toggle="modal" data-target="#ModalBajaCheck" class="btn btn-outline-primary">Baja Check</button>
      
          </div>
        </div>
	<div class="col-md-2" align="left">	    
    </div>`;   

    $('#btns_certificacionAlta').html(html);
	
	
	
	
}


function certificacionConsulta(){


	var html='';
	html=`
	
<!--	<button class="btn btn-primary btn-md text-center" id="cert_limpiar" style="position:fixed;top:20%;left:52%;" onclick="limpiar_cert_consulta()" >limpiar</button> -->
	
	    <div id="groupbtns_certificacion">
                <div class="col-md-10">
                  <div class="input-group fade in active input-group-sm" style="margin-left:20%;margin-top:-5%">
                    <span class="input-group-addon"><strong>Centro:</strong></span>
                    <input style="width:100px;" type="text" class="form-control" maxlength="6" autofocus="" id="certificacion_centro" disabled>
                    <span class="input-group-addon"><strong># Empleado:</strong></span>
                    <input style="width:100px;" type="text" class="form-control" maxlength="8" autofocus="" id="certificacion_empleado"  onkeyup="validarEmpleador()" >
                    <span class="input-group-addon"><strong>Nombre Empleado:</strong></span>
                    <input style="width:220px;" type="text" class="form-control"  autofocus="" id="certificacion_nombre" readonly="readonly">
                    <span class="input-group-addon"><strong>Fecha:</strong></span>
                    <input style="width:160px;" onpaste="return false" type="date" class="form-control" step="1" min="1995-01-01" max="9999-01-01" id="certificacion_date">
                  </div>
                  <div class="input-group fade in active input-group-sm" style="margin-left:20%;margin-top:1%">
                    <span class="input-group-addon"><strong>Id llamada</strong></span>
                    <input style="width:220px;" type="text" class="form-control"  maxlength="33" autofocus="" id="id_call">
                    <span class="input-group-addon"><strong>Servicio</strong></span>
                    <select style="width:175px;" class="form-control"  autofocus="" id="CCS" onchange="llamarfin()">
                    </select>
					<span class="input-group-addon"><strong>Fin Gestion</strong></span>
                    <select style="width:175px;" class="form-control"  autofocus="" id="CCF"></select>
					<span class="input-group-addon"><strong>Nombre Jefe:</strong></span>
                    <input style="width:220px;" type="text" class="form-control"  id="certificacion_jefe" readonly="readonly">
			
                  </div>       
                </div>
              </div>`;
			  
			   $('#btns_certificacionAlta').html(html);
			   		
			   
			       consultaServicio();
				   var btn1 = document.getElementById("consultarFolios").disabled=false
				   var btn2 = document.getElementById("consultarFolios2").disabled=false
				   
			   
			
}
function consultaServicio(){
				   
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
                   
			
          		   $('#CCS').html(HtmlServicio);
				                 


		          
             
        },
        error:function(xhr,status,error){
          
        }
    });
	
	
	
	
				   
				   }
			   
function consultaFinGestion(){
				   
				
    var id_campana = $("#CCS").val();
    var parametros = "opc=nomFinGestion"
    	+ "&id_campana="+id_campana;
		console.log(parametros);
				
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
                $('#CCF').html(HtmlServicio);
            },
            error:function(xhr,status,error){
				console.log("error");
            	
            }
    });
				
				
				   
			   }
			   
function modal ($opc){
	var html = '';
	if($opc == 'aUsuario'){
		html=`<div class="container">

	  <div class="modal fade" id="exampleModal" role="dialog" >
	    <div class="modal-dialog">
	    
	    	<div class="modal-content" style="width: 60% !important;">

	        	<div class="modal-body">
	                    <div class="panel panel-info"> 
	                <div class="panel-heading">
	                    <h3 class="panel-title"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>Alta De Usuarios</h3>
	                </div>
	                <div class="panel" style="align-content: center;">
	                    <div id="" class="form-group ">
	                        <div class="input-group col-xs-12" style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span class="glyphicon glyphicon-user"></span>
	                            </span>
	                            <input id="txt_mEmpleado" onkeyup="validacionModal(1)" autocomplete="off" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size ="8" maxlength="8" type="text" class="form-control" placeholder="Número de empleado" >
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span>Nombre</span>
	                            </span>
	                            <input id="txt_mNombre" type="" class="form-control"  placeholder="" readonly="readonly">
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Centro</span>
	                            </span>
	                            <input id="txt_mCentro" type="text" class="form-control"  placeholder="" size="6" readonly="readonly">
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Puesto</span>
	                            </span>
	                            <input id="txt_puestonominal" type="text" class="form-control"  placeholder="" readonly="readonly">
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Roll</span>
	                            </span>
	                            <select class="form-control" id="slc_roll" disabled>
	                            	<option value="0">Seleccione</option>
	                            	<option value="1">Jefe CAT</option>
	                            	<option value="2">Operativo</option>
	                            	<option value="3">Administrador</option>
	                            </select>
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Correo</span>
	                            </span>
	                            <input id="email" type="email" class="form-control"  placeholder="Correo" maxlength="64"  readonly="readonly">
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Celular</span>
	                            </span>
	                            <input id="txt_celular" autocomplete="off" onkeyup="validacionCertificacion()" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size ="10" maxlength="10" type="text" class="form-control" placeholder="Celular" readonly="readonly">
	                        </div>
	                    </div>

	                </div>
	            </div>

	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-alert" data-dismiss="modal">Cerrar</button>
	          	<button type="button" id="btn_ingresarAlta" class="btn btn-success" onclick="" disabled>Ingresar</button>
	        </div>
	      </div>      
	    </div>
	  </div>`;
	}else if ($opc == 'aServicio'){
		html=`<div class="container" >

	  <div class="modal fade" id="exampleModal" role="dialog">
	    <div class="modal-dialog">
	    
	    	<div class="modal-content" style="width: 60% !important;">

	        	<div class="modal-body">
	                    <div class="panel panel-info"> 
	                <div class="panel-heading">
	                    <h3 class="panel-title"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>Alta De Servicio</h3>
	                </div>
	                <div class="panel">                  
	                    <div id="" class="form-group ">
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Servicio</span>
	                            </span>
	                            <select class="form-control" id="" >
	                            	<option value="0">Seleccione</option>
	                            	<option value="1">Jefe CAT</option>
	                            	<option value="2">Operativo</option>
	                            	<option value="3">Administrador</option>
	                            </select>
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Funcional</span>
	                            </span>
	                            <select class="form-control" id="" >
	                            	<option value="0">Seleccione</option>
	                            	<option value="1">Jefe CAT</option>
	                            	<option value="2">Operativo</option>
	                            	<option value="3">Administrador</option>
	                            </select>
	                        </div>
	                        <div class="input-group " style="margin-top:2.5%;">
	                            <span class="input-group-addon">
	                                <span >Centralizador</span>
	                            </span>
	                            <select class="form-control" id="slc_roll" >
	                            	<option value="0">Seleccione</option>
	                            	<option value="1">Jefe CAT</option>
	                            	<option value="2">Operativo</option>
	                            	<option value="3">Administrador</option>
	                            </select>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="modal-footer">
	          	<button type="button" class="btn btn-error" data-dismiss="modal">Cerrar</button>
	          	<button type="button" class="btn btn-primary" data-dismiss="">Alta Servicio</button>
	        </div>
	      </div>      
	    </div>
	  </div>`;
	}else if ($opc == 'aCheck'){
	   alertify.confirm('Crear Nuevo Check').set('onok',function(closeEvent){
	      alertify.success('Posicion vaciada');
	         // guardar();
	   });
	}	
	$('#ModalContainer').html(html);
	$('#exampleModal').modal('show');
}

function validacionModal($opc){
	if($opc == 1){
		var numempleado = $('#txt_mEmpleado').val().length;
	    if (numempleado  == 8) {     
		    llamarDatosModal();
		}	
	}
}

function llamarDatosModal(){
	var parametros = "opc=llamarDatosModal" 
		+"&empleado="	+  $('#txt_mEmpleado').val();

	$.ajax ({
      cache: false,
      url: 'assets/php/funciones_certificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
      	if (response.estado == 't') {
      		$('#txt_mNombre').val( response.nombrecompleto );      		
      		$('#txt_mCentro').val( response.centro );
      		$('#txt_puestonominal').val( response.puestonominal );
      		$('#slc_roll').focus();
      		$('#slc_roll').removeAttr('disabled');
      		$('#email').removeAttr('readonly');
      		$('#txt_celular').removeAttr('readonly');
      		
      	}else {
      		bootbox.alert("<div class='error'>El número de Empleado No existe o no se encuentra Activo en el Catalogo de Empleados CAT, favor de verificar e intentar de nuevo</div>", function(){});
      	}
      },
      error:function(xhr,status,error) {
        // $("#imgLoading").hide("true");
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
      }
  });
}
	
function validacionCertificacion(){
  	// var numCentro = $('#txt_centro' ).val().length;
	var Celular = $('#txt_celular' ).val().length;
	    // if(roll != 'seleccione' && email != ''){
	  		if(Celular == 10){
  			// alert(Celular);
	    		$('#btn_ingresarAlta').removeAttr('disabled');
	    	}
	  	// }
}



 function CargaModalAltaServicio(){
	    
	    var parametros = "opc=AltaServicio"
    	+"&id=";
	    
	        $.ajax({
    	cache: false,
        async: false,
        url: 'assets/php/funciones_certificacion.php',
        type: 'POST',
        dataType: 'JSON',
        data: parametros,
        success: function(response){
            var HtmlServicio = '';
			var HtmlCentralizador='';
			var HtmlFuncional='';
            if(response.response ) {
				
            	HtmlServicio +='<option value=""></option>';
                $.each(response.arrayTable, function( key, value ) {
                    HtmlServicio +='<option value="'+value["servicio"]+'">'+value["servicio"]+'</option>';
                });
				
				HtmlCentralizador +='<option value=""></option>';
                $.each(response.arrayTable2, function( key, value ) {
					
                    HtmlCentralizador +='<option value="'+value["nombre_completo_cen"]+'">'+value["nombre_completo_cen"]+'</option>';
                });
				
				HtmlFuncional +='<option value=""></option>';
                $.each(response.arrayTable3, function( key, value ) {
                    HtmlFuncional +='<option value="'+value["nombre_completo_fun"]+'">'+value["nombre_completo_fun"]+'</option>';
                });
				
				console.log(response.arrayTable2);
				console.log(response.arrayTable3);
				
            }
            $('#select_alta_servicio').html(HtmlServicio);
			$('#select_alta_centralizador').html(HtmlCentralizador);
			$('#select_alta_funcional').html(HtmlFuncional);
			
			
		   	
			
 
                         
        },
        error:function(xhr,status,error){
 
        }
    });
	

 }
 
 function validarEmpleador(){
	 
	//var numCentro = $('#certificacion_centro' ).val().length;
	var numempleado = $('#certificacion_empleado' ).val().length;
	console.log(numempleado);
    	
 // if(numCentro == 6){
    //$('#certificacion_empleado' ).focus();
      
    if (numempleado  == 8) {
          console.log(numempleado);
          consultarEmpleador();
          $('#certificacion_date').focus();
    }    
 // }
	 
 }
 

 function consultarEmpleador(){
	 
	 var parametros = "opc=llamarEmpleado" 
		//+"&centro=" 	+ $('#certificacion_centro').val() 
		+"&empleado="	+ $('#certificacion_empleado').val();
		
		
			$.ajax ({
      cache: false,
      url: 'assets/php/funciones_supCalidad.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
      	if (response.estado == 't') {
      		$('#certificacion_nombre').val( response.nombrecompleto );
			$('#certificacion_centro').val( response.centro );
      		$('#certificacion_jefe').val( response.nombrejefe );
      	}else{
      		alert(" no JAlo")
      	}
      },
      error:function(xhr,status,error) {
        // $("#imgLoading").hide("true");
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
      }
  });
	 
	 
	 
	 
 }
 
function limpiar_cert_consulta(){
	debugger;
	$('#certificacion_centro' ).focus();

	$('#certificacion_nombre').val( "" );
    $('#certificacion_centro').val("") 
	$('#certicacion_empleado').val("");
	$('#certificacion_date').val("");
	$('#CCS').val("");
	$('#CCF').val("");

	$("#tableGeneral").hide();
}
/* boton consultar folios  */

$( '#consultarFolios' ).click(function() {
  buscarFolios();

});

$('#consultarFolios2').click(function(){
	
 buscarFolios2();	
	
});

function buscarFolios(){
  var empleado    = $('#certificacion_empleado').val();
  var fecha       = $('#certificacion_date').val();
  var servicio    = $('#CCS').val();
  var finGestion  = $('#CCF').val();

  if (empleado != "") {
    if (fecha != "") {
      if (servicio != "") {
        if (finGestion != "") {
          mostrarTablaCertificacion();
        }else{
          alertify.error('Seleccione fin de gestion');
        }
      }else{
        alertify.error('Seleccione servicio');
      }
    }else{
      alertify.error('Se requiere fecha');
    }
  }else{
     alertify.error('Ingrese numero de empleado');
	 var numero = document.getElementById("certificacion_empleado").focus();
  }
}

function buscarFolios2(){
	

 	var id_llamada = $('#id_call').val();
	
	if(id_llamada != "")
	{
		
        mostrarTablaCertificacionIdllamada(); 
		
        }else{
		
	alertify.error("el campo id esta vacio");
    var id = document.getElementById("id_call").focus();   
   
		
		
	}
	

	
}


 function mostrarTablaCertificacion(){
	 
	 var Bandera = 2;
	 
	 var parametros = 
		" opc=tablaCalidad"
        + "&numEmpleado=" + $("#certificacion_empleado").val()
  		+ "&idServicio=" 	+ $("#CCS").val()
  		+ "&idfinGestion="  + $("#CCF").val()
  		+ "&FechaTabla="  	+ $("#certificacion_date").val().substring(0,4) + $("#certificacion_date").val().substring(5,7)
  		+ "&idFecha="  		+ $("#certificacion_date").val()
        + "&bandera="		+ Bandera;

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
		
			
        		$('#tableCertificacion').html(response.table);
        		$('#tableCertificacion').show();
			
				
        	}else if (response.estado == -200){
            alertify.alert('No Se encontro información!', function(){alertify.error('Ingrese de nuevo');});
          
          }
      	},
      	error:function(xhr,status,error) {
        	//$("#imgLoading").hide("true");
        	alertify.error("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
      	}
  	});
	 
	 
	 
	 
 }
 
function  mostrarTablaCertificacionIdllamada(){

var bandera = 2;

var parametros = "opc=TablaIdllamada"
    +"&dataID="+$("#id_call").val()+"&bandera="+bandera;


		$.ajax({
        cache: false,
        async: false,
        url: 'assets/php/funciones_certificacion.php',
        type: 'POST',
        dataType: 'JSON',
        data: parametros,
        success: function(response){
			    console.log(response);
        	if (response.estado == 1) {
		
			
        		$('#tableCertificacion').html(response.table);
        		$('#tableCertificacion').show();
			
				
        	}else if (response.estado == 2){
            alertify.alert('No Se encontro información!', function(){alertify.error('Ingrese de nuevo');});
          
          }
      	},
      	error:function(xhr,status,error) {
        	//$("#imgLoading").hide("true");
        	alertify.error("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
      	}
  	});

}	
 
 function Recojer_Preguntas_AltaCheck(){
	 
	 
  var c = document.getElementById("select_alta_check").value;

   	 
	 var data = [];
	 var check1;
	 var check2;
	 var check3;
	 
var tabla1 = document.getElementsByClassName("Tbl1_Eval1");
var tabla2 = document.getElementsByClassName("Tbl2_Eval2");
var tabla3 = document.getElementsByClassName("Tbl3_Eval3");
console.log(tabla1.length);
console.log(tabla2.length);
console.log(tabla3.length);


var count1 = 0;
var count2 = 0;
var count3 = 0;


for(var i=1;i<=tabla1.length;i++)
{
    count1++;

	var check = document.getElementById("Tbl1_Pregunta"+i).value;
	var check2 = document.getElementById("Tbl2_Pregunta"+i).value;
	var check3 = document.getElementById("Tbl3_Pregunta"+i).value;
	
	if(check==='' || check2==='' || check3===''){
        
     console.log("campo vacio");	
		
	}else{

		data.push({"aspectos_tecnicos":check,"aspectos_especializados":check2,"dialogo_calido":check3});
		
	}
	
	
	
}

console.log(data);
console.log(c);



var ruta="assets/php/guarda_plantilla_certificacion.php";


	 $.ajax({
	
     cache:false,
     url:ruta,
     type:'POST',
	 data:{'array':JSON.stringify(data),"opc":c},
     success:function (response) { 
            console.log(response);
       Swal.fire("guardado exitoso");
	   
                },
				error:function(xhr,status,error) {
        
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
								
});	


	 
	 
 }
 
function alta_usuario(){
	
	console.log(puesto);
	
	
	//modal alta usuario
	var empleado = document.getElementById("txt_alta_empleado").value;
	var nombre = document.getElementById("txt_alta_nombre").value;
	var centro = document.getElementById("txt_alta_centro").value;
	var puesto = document.getElementById("txt_alta_puesto").value;
	var roll = document.getElementById("select_alta_roll").value;
	var email = document.getElementById("txt_alta_correo").value;
	var cel = document.getElementById("txt_alta_celular").value;
	
	var ruta="assets/php/funcion_alta_usuario.php"
	
	console.log(empleado);
	console.log(nombre);
	console.log(centro);
	console.log(puesto);
	console.log(roll);
	console.log(email);
	console.log(cel);
	
	var parametros = {		
		"Empleado":empleado,
		"Nombre":nombre,
		"Centro":centro,
		"Puesto":puesto,
		"Roll":roll,
		"Email":email,
		"Cel":cel

	 };
	 
	 $.ajax({
		 
		 cache:false,
		 url:ruta,
		 type:'POST',
		 dataType:'JSON',
		 data:parametros,
		 success:function (response){

				 
				 if(response.estado==1)
				 {
					 
					Swal.fire("se registro con exito"); 
					
					 
				 }else if(response.estado==0)
				 {
					 
					 Swal.fire("el usuario ya existe verifique");
					 
				 }
				
				 	 
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });	
 
   

	
	
}

function elimina_usuario(){
	
	var empleado = document.getElementById("baja_usuario").value;
	var textarea = document.getElementById("textarea_baja").value;
	
	var parametros = {
		"Empleado":empleado,
		"Textarea":textarea
		
	}
	
	var ruta = "assets/php/funcion_baja_usuario.php"
	
		 $.ajax({
		 
		 cache:false,
		 url:ruta,
		 type:'POST',
		 data:parametros,
		 success:function (response){
	
				 alert("se borro con exito");
				 
		
			 
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });
	
	
	
}
function guarda_plantilla_certificacion(){

   
   var empleado;
   var nombre;
   var jefe;
   var estado;
   var id_estatus;
   var id_llamada;  
   var centro;
   var servicio;
   var fingestion;
   var fecha;
   var textarea1;
   var textarea2;
   var textarea3;
   var observaciones;   
   var check1 = document.getElementsByClassName("check_cumplir1").length;
   var check2 = document.getElementsByClassName("check_cumplir2").length;
   var check3 = document.getElementsByClassName("check_cumplir3").length;
   
   var totcheck = parseInt(check1)+parseInt(check2)+parseInt(check3);
   

  var cant1 = 0;
  var cant2 = 0;
  var cant3 = 0;  
    
 
  
  
  for(var i=1;i<=check1;i++)
  {  

    var checkbox = document.getElementById("checka"+i);

   if(checkbox.checked == true)
   {
	 
	   cant1++;
	   
   }
 
  }	
  
    for(var j=1;j<=check2;j++)
  {  

    var checkbox = document.getElementById("checkb"+j);

   if(checkbox.checked == true)
   {
	  
	   cant2++;
	   
   }
 
  }	
  
   for(var k=1;k<=check3;k++)
  {  

    var checkbox = document.getElementById("checkc"+k);

   if(checkbox.checked == true)
   {
	  
	   cant3++;
	   
   }
 
  }	
  
  var seleccion = parseInt(cant1)+parseInt(cant2)+parseInt(cant3);
  
  console.log(totcheck);
  console.log(seleccion);
  
  if(seleccion==totcheck)
  {   
      var ruta = "assets/php/guarda_tabla_llamadascertificacion.php";

      id_estatus = 2;
	  
	  nombre = document.getElementById("certificacion_nombre").value;
	  
	  empleado = document.getElementById("certificacion_empleado").value;
	  
	  jefe = document.getElementById("certificacion_jefe").value;
	  
	  centro = document.getElementById("certificacion_centro").value;
	  
	  servicio = document.getElementById("CCS");
	  
	  fingestion = document.getElementById("CCF");
	  
	  fecha = document.getElementById("certificacion_date");
	  
	  var selected = servicio.options[servicio.selectedIndex].text;
	  
	  
	  id_llamada = document.getElementById("button_master").getAttribute("dataID");
	  
      estado = "Aprovada check inicial";
	  
	  textarea1 = $('#txtarea-certificacion1').val();
	  textarea2 = $('#txtarea-certificacion2').val();
	  textarea3 = $('#txtarea-certificacion3').val();
	  
	  observaciones = "1:"+textarea1+"<br/>"+"2:"+textarea2+"<br/>"+"3:"+textarea3;
	  
	  var parametros = "&id_estatus="+id_estatus+"&nombre="+nombre+"&empleado="+empleado+"&jefe="+jefe+"&centro="+centro+"&id_llamada="+id_llamada+"&estado="+estado+"&servicio="+selected+"&observaciones="+observaciones;
	  
	  //Swal.fire("La llamada ha iniciado su proceso de Certificación, ahora se encuentra en espera de ser Evaluada por el Gerente");
	  
	  console.log(parametros);
	  
	  
	  		 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (response){
		  
	        if(response.mensaje == 1)
			{   

                 	Swal.fire("La llamada ha iniciado su proceso de Certificación, ahora se encuentra en espera de ser Evaluada por el Gerente");


			  	$("#miModal").hide();
		
	            $(".modal-backdrop").remove();					
				
			}else if(response.mensaje == 2)
			{ 	
			
			       Swal.fire("llamada actualizada");
				   
				$("#miModal").hide();
		
	            $(".modal-backdrop").remove();
			
			
			}
	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });
	  
	  
	  
	  
  }else{
	  
	  var ruta = "assets/php/guarda_tabla_llamadascertificacion.php";
	  
	  nombre = document.getElementById("certificacion_nombre").value;
	  
	  empleado = document.getElementById("certificacion_empleado").value;
	  
	  jefe = document.getElementById("certificacion_jefe").value;
	  
	  centro = document.getElementById("certificacion_centro").value;
	  
	  servicio = document.getElementById("CCS");
	  var selected = servicio.options[servicio.selectedIndex].text;
	  
  
	  id_llamada = document.getElementById("button_master").getAttribute("dataID");
	  
	  id_estatus = 1;
	  
	  estado = "Rechazada check inicial";
	  
	  textarea1 = $('#txtarea-certificacion1').val();
	  textarea2 = $('#txtarea-certificacion2').val();
	  textarea3 = $('#txtarea-certificacion3').val();
	  
	   observaciones = "1:"+textarea1+"<br/>"+"2:"+textarea2+"<br/>"+"3:"+textarea3;
	  
	  var parametros = "&id_estatus="+id_estatus+"&nombre="+nombre+"&empleado="+empleado+"&jefe="+jefe+"&centro="+centro+"&id_llamada="+id_llamada+"&estado="+estado+"&servicio="+selected+"&observaciones="+observaciones;
	  
	  
	  //Swal.fire("La llamada seleccionada  para proceso  de Certificacion lamentablemte no cumple con los puntos requeridos  favor de retroalimentar al colaborador para encontrar pronto una nueva llamada");
	  
	  	 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (response){
		  
	        if(response.mensaje == 1)
			{   

                 	Swal.fire("La llamada seleccionada  para proceso  de Certificacion lamentablemte no cumple con los puntos requeridos  favor de retroalimentar al colaborador para encontrar pronto una nueva llamada");		 
					
			    $("#miModal").hide();
		
	            $(".modal-backdrop").remove();
				
			}else if(response.mensaje == 2)
			{ 	
			
			       Swal.fire("llamada actualizada");
				   
				$("#miModal").hide();
		
	            $(".modal-backdrop").remove();
			
			
			}
	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });
	  
  }
  
  
         var parametros = "opc=calificacion_certificacion"+"&cant1="+cant1+"&cant2="+cant2+"&cant3="+cant3;
  
 /* 		 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (response){
		  

	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });
  
	*/
	
	
}
function guarda_alta_servicio(){
	

	var parametros = "opc=GuardaAltaServicio"+
	                 "&servicio=" +$('#select_alta_serv').val()
					+"&centralizador=" +$('#select_alta_centralizador').val()
	                +"&funcional=" +$('#select_alta_funcional').val();

	
		var ruta = "assets/php/funciones_certificacion.php"
	
		 $.ajax({
		 
		 cache:false,
		 url:ruta,
		 type:'POST',
		 data:parametros,
		 success:function (response){
	
				 alert("se guardo con exito");
				 
		
			 
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });
	
	
	
	
	
}
function modal_baja_servicio(){
	
	
	var parametros = "opc=BajaServicio";
 
	
	var ruta = "assets/php/funciones_certificacion.php"
	
		 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (data){
		  
	        if(data.estado == 1)
			{   
	            console.log("modal_baja_servicio");
               $('#modal_baja_servicio').html(data.table);
        	   $('#modal_baja_servicio').show();
                 			 
				
			}
	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });
	
	
	
}

function siguiente(){
	
	var arrayTable;
    var cola;
	var colb;
	var colc;

  $(".cola"+count).each(function(){    cola = $(this).text();  }); 
    $(".colb"+count).each(function(){    colb = $(this).text();  }); 
	  $(".colc"+count).each(function(){    colc = $(this).text();  }); 
	  
	  
	  console.log(cola);
	  console.log(colb);
	  console.log(colc);
	  
	  var arrayTable = { 
	  "Servicio":cola,
	  "Funcional":colb,
	  "Centralizador":colc,
	  };
		
	var parametros= "opc=DeleteServicio" + "&Servicio="+cola+"&Funcional="+colb+"&Centralizador="+colc;
	
	var opcion = "DeleteServicio";
	
	var ruta = "assets/php/funciones_certificacion.php";

	$.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:{"opc":opcion,'array':JSON.stringify(arrayTable)},
		 success:function (response){
		  
		  if(response.estado == '1')
		  {
			  alert("se dio de baja correctamente el servicio ");
			  
			  	$("#ModalMotivoBajaServicio").hide();
		
	            $(".modal-backdrop").remove();
			  
			  
		  }
		  

		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });
	
	
}
function cerrar3(x){
	
	count = x;
	
	
	$("#ModalBajaServicio").hide();
		
	 $(".modal-backdrop").remove();
	 
  console.log(x);
	 
	 
	 	
}


function consulta_llamadas_certificacion(){
	
	var parametros = "opc=LlamadasCertificacion";
	
	var ruta = "assets/php/funciones_certificacion.php";
	
	var estatus;
    var columna;
    var count = 0;
	var like;
	var unlike;
	
			 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (response){
		  
	        if(response.estado == 1)
			{   

		       $('#folios_llamadas').html(response.table);
        	   $('#folios_llamadas').show();
			   

			   estatus = document.getElementsByClassName("fila_llamadas_certificacion").length;
			    
			   for(var i=1;i<=estatus;i++)
			   {
				   
				   
				   columna = $('.certc'+i).text();
			
				   
				   if(columna ==="Aprovada Calidad")
				   {
					  count++;
                      console.log(count);				  
					   like = document.getElementById("btn-like"+count).disabled=true;
					  	   unlike = document.getElementById("btn-unlike"+count).disabled=true;
	
					   
				   }
				   
				   
			   }
			   
                                 			 
				
			}else if(response.estado == 2)
			{
				
				
				
				
			}
	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });

	
}

function borrar_registro_certicacion(count){
	
	 console.log(count);
	 
	 var certa;
	 var certb;
	 var cartc;
	 
	$(".certa"+count).each(function(){    certa = $(this).text();  }); 
    $(".certb"+count).each(function(){    certb = $(this).text();  }); 
	$(".certc"+count).each(function(){    certc = $(this).text();  });
	
	var ruta = "assets/php/funciones_certificacion.php";
	

	
	var parametros = "opc=deleteCertificacion"+"&certa="+certa+"&certb="+certb+"&certc="+certc;
	console.log(parametros);

	
	
	 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (response){
		  
	        if(response.estado == 1)
			{   

              Swal.fire("se elimino correctamente");
			  
			  location.reload();
                                 			 
				
			}else if(response.estado == 2)
			{
				
				Swal.fire("no se encontraron llamadas en proceso de certificacion");
				
				
			}
	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });

	
}

function ApruebaCalidad(count){
	
	 console.log(count);
	 
	 var certa;
	 var certb;
	 var cartc;
	 
	$(".certa"+count).each(function(){    certa = $(this).text();  }); 
    $(".certb"+count).each(function(){    certb = $(this).text();  }); 
	$(".certc"+count).each(function(){    certc = $(this).text();  });
	
	var ruta = "assets/php/funciones_certificacion.php";
	

	
	var parametros = "opc=AprobarLlamada"+"&certa="+certa+"&certb="+certb+"&certc="+certc;
	console.log(parametros);

	
	
	 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (response){
		  
	        if(response.estado == 1)
			{   

              Swal.fire("la llamada a sido aprovada");
			  
			  location.reload();
                                 			 
				
			}else if(response.estado == 0)
			{
				
				Swal.fire("error");
				
				
			}
	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });

	
}


function RechazaCalidad(count){
	
	 console.log(count);
	 
	 var certa;
	 var certb;
	 var cartc;
	 
	$(".certa"+count).each(function(){    certa = $(this).text();  }); 
    $(".certb"+count).each(function(){    certb = $(this).text();  }); 
	$(".certc"+count).each(function(){    certc = $(this).text();  });
	
	var ruta = "assets/php/funciones_certificacion.php";
	

	
	var parametros = "opc=RechazarLlamada"+"&certa="+certa+"&certb="+certb+"&certc="+certc;
	console.log(parametros);

	
	
	 $.ajax({
		 cache: false,
         async: false,
		 url:ruta,
		 type:'POST',
		 dataType: 'JSON',
		 data:parametros,
		 success:function (response){
		  
	        if(response.estado == 1)
			{   

              Swal.fire("la llamada a sido rechazada");
			  
			  location.reload();
                                 			 
				
			}else if(response.estado == 0)
			{
				
				Swal.fire("error");
				
				
			}
	
		 },
	     error:function(xhr,status,error){
			 
			 
		 }	 
			 
	 });

	
}

function limpiarTxt3(){
//	$('#txt_centro' ).focus();

	$('#certificacion_nombre').val( "" );
    $('#certificacion_jefe').val( "" );
    $('#certificacion_centro').val("");
	$('#certificacion_empleado').val("");
	$('#certificacion_date').val("");
	$('#CCS').val("");
	$('#CCF').val("");

	$('#pruebadecss').remove();
	
	$("#tableCertificacion").hide();
}

