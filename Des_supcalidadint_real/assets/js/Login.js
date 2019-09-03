$(document).on("ready",inicio);




function inicio(){
    CambiarOpc(1);
	
    CargaHtmlServicio();
    $('#selectServicio').on('change',CargaHtmlFinGestion);
    $('#tableGeneral').hide();



    general(2);
}



    var dtfecha = new Date();
    var yyyy = dtfecha.getFullYear().toString();
    var mm   = (dtfecha.getMonth()+1).toString();
    var dd   = dtfecha.getDate().toString();
     
    // CONVERT mm AND dd INTO chars
    var mmChars = mm.split('');
    var ddChars = dd.split('');
     
    // CONCAT THE STRINGS IN YYYY-MM-DD FORMAT
    var fecha = yyyy + '-'+(mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]) ;
    $("#fecha").html(fecha);

    var dtfecha2 = new Date();
    var yyyy = dtfecha2.getFullYear().toString();
    var mm   = (dtfecha2.getMonth()+1).toString();
    var dd   = dtfecha2.getDate().toString();
     
    // CONVERT mm AND dd INTO chars
    var mmChars = mm.split('');
    var ddChars = dd.split('');
     
    // CONCAT THE STRINGS IN YYYY-MM-DD FORMAT
    var fecha2 = yyyy + '-'+(mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]) ;
    $("#fecha2").html(fecha2);

$.ajaxSetup({cache: false});
var Login = Login || {};

Login.validateKey = function(tecla) {
    if (event.keyCode == 13 && $(this).val().length > 7) {
        Login.callFingerPrint();
    }else if(event.keyCode == 13 && $(this).val().length < 8) {
        alertify.error('Numero empleado incorrecto');
        $("#txtEmployyee").focus();
    }else if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
    }
}

function general($id){    

   var tbl_general;
   var tbl_calific;


    $('#btn_supervicion').removeClass('active');
    $('#btn_administrador').removeClass('active');
    $('#btn_consulta').removeClass('active');
    $('#btn_certificacion').removeClass('active');


    $('#groupbtns_supervicion').hide();
    $('#groupbtns_administrador').hide();
    $('#groupbtns_consultar').hide();
    $('#btns_certificacion').hide();

	
    $('#groupbtns_super').hide();
    $('#groupbtns_admin').hide();
	
    $('#groupbtns_consul').hide();
    $('#groupbtns_certificacion').hide();
	$('#form_preguntas').hide();
	$('#btns_certificacion').hide();


    // $('#btn_administrador').hide();

   
    if ($id == 1) {
		
        $('#btn_administrador').addClass('active');
        $('#groupbtns_administrador').show();
        $('#groupbtns_admin').show();

		// tbl_general = document.getElementById('tableGeneral').style.display='none';
		// tbl_calific = document.getElementById('tableCalificaciones').style.display='none';
		$('#tableGeneral').hide();
		$('#tableCalificaciones').hide();
		$('#tableCertificacion').hide();
	 
		
		
		limpiarTxt();
		limpiarTxt2();
		limpiarTxt3();
		
		
    }else if($id == 2){
        $('#btn_supervicion').addClass('active');
        $('#groupbtns_supervicion').show();
        $('#groupbtns_super').show();
		$('#tableGeneral').show();
		$('#tableCalificaciones').hide();
		$('#tableCertificacion').hide();
		   $('#form_preguntas2').hide();
	

		
		limpiarTxt2();
		limpiarTxt3();
		
		 //tbl_general = document.getElementById('tableGeneral').style.display='block';
		 //tbl_calific = document.getElementById('tableCalificaciones').style.display='none';

    }else if($id == 3){
		
		console.log('consulta calificaciones');
		
        $('#btn_consulta').addClass('active');
        $('#groupbtns_consultar').show();
         $('#groupbtns_consul').show();
		    $('#form_preguntas2').hide();
		 
		  //tbl_general = document.getElementById('tableGeneral').style.display='none';
		  //tbl_calific = document.getElementById('tableCalificaciones').style.display='block';
		//$('#tableGeneral').hide();
		 $('#tableCalificaciones').show();
		 $('#tableCertificacion').hide();
		  
		 
		 
		 //limpiar table sup_calidad.js
		 
		 limpiarTxt();
		 limpiarTxt3();
		 
		 
    }else if($id == 4){
        $('#btn_certificacion').addClass('active');
        $('#btns_certificacion').show();
        $('#groupbtns_certificacion').show();
		$('#form_preguntas2').hide();
	
		
		 //tbl_general = document.getElementById('tableGeneral').style.display='none';
		 //tbl_calific = document.getElementById('tableCalificaciones').style.display='none';
	     	$('#tableGeneral').hide();
			$('#tableCalificaciones').hide();
			$('#tableCertificacion').show();
		
			  
			  limpiarTxt();
			  limpiarTxt2();
	
	
    }

}

/*Funciones Login con Huella */
function LevantaHuella(paramEmpleado) {
    var parametros = "opc=openFingerPrintHuella"
        +"&numberEmployee="+ paramEmpleado 
        +"&id="+Math.random();
    $.ajax({
        cache: false,
        url: 'assets/php/callFunctionFinger.php',
        type: 'POST',
        dataType: 'json',
        data: parametros,
        success: function(response) {
            if(response.estado == 0) {

                var parametros = "opc=RetornaEmpleado"
                     +"&empleado="+ $('#txtEmpleado').val();
                $.ajax({    
                    type: 'POST',
                    async: true,
                    dataType: 'json',
                    url: 'assets/php/callFunctionFinger.php',
                    data: parametros,
                    success: function(data) {
                       
                        if(data) {

                            window.location.href = 'index.php';
                            general(2);
                        } else {

                            alertify.error('Personal no autorizado');
                        }

                    },
                    error:function(xhr,status,error) {
                        alert("openFingerPrintHuella:"+xhr.responseText+"");
                    }
                });
            } else {
                bootbox.alert("<div class='error'>El número de Empleado No existe o no se encuentra Activo en el Catalogo de Empleados CAT, favor de verificar e intentar de nuevo</div>", function(){});
            }

        },
        error:function(xhr,status,error) {
            alert("openFingerPrintHuella:"+xhr.responseText+"");
        }
    });
}

function CambiarOpc($id){

    $("#tabHuella").css('display: none');
    $("#tabContra").css('display: none');
    $("#tab1").removeClass('active');
    $("#tab2").removeClass('active');

    // var opcion=id;
    if($id == 1)    {
        $("#tabContra").show();
        $("#tab1").addClass('active');

        $("#tabHuella").hide();
    }else if ($id == 2){
        $("#tabHuella").show();
        $("#tab2").addClass('active');
        $("#tabContra").hide();
    }
}

function fnValidaUsuario(){   
    var numEmpleado = $("#numero").val();
    var Contrasena = $("#clave").val();
    // alert('Numero: '+numEmpleado);
    // alert('Contra: '+Contrasena);

    var parametros = "numero=" + numEmpleado +"&clave=" + Contrasena;

    if (numEmpleado == "" || Contrasena == "") {
        if (numEmpleado == "") {
            alertify.error('No se ha capturado numero de empleado');
        } else {
            alertify.error('No se ha capturado Contraseña');    
        }
    } else {
        $.ajax({    
            type: 'POST',
            async: true,
            dataType: 'json',
            url: 'assets/php/Datos.php',
            data: parametros,
            success: function(data) {
                if(data.estado == 1) {
                    window.location.href = 'index.php';
                    alertify.success('Correcto');
                } else {
                    alertify.error('Usuario o contraseña incorrectos');
                }
            },      
            error: function() {

                alert("ERROR en ajax (js-varificuarusuario.js)"); 
            }
        });
    }
}

function editar_plantilla(){

	 var btn2 = document.getElementById('inser_preg').disabled=false;
	 
	 $( "input" ).each(function() {				

				   $('input').removeAttr("disabled");
				   
			});
			
			
}


var destruyesession = function(){       
   window.location="assets/php/callFunctionFinger.php?opc=1";
}