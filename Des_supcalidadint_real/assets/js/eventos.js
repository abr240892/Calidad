/*Hecho por Jorge Garcia*/
/*Modificado por Jorge Mondragon*/
/*Modificado por Alexis Félix*/



var inicia = function() {
   $("#window").jqxWindow(
    {
        maxHeight: 120, 
        maxWidth: 550, 
        minHeight: 30, 
        minWidth: 550, 
        height: 200, 
        width: 150,
        resizable: false, 
        isModal: true, 
        modalOpacity: 0.3,
        title:"Mensaje",
        autoOpen: false,
        showAnimationDuration: 500,
        closeAnimationDuration: 500
    });
    $("#imgLoading" ).hide("true");
    $("#imgLoading2" ).hide("true");
    
	$(function () {
        Example.init({
            "selector": ".bb-alert"
        });
    });

    /** CANCELAR ZOOM **/
   $(document).keydown(function(event) {
    if (event.ctrlKey==true && (event.which == '61' || event.which == '107' || event.which == '173' || event.which == '109'  || event.which == '187'  || event.which == '189'  ) ) {
        event.preventDefault();
     }
    // 107 Num Key  +
    // 109 Num Key  -
    // 173 Min Key  hyphen/underscor Hey
    // 61 Plus key  +/= key
    });

    $(window).bind('mousewheel DOMMouseScroll', function (event) {
           if (event.ctrlKey == true) {
           event.preventDefault();
           }
    });

    var dtfecha = new Date();
    dtfecha = new Date(dtfecha.getTime());
    var yyyy = dtfecha.getFullYear().toString();
    var mm   = (dtfecha.getMonth()+1).toString();
    var dd   = (dtfecha.getDate()-1).toString();
    var mmChars = mm.split('');
    var ddChars = dd.split('');
    var FechaHoy = yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
    var Fecha = $("#fechaSeg2");
    Fecha.val(FechaHoy);
    document.getElementById('fechaSeg2').setAttribute("max", FechaHoy);
    
    /*$("#Generar-1").prop("disabled",true);
    $("#Generar-2").prop("disabled",true);
    $("#Generar-3").prop("disabled",true);
    $("#Generar-4").prop("disabled",true);
    $("#Generar-5").prop("disabled",true);*/
}

$(document).on("ready",inicia);
var limpiaTable = function() {

	$("#tableGeneral-1").html("");
	$("#tableGeneral-2").html("");
    $("#tableGeneral-3").html("");
    $("#tableGeneral-4").html("");
    $("#tableGeneral-5").html("");
	$("[type='text']").val("");
  
    desabilitar();
}


/*var Generar = function(tipo){
    if (tipo == '5') {
        botonGenerarCalidadMonitoreo();
    }else{
        botonGenerar(tipo);
        botonGenerarPromo(tipo);
        botonGenerarValid(tipo);    
    }
    
}*/

// var cargarFinGestion = function(){
//   var servicio = $('#idServicio').val();
//   var htmlCMBfingestion = '';
//   switch(servicio) {
//         case 'COBRANZA':
//             htmlCMBfingestion += '  <option value="Convenio">Convenio</option>';
//             htmlCMBfingestion += '  <option value="Negativa de Pago">Negativa de Pago</option>';
//             htmlCMBfingestion += '  <option value="Devolucion">Devolución</option>';
//             htmlCMBfingestion += '  <option value="No Define">No Define</option>';
//             htmlCMBfingestion += '  <option value="Aclaracion">Aclaración</option>';
//             htmlCMBfingestion += '  <option value="Ya Abono">Ya Abonó</option>';
//             htmlCMBfingestion += '  <option value="Recado">Recado</option>';
//             htmlCMBfingestion += '  <option value="LLamar Despues">Llamar Después</option>';
//             htmlCMBfingestion += '  <option value="No contesto">No contestó</option>';
//             htmlCMBfingestion += '  <option value="Equivocado">Equivocado</option>';
//             htmlCMBfingestion += '  <option value="No Existe">No existe</option>';
//             htmlCMBfingestion += '  <option value="Fax">Fax</option>';
//             htmlCMBfingestion += '  <option value="Colgo">Colgó</option>';
//             htmlCMBfingestion += '  <option value="Telefono Sin Extension">Teléfono sin Extensión</option>';
//             htmlCMBfingestion += '  <option value="Celular No Disponible">Celular No Disponible</option>';
//             htmlCMBfingestion += '  <option value="Telefono Fuera de Servicio">Teléfono Fuera de Servicio</option>';
//             htmlCMBfingestion += '  <option value="Mensaje de Voz">Mensaje de Voz</option>';
//             htmlCMBfingestion += '  <option value="Ya No Vive Ahi">Ya No Vive Ahí</option>';
//             htmlCMBfingestion += '  <option value="Ocupado">Ocupado</option>';
//             htmlCMBfingestion += '  <option value="No Marque">No Marqué</option>';
//             htmlCMBfingestion += '  <option value="Sin Resultado">Sin Resultado</option>';
//             htmlCMBfingestion += '  <option value="Recordatorio">Recordatorio</option>';
            
//             break;
//         case 'BANCOPPEL':
//             htmlCMBfingestion += '  <option value="Convenio">Convenio</option>';
//             htmlCMBfingestion += '  <option value="Negativa de Pago">Negativa de Pago</option>';
//             htmlCMBfingestion += '  <option value="Devolucion">Devolución</option>';
//             htmlCMBfingestion += '  <option value="No Define">No Define</option>';
//             htmlCMBfingestion += '  <option value="Aclaracion">Aclaración</option>';
//             htmlCMBfingestion += '  <option value="Ya Abono">Ya Abonó</option>';
//             htmlCMBfingestion += '  <option value="Recado">Recado</option>';
//             htmlCMBfingestion += '  <option value="LLamar Despues">Llamar Después</option>';
//             htmlCMBfingestion += '  <option value="No contesto">No contestó</option>';
//             htmlCMBfingestion += '  <option value="Equivocado">Equivocado</option>';
//             htmlCMBfingestion += '  <option value="No Existe">No existe</option>';
//             htmlCMBfingestion += '  <option value="Fax">Fax</option>';
//             htmlCMBfingestion += '  <option value="Colgo">Colgó</option>';
//             htmlCMBfingestion += '  <option value="Telefono Sin Extension">Teléfono sin Extensión</option>';
//             htmlCMBfingestion += '  <option value="Celular No Disponible">Celular No Disponible</option>';
//             htmlCMBfingestion += '  <option value="Telefono Fuera de Servicio">Teléfono Fuera de Servicio</option>';
//             htmlCMBfingestion += '  <option value="Mensaje de Voz">Mensaje de Voz</option>';
//             htmlCMBfingestion += '  <option value="Ya No Vive Ahi">Ya No Vive Ahí</option>';
//             htmlCMBfingestion += '  <option value="Ocupado">Ocupado</option>';
//             htmlCMBfingestion += '  <option value="No Marque">No Marqué</option>';
//             htmlCMBfingestion += '  <option value="Sin Resultado">Sin Resultado</option>';
//             htmlCMBfingestion += '  <option value="Recordatorio">Recordatorio</option>';
//             break;
//         case 'PROMOCION':
//             htmlCMBfingestion += '<option value="Promocion">Promoci&oacute;n</option>';
//             htmlCMBfingestion += '<option value="Ya Recogio Tarjeta">Ya Recogi&oacute; Tarjeta</option>';
//             htmlCMBfingestion += '<option value="Ya Compro">Ya Compr&oacute;</option>';
//             htmlCMBfingestion += '<option value="Recado">Recado</option>';
//             htmlCMBfingestion += '<option value="Llamar despues">Llamar despues</option>';
//             htmlCMBfingestion += '<option value="Colgo">Colg&oacute;</option>';
//             htmlCMBfingestion += '<option value="Ocupado">Ocupado</option>';
//             htmlCMBfingestion += '<option value="Mensaje de voz">Mensaje de voz</option>';
//             htmlCMBfingestion += '<option value="No Contesto">No Contesto</option>';
//             htmlCMBfingestion += '<option value="Fax">Fax</option>';
//             htmlCMBfingestion += '<option value="Fuera de Serv.">Fuera de Serv.</option>';
//             htmlCMBfingestion += '<option value="Ya no vive ahi">Ya no vive ahi</option>';
//             htmlCMBfingestion += '<option value="Equivocado">Equivocado</option>';
//             htmlCMBfingestion += '<option value="Tel. Sin Ext.">Tel. Sin Ext.</option>';
//             htmlCMBfingestion += '<option value="No Existe">No Existe</option>';
//             htmlCMBfingestion += '<option value="Cel. No Disp.">Cel. No Disp.</option>';
//             htmlCMBfingestion += '<option value="Buro de Credito">Bur&oacute; de Cr&eacute;dito.</option>';
//             htmlCMBfingestion += '<option value="Cliente Fallecio">Cliente Falleci&oacute;.</option>';
//             htmlCMBfingestion += '<option value="No le interesa el Credito">No le interesa el Cr&eacute;dito.</option>';
//             htmlCMBfingestion += '<option value="No le Interesa Promocion">No le Interesa Promoci&oacute;n</option>';
//             break;
//         case 'VALIDACION':
//             htmlCMBfingestion += '  <option value="Convenio">Convenio</option>';
//             htmlCMBfingestion += '  <option value="Negativa de Pago">Negativa de Pago</option>';
//             htmlCMBfingestion += '  <option value="Devolucion">Devolución</option>';
//             htmlCMBfingestion += '  <option value="No Define">No Define</option>';
//             htmlCMBfingestion += '  <option value="Aclaracion">Aclaración</option>';
//             htmlCMBfingestion += '  <option value="Ya Abono">Ya Abonó</option>';
//             htmlCMBfingestion += '  <option value="Recado">Recado</option>';
//             htmlCMBfingestion += '  <option value="LLamar Despues">Llamar Después</option>';
//             htmlCMBfingestion += '  <option value="No contesto">No contestó</option>';
//             htmlCMBfingestion += '  <option value="Equivocado">Equivocado</option>';
//             htmlCMBfingestion += '  <option value="No Existe">No existe</option>';
//             htmlCMBfingestion += '  <option value="Fax">Fax</option>';
//             htmlCMBfingestion += '  <option value="Colgo">Colgó</option>';
//             htmlCMBfingestion += '  <option value="Telefono Sin Extension">Teléfono sin Extensión</option>';
//             htmlCMBfingestion += '  <option value="Celular No Disponible">Celular No Disponible</option>';
//             htmlCMBfingestion += '  <option value="Telefono Fuera de Servicio">Teléfono Fuera de Servicio</option>';
//             htmlCMBfingestion += '  <option value="Mensaje de Voz">Mensaje de Voz</option>';
//             htmlCMBfingestion += '  <option value="Ya No Vive Ahi">Ya No Vive Ahí</option>';
//             htmlCMBfingestion += '  <option value="Ocupado">Ocupado</option>';
//             htmlCMBfingestion += '  <option value="No Marque">No Marqué</option>';
//             htmlCMBfingestion += '  <option value="Sin Resultado">Sin Resultado</option>';
//             htmlCMBfingestion += '  <option value="Recordatorio">Recordatorio</option>';
//             break;

//         case 'ECOMMERCE':
//             htmlCMBfingestion += '  <option value="Se lleno solicitud">Se lleno solicitud</option>';
//             htmlCMBfingestion += '  <option value="Si le interesa abondono llamada">Si le interesa abondono llamada</option>';
//             htmlCMBfingestion += '  <option value="Error captura de datos">Error captura de datos</option>';
//             htmlCMBfingestion += '  <option value="No le interesa el credito">No le interesa el credito</option>';
//             htmlCMBfingestion += '  <option value="Ya es cliente Coppel">Ya es cliente Coppel</option>';
//             htmlCMBfingestion += '  <option value="Ya es solicitante">Ya es solicitante</option>';
//             htmlCMBfingestion += '  <option value="No acepto recibir informacion">No acepto recibir informacion</option>';
//             htmlCMBfingestion += '  <option value="Equivocado">Equivocado</option>';
//             htmlCMBfingestion += '  <option value="Recado">Recado</option>';
//             htmlCMBfingestion += '  <option value="Colgo">Colgo</option>';
//             htmlCMBfingestion += '  <option value="No responde">No responde</option>';
//             htmlCMBfingestion += '  <option value="Fuera de servicio">Fuera de servicio</option>';
//             htmlCMBfingestion += '  <option value="Cel. no disponible">Cel. no disponible</option>';
//             htmlCMBfingestion += '  <option value="Tel. ocupado">Tel. ocupado</option>';
//             htmlCMBfingestion += '  <option value="Fax">Fax</option>';
//             htmlCMBfingestion += '  <option value="Recado contestadora">Recado contestadora</option>';
//             htmlCMBfingestion += '  <option value="Datos incompletos">Datos incompletos</option>';
//             htmlCMBfingestion += '  <option value="Credito no autorizado por parametrico">Credito no autorizado por parametrico</option>';
//             htmlCMBfingestion += '  <option value="Credito no autorizado">Credito no autorizado</option>';
//             htmlCMBfingestion += '  <option value="Se lleno solicitud, se trabo el sistema de tienda">Se lleno solicitud, se trabo el sistema de tienda</option>';
//             htmlCMBfingestion += '  <option value="Solicitud rechazada por cobranza">Solicitud rechazada por cobranza</option>';
//             htmlCMBfingestion += '  <option value="Acudira a Tienda">Acudira a Tienda</option>';
//             htmlCMBfingestion += '  <option value="Vive en el Extranjero">Vive en el Extranjero</option>';
//             htmlCMBfingestion += '  <option value="Solicitante Fallecio">Solicitante Fallecio</option>';
//             htmlCMBfingestion += '  <option value="Solicitante Mayor de EDAD">Solicitante Mayor de EDAD (> 75 años)</option>';
//             htmlCMBfingestion += '  <option value="Solicitante Menor de EDAD">Solicitante Menor de EDAD  (< 16 años)</option>';
//             htmlCMBfingestion += '  <option value="No cumple con los requisitos">No cumple con los requisitos</option>';
//             htmlCMBfingestion += '  <option value="Buzon de Voz">Buzon de Voz</option>';
//             htmlCMBfingestion += '  <option value="Esposo(a) ya tiene credito">Esposo(a) ya tiene credito</option>';
//             htmlCMBfingestion += '  <option value="Llamar despues">Llamar despues</option>';
//             htmlCMBfingestion += '  <option value="No se encontro domicilio">No se encontro domicilio</option>';
//             htmlCMBfingestion += '  <option value="Pre solicitud de Broma">Pre solicitud de Broma</option>';
//             break;
//     }
//     $('#idfinGestion').html(htmlCMBfingestion);
// }

var limpiaTable2 = function(){
    $("#tableGeneral-1").html("");
    $("#tableGeneral-2").html("");
    $("#tableGeneral-3").html("");
    $("#tableGeneral2-1").html("");
    $("#tableGeneral2-2").html("");
    $("#tableGeneral2-3").html("");
}

var validanumeros = function(tecla) {
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
var validaCampos = function(tipo) {
    //$("#botonGenera").prop("disabled", true);
	typeConsult = "";
    typeConsult = tipo;

	if (typeConsult > 0 ) {

        		if(typeConsult=='1') {
                    //$("#botonGenera").prop("disabled", false);
                    if($("#theDateTel").val()=='')
                    {
                        $("#imgLoading" ).hide("true");
                        Example.show('<div class="alerta">Capturar fecha para realizar la busqueda</div>');
                        $("#theDateTel").css({'border': '2px solid #F10606'});
                        $("#theDateTel").focus();
                    }
                    else{

                        $("#imgLoading" ).hide("true");
                        $("#theDateTel").css({'border': '1px solid #CCCCCC'});
        			if($("#txt_numtelefono1").val()=="") {
        				Example.show('<div class="alerta">Proporcione un telefono</div>');
        			}else if($("#txt_numtelefono1").val().length!=10) {
        				Example.show('<div class="alerta">Telefono es a 10 digitos</div>');
        			}else{
        				seeTable(typeConsult);
                        /** $("#pruebadecssdatoshistoricos").html(""); **/
                     //   seeTableHistory(typeConsult);
        			 }
                    }
        		}else if(typeConsult=='2') {
                    //$("#botonGenera").prop("disabled", false);
                    if($("#theDateCT").val()=='')
                    {
                        $("#imgLoading" ).hide("true");
                        Example.show('<div class="alerta">Capturar fecha para realizar la busqueda</div>');
                        $("#theDateCT").css({'border': '2px solid #F10606'});
                        $("#theDateCT").focus();
                    }
                    else{
                        $("#imgLoading" ).hide("true");
                        $("#theDateCT").css({'border': '1px solid #CCCCCC'});

        			if($("#txt_numtelefono2").val()=="" || $("#txt_numcliente").val()=="") {
        				Example.show('<div class="alerta">Proporcione telefono y cliente</div>');
        			}else if($("#txt_numtelefono2").val().length!=10) {
        				Example.show('<div class="alerta">Telefono es a 10 digitos</div>');
        			}else{
        				seeTable(typeConsult);
                        seeTableHistory(typeConsult);
        			 }
                    }
        		}else if(typeConsult=='4') {
              /** $("#pruebadecssdatoshistoricos").html(""); **/
                    if($("#Employye").val()=='')
                    {
                        $("#imgLoading" ).hide("true");
                        Example.show('<div class="alerta">Digite un empleado para realizar la busqueda</div>');
                        $("#Employye").css({'border': '2px solid #F10606'});
                        $("#Employye").focus();
                        return;
                    }else{
                        $("#imgLoading" ).hide("true");
                        $("#Employye").css({'border': '1px solid #CCCCCC'});
                    }

                    if($("#finGestion").val()=="" || $("#puntualidad").val()=="") {
                        Example.show('<div class="alerta">Proporcione Fin Gestion y Puntualidad</div>');
                        return;
                    }
                    if($("#fechaSeg").val() == '' || $("#fechaSeg2").val() == ''){
                        $("#imgLoading" ).hide("true");
                        Example.show('<div class="alerta">Ingrese una fecha para realizar la busqueda</div>');
                        $("#fechaSeg").css({'border': '2px solid #F10606'});
                        $("#fechaSeg2").css({'border': '2px solid #F10606'});
                        $("#fechaSeg").focus();
                        return;
                    }else{
                    	$("#imgLoading" ).hide("true");
                        $("#fechaSeg").css({'border': '1px solid #CCCCCC'}); 
                        $("#fechaSeg2").css({'border': '1px solid #CCCCCC'}); $("#fechaSeg2").focus();
                        var fecha1 = $("#fechaSeg").val();
                        var fecha2 = $("#fechaSeg2").val();
                        var comprobar1= fecha1.substring(5,7);
                        var comprobar2= fecha2.substring(5,7);
                        if(comprobar1 != comprobar2){
                        	Example.show('<div class="alerta">Las fechas deben ser del mismo mes</div>');
                        	return;
                        }else{
                        	seeTable(typeConsult);
                		}

                    }

                }/*else if(typeConsult=='3'){
                   
                   // $("#botonGenera").prop("disabled", false);
                    if ($("#theDate").val()=="") 
                    {
                        $("#imgLoading" ).hide("true");
                        Example.show('<div class="alerta">Capturar fecha para realizar la busqueda</div>');
                        $("#theDate").css({'border': '2px solid #F10606'});
                        $("#theDate").focus();
                    }
                    else{
                        $("#imgLoading" ).hide("true");
                        $("#theDate").css({'border': '1px solid #CCCCCC'});
    			        if($("#txt_numcliente2").val()=="") {
    			            Example.show('<div class="alerta">Proporcione un cliente</div>');
    			            $("#txt_numcliente2").focus();
    			        }else{
			            seeTable(typeConsult);
			            seeTableHistory(typeConsult);
			             }
                    }
        	    }*/
        }
    }
var validaCamposCalidad = function(event) {

             
    /** $("#pruebadecssdatoshistoricos").html(""); **/
    if($("#Fechaini").val() == '' || $("#Fechafin").val() == ''){
        $("#imgLoading" ).hide("true");
        Example.show('<div class="alerta">Ingrese una fecha para realizar la busqueda</div>');
        $("#Fechaini").css({'border': '2px solid #F10606'});
        $("#Fechafin").css({'border': '2px solid #F10606'});
        $("#Fechaini").focus();
    }else{
        MostrarDatosCalidad();
    }
  
}
var MostrarDatosCalidad = function() {
    $("#tableGeneral-5").html("");
    $("#imgLoading").show("true");
    var Fechaini = $("#Fechaini").val();
    var fechaSqueryini = Fechaini.substring(0,4)+Fechaini.substring(5,7);
    
    var parametros = "opc=tablaCalidad&idServicio="+$("#idServicio").val()+"&fechaSqueryini="+fechaSqueryini;
    parametros +="&idfinGestion="+$("#idfinGestion").val()+"&Fechaini="+Fechaini;
    parametros +="&id="+Math.random();
  $.ajax ({
      cache: false,
      url: 'php/functions.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
        $("#imgLoading").hide("true");
        if(response.estado == 1) {
            $("#tableGeneral-5").html(response.table);
            $(".Reproducir").on("click",CargaModalAudio);
            // desabilitar();
            $("#Generar-5").prop("disabled",false);
        }else{
          Example.show('<div class="alerta">No se encontraron movimientos.</div>');
        }
      },
      error:function(xhr,status,error) {
        $("#imgLoading").hide("true");
          bootbox.alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
      }
  });
}
var seeTable = function(typeConsult) {
    $("#tableGeneral-"+typeConsult+"").html("");
	$("#imgLoading").show("true");
    var fecha1 = $("#theDateTel").val();
    var fechaSquery1 = fecha1.substring(0,4)+fecha1.substring(5,7);
    //var fecha = $("#theDate").val();
    //var fechaSquery = fecha.substring(0,4)+fecha.substring(5,7);
    var fecha2 = $("#theDateCT").val();
    var fechaSquery2 = fecha2.substring(0,4)+fecha2.substring(5,7);
	var parametros = "opc=informationResult"+"&typeConsult="+typeConsult;
    switch(typeConsult) {
        case '1':
            parametros +="&telefono="+$("#txt_numtelefono1").val()+"&cliente="+0+"&fecha="+$("#theDateTel").val()+"&fechaQuery="+fechaSquery1;
            break;
        case '2':
            parametros +="&telefono="+$("#txt_numtelefono2").val()+"&cliente="+$("#txt_numcliente").val()+"&fecha="+$("#theDateCT").val()+"&fechaQuery="+fechaSquery2;
            break;
        /*case '3':
            parametros +="&telefono="+0+"&cliente="+$("#txt_numcliente2").val()+"&empleado="+$("#txtEmployye").val()+"&finG="+$("#txtfindegestion").val()+"&fecha="+$("#theDate").val()+"&fechaQuery="+fechaSquery;
            break;*/
        case '4':
            parametros +="&Employye="+$("#Employye").val()+"&finGestion="+$("#finGestion").val()+"&puntualidad="+$("#puntualidad").val()+"&fechaSeg="+$("#fechaSeg").val()+"&fechaSeg2="+$("#fechaSeg2").val()+"&nombreServicio="+$("#selectServicio").val();
            break;
    }
 
    parametros +="&id="+Math.random();
    var urlcheck="";
    if(typeConsult==4){urlcheck='php/seguimiento.php';}else{urlcheck='php/functions.php';}
	$.ajax ({
     	cache: false,
     	url: urlcheck,
     	type: 'POST',
     	dataType: 'json',
     	data: parametros,
     	success: function(response) {//console.log(response.query);
     		$("#imgLoading").hide("true");
     		if(response.estado == 1) {
                $("#tableGeneral-"+typeConsult+"").html(response.table);
                $(".btnAudio").on("click",CargaModalAudio);
                $(".Reproducir").on("click",CargaModalAudio);
                $("#Generar-"+typeConsult+"").prop("disabled",false);
               // desabilitar();
                $("#Generar-"+typeConsult+"").prop("disabled",false);
               
     		}else{
     			Example.show('<div class="alerta">No se encontraron movimientos.</div>');
         
               // alert(response.alert);
     		}
        },
        error:function(xhr,status,error) {
        	$("#imgLoading").hide("true");
           	bootbox.alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
            //alert(response.alert);
        }
	});
}

var seeTableHistory = function(typeConsult){
    $("#tableGeneral2-"+typeConsult+"").html("");
    $("#imgLoading2").show("true");
    limpiaTable2();
    var parametros ="opc=informationResultHistory"+"&typeConsult="+typeConsult;
    switch(typeConsult){
        case '1':
        parametros +="&telefono="+$("#txt_numtelefono1").val()+"&cliente="+0;
            break;
        case '2':
            parametros +="&telefono="+$("#txt_numtelefono2").val()+"&cliente="+$("#txt_numcliente").val();
            break;
        case '3':
            parametros +="&telefono="+0+"&cliente="+$("#txt_numcliente2").val();
            break;
        }
        parametros +="&id="+Math.random();
        $.ajax({
            cache: false,
            url: 'php/historicos.php',
            type: 'POST',
            dataType: 'json',
            data: parametros,
            success: function(response){           
                if(response.estado == 1) {
                    $("#imgLoading2").hide("true");
                    $("#tableGeneral2-"+typeConsult+"").html(response.table);
                    //alert(response.query);
                }else{
                    $("#imgLoading2").hide("true");
                    Example.show('<div class="alerta">No se encontraron movimientos Historicos.</div>');
                    //alert(response.query);
                }
            },
            error: function(xhr,status,error){
                $("#imgLoading2").hide("true");
                bootbox.alert("<div class='error'>informationResultHistory:"+xhr.responseText+"</div>", function(){});

            }
        });
}

var desabilitar = function(){
    $("#Generar-1").prop("disabled",true);
    $("#Generar-2").prop("disabled",true);
    $("#Generar-3").prop("disabled",true);
    $("#Generar-4").prop("disabled",true);
    $("#Generar-5").prop("disabled",true);
}

/*var botonGenerar = function(tipo)
{
 
    $("#imgLoading").show("true");
    typeConsult = tipo;
    var parametros = "opc=genCSV"+"&typeConsult="+typeConsult;

    console.log(typeConsult+' esto regresa');

    var fecha1 = $("#theDateTel").val();
    var fechaSquery1 = fecha1.substring(0,4)+fecha1.substring(5,7);
    var fecha = $("#theDate").val();
    var fechaSquery = fecha.substring(0,4)+fecha.substring(5,7);
    var fecha2 = $("#theDateCT").val();
    var fechaSquery2 = fecha2.substring(0,4)+fecha2.substring(5,7);
    switch(typeConsult) {
        case '1':
            parametros +="&telefono="+$("#txt_numtelefono1").val()+"&cliente="+0+"&fecha="+$("#theDateTel").val()+"&fechaQuery="+fechaSquery1;
            break;
        case '2':
            parametros +="&telefono="+$("#txt_numtelefono2").val()+"&cliente="+$("#txt_numcliente").val()+"&fecha="+$("#theDateCT").val()+"&fechaQuery="+fechaSquery2;
            break;
        case '3':
            parametros +="&telefono="+0+"&cliente="+$("#txt_numcliente2").val()+"&empleado="+$("#txtEmployye").val()+"&finG="+$("#txtfindegestion").val()+"&fecha="+$("#theDate").val()+"&fechaQuery="+fechaSquery;
            break;
        }
        //Enviamos los datos al PHP atraves de ajax         
         $.ajax({
         cache: false,
         url: 'php/functions.php',
         type: 'POST',
         dataType: 'json',
         data: parametros,
         success: function(response)
         {
           if(response.respuesta == true)
           { 
            //$("#tableGeneral-"+typeConsult+"").html(response.respuesta);
              $( "#imgLoading" ).hide("true");
                MuestraMensaje("El archivo se genero correctamente en la ruta: \\\\10.44.15.232\\catnomina\\consultamovimientoscat");
             // $("#botonGenera").prop("disabled",false);
           }else
            {
              $( "#imgLoading" ).hide("true");
              MuestraMensaje("No hay registros de la tabla movimientos_monitoreo");
            //  $("#botonGenera").prop("disabled",false);
            }
         },
         error:function(xhr,ajaxOptions,x)
         {
             MuestraMensaje("ERROR PHP: "+xhr.responseText,'Error');
             //MuestraMensaje("Error en la consulta");
           //  $("#botonGenera").prop("disabled",false);
         }
      });
}*/
/*var botonGenerarPromo = function()
{

    $("#imgLoading").show("true");
    var parametros = "opc=genCSVpromo"+"&typeConsult="+typeConsult;
    var fecha1 = $("#theDateTel").val();
    var fechaSquery1 = fecha1.substring(0,4)+fecha1.substring(5,7);
    var fecha = $("#theDate").val();
    var fechaSquery = fecha.substring(0,4)+fecha.substring(5,7);
    var fecha2 = $("#theDateCT").val();
    var fechaSquery2 = fecha2.substring(0,4)+fecha2.substring(5,7);
    switch(typeConsult) {
        case '1':
            parametros +="&telefono="+$("#txt_numtelefono1").val()+"&cliente="+0+"&fecha="+$("#theDateTel").val()+"&fechaQuery="+fechaSquery1;
            break;
        case '2':
            parametros +="&telefono="+$("#txt_numtelefono2").val()+"&cliente="+$("#txt_numcliente").val()+"&fecha="+$("#theDateCT").val()+"&fechaQuery="+fechaSquery2;
            break;
        case '3':
            parametros +="&telefono="+0+"&cliente="+$("#txt_numcliente2").val()+"&empleado="+$("#txtEmployye").val()+"&finG="+$("#txtfindegestion").val()+"&fecha="+$("#theDate").val()+"&fechaQuery="+fechaSquery;
            break;
    }
 
    //Enviamos los datos al PHP atraves de ajax         
     $.ajax({
     cache: false,
     url: 'php/functions.php',
     type: 'POST',
     dataType: 'json',
     data: parametros,
     success: function(response)
     {
       if(response.respuesta == true)
       { 
          $( "#imgLoading" ).hide("true");
    
            MuestraMensaje("El archivo se genero correctamente en la ruta: \\\\10.44.15.232\\catnomina\\consultamovimientoscat");
    
         // $("#botonGenera").prop("disabled",false);

       }else
        {
          $( "#imgLoading" ).hide("true");
          MuestraMensaje("No hay registros de la tabla movimientos_monitoreo");
         // $("#botonGenera").prop("disabled",false);
        }
     },
     error:function(xhr,ajaxOptions,x)
     {
         MuestraMensaje("ERROR PHP: "+xhr.responseText,'Error');
         //MuestraMensaje("Error en la consulta");
         //$("#botonGenera").prop("disabled",false);
        }
    });
}*/

var CargaModalAudio = function(){
    var dataID = $(this).attr("dataID");
    console.log(dataID);
    $('#divLlenaAudio').html('');
    //var tamano = "auto";
    var parametros = "opc=verAudio"+
                     "&dataID="+dataID+
                     "&id="+Math.random();
    //Enviamos los datos al PHP atraves de ajax
    $.ajax({
      cache: false,
      async: false,
      //timeout: 1000,
      url: 'php/functions.php',
      type: 'POST',
      dataType: 'JSON',
      data: parametros,
      success: function(response){
          if(response.estado == 1){

            var boton = new wimpyPlayer({
                    target  : "divLlenaAudio", 
                    media : response.ruta ,
                    //skin : "wimpy.skins/Music.tsv",
                    width : 350,
                    height : 200
                });
            
              //$('#divLlenaAudio').html(response.modaltable);
              $('#divLlenaAudio').dialog({
              	  closeOnEscape: false,
			      open: function(event, ui) {
			        $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
			      },
                  title: "Reproducir Audio",
                  autoOpen: false,
                  height: "auto",
                  width: "auto",
                  show: "blind",
                  resizable: false,
                  dialogClass: 'modal-primary',
                  modal: true,
                   buttons: [
                         
                      {
                          text: "Cancel",
                          class: 'btn btn-primary',
                          click: function() {
                              $('#divLlenaAudio').html('');
                              $( this ).dialog( "close" );
                              
                          }
                      }
                  ]
              });
              $("#divLlenaAudio").dialog("open");
          }
      },
      error:function(xhr,status,error){
          MuestraMensaje("ERROR PHP: "+xhr.responseText,'Error');
      }
    });
}
/*var botonGenerarValid = function()
{
        
    $("#imgLoading").show("true");
    var parametros = "opc=genCSVvalid"+"&typeConsult="+typeConsult;
    var fecha1 = $("#theDateTel").val();
    var fechaSquery1 = fecha1.substring(0,4)+fecha1.substring(5,7);
    var fecha = $("#theDate").val();
    var fechaSquery = fecha.substring(0,4)+fecha.substring(5,7);
    var fecha2 = $("#theDateCT").val();
    var fechaSquery2 = fecha2.substring(0,4)+fecha2.substring(5,7);
    switch(typeConsult) {
        case '1':
            parametros +="&telefono="+$("#txt_numtelefono1").val()+"&cliente="+0+"&fecha="+$("#theDateTel").val()+"&fechaQuery="+fechaSquery1;
            break;
        case '2':
            parametros +="&telefono="+$("#txt_numtelefono2").val()+"&cliente="+$("#txt_numcliente").val()+"&fecha="+$("#theDateCT").val()+"&fechaQuery="+fechaSquery2;
            break;
        case '3':
            parametros +="&telefono="+0+"&cliente="+$("#txt_numcliente2").val()+"&empleado="+$("#txtEmployye").val()+"&finG="+$("#txtfindegestion").val()+"&fecha="+$("#theDate").val()+"&fechaQuery="+fechaSquery;
            break;
    }
    //Enviamos los datos al PHP atraves de ajax         
     $.ajax({
     cache: false,
     url: 'php/functions.php',
     type: 'POST',
     dataType: 'json',
     data: parametros,
     success: function(response)
     {
       if(response.respuesta == true)
       { 
          $( "#imgLoading" ).hide("true");
            MuestraMensaje("El archivo se genero correctamente en la ruta: \\\\10.44.15.232\\catnomina\\consultamovimientoscat");
           // alert(response.filtro);
          //$("#botonGenera").prop("disabled",false);

       }else
        {
          $( "#imgLoading" ).hide("true");
          MuestraMensaje("No hay registros de la tabla movimientos_monitoreo");
          //$("#botonGenera").prop("disabled",false);
         // alert(response.filtro);
        }
     },
     error:function(xhr,ajaxOptions,x)
     {
         MuestraMensaje("ERROR PHP: "+xhr.responseText,'Error');
         //MuestraMensaje("Error en la consulta");
        // $("#botonGenera").prop("disabled",false);
         //alert(response.filtro);
     }
  });
}*/

/*var botonGenerarCalidadMonitoreo = function(){

    $("#imgLoading").show("true");
    typeConsult = '5';
    var parametros = "opc=genCSV"+"&typeConsult="+typeConsult;

    var fecha1 = $("#Fechaini").val();
    var fechaSquery = fecha1.substring(0,4)+fecha1.substring(5,7);
   
    parametros ="opc=genCSVMonitoreo"+"&servicio="+$("#idServicio").val()+"&fingestion="+$("#idfinGestion").val()+"&fecha="+$("#Fechaini").val()+"&fechtabla="+fechaSquery;

        //Enviamos los datos al PHP atraves de ajax         
         $.ajax({
         cache: false,
         url: 'php/functions.php',
         type: 'POST',
         dataType: 'json',
         data: parametros,
         success: function(response)
         {
           if(response.respuesta == true)
           { 
              $( "#imgLoading" ).hide("true");
                $("#Generar-5").prop("disabled",false);
                MuestraMensaje("El archivo se genero correctamente en la ruta: \\\\10.44.15.232\\catnomina\\consultamovimientoscat");
           }else
            {
              $( "#imgLoading" ).hide("true");
              MuestraMensaje("No hay registros de la tabla movimientos_monitoreo");
            }
         },
         error:function(xhr,ajaxOptions,x)
         {
             MuestraMensaje("ERROR PHP: "+xhr.responseText,'Error');
         }
      });
}*/
    //Muestra los mensajes de la pagina.
var MuestraMensaje = function(strMensaje)
{
      $('#mensaje').text(strMensaje);
      $('#window').jqxWindow('open');
}
    //termina modicicacion David Bernal
var Example = (function() {
    "use strict";
    var elem,
        hideHandler,
        that = {};

    that.init = function(options) {
        elem = $(options.selector);
    };

    that.show = function(text) {
        clearTimeout(hideHandler);
        elem.find("span").html(text);
        elem.delay(200).fadeIn().delay(1000).fadeOut();
    };
    return that;
}());


