var FlagValidacion;
var BanderaIp;
// var BanderaIp;
// // ajax para guadar los datos ingresado en el modal ........
function guardar() {
   var opcionguardar = "guardo";
   if (!FlagValidacion) {
      opcionguardar = "limpiar";
      /*$.each($('.limpiar-celdas'),function(key,value){
      if(value.value == ''){
      alert('LLENA TODO');
      event.preventDefault();
      return false;
      }
      });*/
   }///FIN FlagValidacion
   if (BanderaIp) {
      var z = $("#id").val();
      var a = $("#posicion").val();
      var b = $("#ip").val();
      var c = $("#numempleado").val();
      var d = $("#nombre").val();
      var e = $("#ape_paterno").val();
      var f = $("#ape_materno").val();
      var g = $("#jefe").val();
      var h = $("#gerente").val();
      var i = $("#campana").val();
      var j = $("#servicio").val();
      var k = $("#centro").val();
      var l = $("#edificio").val();
      var m = $("#piso").val();
      var n = $("#turno").text();
      // console.log('llego');
      var Parameters = {
         "posibility"   :   opcionguardar,
         "posicion"     :   a,
         "ip"           :   b,
         "numempleado"  :   c,
         "nombre"       :   d,
         "ape_paterno"  :   e,
         "ape_materno"  :   f,
         "jefe"         :   g,
         "gerente"      :   h,
         "campana"      :   i,
         "servicio"     :   j,
         "centro"       :   k,
         "edificio"     :   l,
         "piso"         :   m,
         "turno"        :   n,
         "bandera"      :   FlagValidacion,
      };

      // console.log(Parameters);


      $.ajax({
         cache: false,
         url: '../../../assets/php/script.php',
         type: 'POST',
         dataType: 'json',
         data: Parameters,
         success: function(response) {
         console.log('estado: '+ response.estado);   
            if(response.estado == 1 || response.estado == 2)
            {
               $(".limpiar-celdas").val(''); //Limpia todos los campos
               $("#mensaje").text(response.mensaje);
            }
            else if(response.estado == 3 || response.estado == 0 )
            {
               $("#gerente").attr("readonly",true);
               $("#jefe").attr("readonly",true);
               $("#campana").attr("readonly",true);
               $("#ip").attr("readonly",true);
               $("#numempleado").attr("readonly",true);
               $("#guardar").attr("disabled",true);              
               $("#mensaje").text(response.mensaje);
               // console.log('llego',response.estado)
               setTimeout(function(){$('#exampleModal').modal('hide')},3000);                
            }
            else
            {
               $("#mensaje").text(response.mensaje);
            }
            var turno = $("#turno").text();
            var edifioSelected  = $("#sedificio").text();
            var pisoSelected    = $("#spiso").text();
            ColorCasillasParticular(turno,edifioSelected,pisoSelected);
            ContadorPosiciones();
         },
         error:function(xhr,status,error) {            
            alert("Error - function: guardar()");
         }
      });
   } else {
      $('#mensaje').text('Ingrese una IP Correcta');
   }
};

// ajax para buscar y mostrar al colaborador por el #empelado ..........
function empleado() {   
   var a = $("#numempleado").val();
   var Parameters = "posibility=buscar&numempleado="+a;

   var index = $("#index").text();
   var url = '';
   if (index == 'index')
   {
      url ='assets/php/script.php';
   }
   else
   {
      url ='../../../assets/php/script.php';
   }

   $.ajax({
      cache: false,
      url: url,
      type: 'POST',
      dataType: 'json',
      data: Parameters,
      success: function(response) {
         if(response.estado == 0)
         {
         $("#nombre").val(response.valores.nombre);
         $("#ape_paterno").val(response.valores.apellidopaterno);
         $("#ape_materno").val(response.valores.apellidomaterno);
         $("#jefe").val(response.valores.nombrejefe);
         $("#servicio").val(response.valores.servicio);
         $("#centro").val(response.valores.centro);
         $("#txtnombre").val(response.valores.nombre+' '+response.valores.apellidopaterno+' '+response.valores.apellidomaterno);
         $("#mensaje").text(response.mensaje);
         }
         else
         {
            $("#mensaje").text(response.mensaje);
         }
      },

      error:function(xhr,status,error) {            
         $("#mensaje").text("Empleado no Encontrado");
      },
   });
};

// ajax para mostrar lo guardado en cada posición .........
function mostrar(that) {
   var posicion = $(that).attr('id');               
   var edificio = $("#edificio").val();
   var piso  = $("#piso").val();
   var turno  = $("#turno").text();

   var Parameters = {
      "posibility" : "mostrar",
      "Posicion"   : posicion,
      "edificio"   : edificio,
      "piso"       : piso,
      "turno"      : turno,
   };

   // console.log(Parameters);

   $.ajax({
      async: true,
      cache: false,
      url: '../../../assets/php/script.php',
      type: 'POST',
      dataType: 'json',
      data: Parameters,
      success: function(response) {
         if(response.estado == 0)
         {
            $("#ip").val(response.valores.ip);  
            $("#numempleado").val(response.valores.numempleado);
            $("#gerente").val(response.valores.gerente);
            $("#jefe").val(response.valores.jefe);
            var cadena = (response.valores.ejecutivo);
            separador = " "; // un espacio en blanco
            ejecutivo = cadena.split(separador);
            $("#nombre").val(ejecutivo[0]+" "+ejecutivo[1]);
            $("#ape_paterno").val(ejecutivo[2]);
            $("#ape_materno").val(ejecutivo[3]);
            $("#campana").val(response.valores.campana);
            $("#servicio").val(response.valores.servicio);
            $("#centro").val(response.valores.centro);
            $("#edificio").val(response.valores.edificio);
            $("#piso").val(response.valores.piso);
            $("#gerente").attr("readonly",true);
            $("#campana").attr("readonly",true);
            $("#jefe").attr("readonly",true);
            $("#ip").attr("readonly",true);
            $("#numempleado").attr("readonly",true);
            $("#guardar").attr("disabled",true);
            $("#mensaje").text(response.mensaje);
         }
         else
         {
            $("#mensaje").text(response.mensaje);
         }
      },
      error:function(xhr,status,error) {
         $("#mensaje").text("Posicion Libre");
      },
   });
};

function limpiar() {
   $("#gerente").attr("readonly",false);
   $("#campana").attr("readonly",false);
   $("#jefe").attr("readonly",false);
   $("#ip").attr("readonly",false);
   $("#numempleado").attr("readonly",false);
   $("#guardar").attr("disabled",false);
   $(".limpiar-celdas").val(''); //Limpia todos los campos
   FlagValidacion = false;
   BanderaIp = true;
};

//Registran en la BD los nuevos usuarios que podrán acceder al sistema.
function alta_nuevo_usuario() {
   var a = $("#numempleado").val();
   var b = $("#txtnombre").val();
   var c = $("#txtcontrasena").val();
   var d = $("#txtconfirmarcontrasena").val();

   var index = $("#index").text();
   var url = '';
   if (index == 'index')
   {
      url ='assets/php/script.php';
   }
   else
   {
      url ='../../../assets/php/script.php';
   }

   var Parameters = "posibility=altausario&numempleado="+ a +"&txtnombre=" + b +"&txtcontrasena=" + c + "&txtconfirmarcontrasena=" + d;

   $.ajax({
      cache: false,
      url: url,
      type: 'POST',
      dataType: 'json',
      data: Parameters,
      success: function(response) {
         if(response.valores.estado == 0)
         {
            $("#mensaje").text(response.valores.mensaje);
            $(".limpiar-celdas").val(''); //Limpia todos los campos
            console.log('limpia');
         }
         else
         {
            $("#mensaje").text(response.valores.mensaje);
            console.log('No limpia');
         }
      },
      error:function(xhr,status,error,response) { 
         alert("Error de Petición");
      },
   });
};

function ContadorPosiciones() {
   var a = $("#turno").text();
   var b = $("#sedificio").text();
   var c = $("#spiso").text();

   var Parameters = {
      "posibility" : "Posiciones",
      "turno"      : a,
      "edificio"   : b,
      "piso"       : c,
   };

   // console.log(Parameters);

   $.ajax({
      cache: false,
      url: '../../../assets/php/script.php',
      type: 'POST',
      dataType: 'json',
      data: Parameters,
      success: function(response) {                
         if(response.estado1 == 0)
         {
            $("#posiciones_ocupadas").text(response.contador1);
            $("#posiciones_libres").text(response.contador2);
         }
         else
         {
            console.log('error - function: ContadorPosiciones(success)');
         }
      },
      error:function(xhr,status,error) {            
         alert("error - function: ContadorPosiciones(error)");
      }
   });
}

function ColorCasillasParticular(turnoSelected,edifioSelected,pisoSelected) {
   var Parameters = 'posibility=casillas'
   +'&turnoSelected='+turnoSelected
   +'&edifioSelected='+edifioSelected
   +'&pisoSelected='+pisoSelected;

   $.ajax({
      cache: false,
      url: '../../../assets/php/script.php',
      type: 'POST',
      dataType: 'json',
      data: Parameters,
      success: function(response) {
         if(response.estado == 0)
         {
            var turnoClass = 'M';
            if (turnoSelected == 'VESPERTINO')
            {
               turnoClass = 'V';
            }
            $.each(response.valores,function(key,value)
            {
               var posicion =value.posicion;
               if(posicion.search("OFI") == -1)
               {
                  var texto='posicion';
                  posicion = texto+posicion;
               }
               if(value.bandera == 0)
               {
                  $('.'+posicion+turnoClass).removeClass('ocupado');
                  $('.'+posicion+turnoClass).addClass('libre');
                  $('.'+posicion+turnoClass).attr('title', 'IP: '+value.ip+'\n'+'Empleado: '+value.numempleado);
               }
               else
               {
                  $('.'+posicion+turnoClass).removeClass('libre');
                  $('.'+posicion+turnoClass).addClass('ocupado');
                  $('.'+posicion+turnoClass).attr('title', 'IP: '+value.ip+'\n'+'Empleado: '+value.numempleado);                  
               }
            });
         }
         else
         {
         console.log('error - function: ColorCasillas()');
         }
      },
      error:function(xhr,status,error) {            
         alert("Error - function: ColorCasillas()");
      }
   });    
}//FIN ColorCasillasParticular

function OpcionColorCasillas(turnoSelected,edifioSelected,pisoSelected) {
   var Parameters = 'posibility=casillas'
      +'&turnoSelected=' +turnoSelected
      +'&edifioSelected='+edifioSelected
      +'&pisoSelected='  +pisoSelected;

   $.ajax({
      cache: false,
      url: '../../../assets/php/script.php',
      type: 'POST',
      dataType: 'json',
      data: Parameters,
      success: function(response) {
         if(response.estado == 0)
         {
            var turnoClass = 'M';
            if (turnoSelected == 'VESPERTINO') {
               turnoClass = 'V';
            }
            $.each(response.valores,function(key,value)
            {
               var posicion =value.posicion;
               if(posicion.search("OFI") == -1){
                  var texto='posicion';
                  posicion = texto+posicion;
               }
               $('.'+posicion+turnoClass).removeClass('ocupado');
               $('.'+posicion+turnoClass).removeClass('libre');
            });
         }
         else
         {
            console.log('error - function: ColorCasillas()');
         }
      },
      error:function(xhr,status,error) {            
         alert("Error - function: ColorCasillas()");
      }
   });    
}//FIN OpcionColorCasillas

function CaracteresvalidosIP(evt) {
   var code = evt.which ? evt.which : evt.keyCode;
   if ((code == 8) || (code == 46) || (code >= 48 && code <= 57)) {
      return true;
   } else {
      return false;
   }
}//FIN CaracteresvalidosIP()

function CaracteresvalidosNunempleado(evt) {
   var code = evt.which ? evt.which : evt.keyCode;
   if ((code == 8) || (code >= 48 && code <= 57)) {
      return true;
   } else {
      return false;
   }
}//FIN CaracteresvalidosNunempleado()

function ValidaIP() {
   var ip = $('#ip').val();
   var IpSeparada        = '';
   var ValidaPunto       = '';
   var ValidaNumero      = '';
   var ValidaCantNumeros = '';
   var Tamano            = ip.length;
   var BanderaPunto      = false;
   var BanderaCanNumeros = false;
   BanderaIp             = false;
   IpSeparada            = ip.split('');

   if (IpSeparada['0'] == '.' || IpSeparada['0'] == 0 || IpSeparada[Tamano-1] == '.' || ip == '') {
      $("#mensaje").text('IP incorrecta');
   } else {
      for (var i = 0; i <= Tamano; i++) {
         if (IpSeparada[i] == '.') {
            ValidaPunto++;
         }
         for (var j = 0; j <= 10; j++) {
            if (IpSeparada[i] == j) {
               ValidaNumero++;
            }
         }
         if (IpSeparada[i] == '.' && IpSeparada[i+1] == '.') {
            BanderaPunto = true;
         }
         if (IpSeparada[i] != '.') {
            ValidaCantNumeros++;
            if (ValidaCantNumeros >= 4) {
               BanderaCanNumeros = true;
            }
         } else {
            ValidaCantNumeros = 0;
         }
      }

      if (ValidaPunto == 3 && ValidaNumero >= 4 && BanderaCanNumeros == false && BanderaPunto == false) {
         BanderaIp = true;
         $("#mensaje").text('IP Correcta');
      } else {
         $("#mensaje").text('IP incorrecta');
      }
   }
}//FIN ValidaIP()

// function Confirmacion() {
//    var respuesta = '';
//    respuesta = confirm('¿Está seguro de limpiar esta posición?');

//    if (respuesta) {
//       limpiar();
//       guardar();   
//    }
// }//FIN Confirmacion()

function Confirmacion() {
   alertify.confirm('¿Está seguro de limpiar esta posición?').set('onok',function(closeEvent){
      alertify.success('Posicion vaciada');
         limpiar();
         guardar(); 
   });
}//FIN Confirmacion()

$(document).ready(function() {
   $("#vespertino").click(function(){
      $('.mapa_imagen').hide("fast");
      $('.mapa_imagen1').show("slow");
      $("#turno1").removeClass('card-header card-header-success');
      $("#turno").removeClass('btn btn-success bt round dropdown-toggle');
      $("#turno1").addClass('card-header card-header-warning');
      $("#turno").addClass('btn btn-warning bt round dropdown-toggle');
   });
   $("#matutino").click(function(){
      $('.mapa_imagen1').hide("fast");
      $('.mapa_imagen').show("slow");
      $('#turno1').removeClass("card-header card-header-warning");
      $('#turno').removeClass("btn btn-warning bt round dropdown-toggle");
      $('#turno1').addClass("card-header card-header-success");
      $('#turno').addClass("btn btn-success bt round dropdown-toggle");
   });
});

$(document).ready(function() {
   var edificio = $('#index').text();
   if (edificio != 'index') {
      $("#matutino").click(function(){        
         $("#turno").text('MATUTINO');
         var edifioSelected  = $("#sedificio").text();
         var pisoSelected    = $("#spiso").text();
         ColorCasillasParticular('MATUTINO',edifioSelected,pisoSelected);
         ContadorPosiciones();
         // $('#switch').prop('checked',true); // Codigo del SWITCH para Activar/Desactivar los colores de las casillas
      });
      $("#vespertino").click(function(){        
         $("#turno").text('VESPERTINO');
         var edifioSelected  = $("#sedificio").text();
         var pisoSelected    = $("#spiso").text();
         ColorCasillasParticular('VESPERTINO',edifioSelected,pisoSelected);
         ContadorPosiciones();
         // $('#switch').prop('checked',true); // Codigo del SWITCH para Activar/Desactivar los colores de las casillas
      });

      // $('#switch').click(function() { // Codigo del SWITCH para Activar/Desactivar los colores de las casillas
      //    var turnoSelected  = $("#turno").text();
      //    var edifioSelected = $("#sedificio").text();
      //    var pisoSelected   = $("#spiso").text();
      //    if($('#switch').is(':checked')) {
      //       ColorCasillasParticular(turnoSelected,edifioSelected,pisoSelected);
      //       // console.log('activo');
      //    } else {
      //       OpcionColorCasillas(turnoSelected,edifioSelected,pisoSelected);
      //       // console.log('inactivo');
      //    }
      // });

      ColorCasillasParticular('MATUTINO',$("#sedificio").text(),$("#spiso").text());
      ContadorPosiciones();
   }
});

function anadir_usuarios() {
  var HTML = `
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-med" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel" style="color:#B2B2B2">Añadir Usuario</h3>
                   <button type="button" coordslass="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </div>
              <div class="modal-body">

                  <form>
                      <div class="form-row">
                          <div class="form-group col-med-10">
                              <label style="color: black;">Numero de empleado
                                  <div class="input-group-append">
                                  <input class="form-control limpiar-celdas" type="text" name="numempleado" id="numempleado" size="15" maxlength="8" onkeypress="return CaracteresvalidosNunempleado(event);">
                                    <button type="button" class="btn btn-info btn-xs" onclick="empleado();" id="guardar1">B</button>
                                  </div>
                              </label>
                          </div>
                          <div class="form-group col-med-10">
                              <label style="color: black;">Nombre
                                  <input class="form-control limpiar-celdas" type="text" name="txtnombre" id="txtnombre">
                              </label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-med-10">
                              <label style="color: black;">Contraseña
                                  <label style="color: red;">*</label>
                                  <input class="form-control limpiar-celdas" type="password" placeholder="Contraseña" name="txtcontrasena" id="txtcontrasena">
                              </label>
                          </div>
                          <div class="form-group col-med-10">
                              <label style="color: black;">Confirmar contraseña
                                  <label style="color: red;">*</label>
                                  <input class="form-control limpiar-celdas" type="password" placeholder="Confirmar contraseña" name="txtconfirmarcontrasena" id="txtconfirmarcontrasena">
                          </div>
                      </div>
                  </form>

              </div>
              <div class="modal-footer">
                  <br><label id="mensaje"></label>
                  <button type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                  <button type="button" class="btn btn-primary btn-xs" onclick="alta_nuevo_usuario();" id="guardar" >Guardar</button>
              </div>
          </div>
      </div>
  </div>
  `;
  $("#ModalContainer").html(HTML);
  $('#exampleModal').modal('toggle');
};

function Test(ip) {
  var edifioSelected = $("#sedificio").text();
  var pisoSelected   = $("#spiso").text();
  FlagValidacion = true;

  var Pos = ip.id;
  var HTML = `
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" name="div1">
      <div class="modal-dialog modal-med" role="document" name="div2" style="">
          <div class="modal-content" name="div3">
              <div class="modal-header" name="div4">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" coordslass="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" name="div5">

                  <div class="form-row">
                      <div class="form-group col-med-10">
                          <label> PC <input type=text class="form-control" name="posicion" id="posicion" placeholder="Posición de la IP" autocomplete="off" readonly="readonly"></label>
                      </div>
                      <div class="form-group col-med-6">
                        <label> IP <input type="text" class="form-control  limpiar-celdas" name="ip" id="ip" autocomplete="off" placeholder="Ingrese su IP" maxlength="15" onBlur="ValidaIP();" onkeypress="return CaracteresvalidosIP(event);"></label>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="input-group col-xs-5">
                          <label> #Empleado: <input type="text" class="form-control  limpiar-celdas" name="numempleado" id="numempleado" placeholder="Ingrese su Num. Empleado" autocomplete="off"  maxlength="8" onkeypress="return CaracteresvalidosNunempleado(event);"> 
                              <div class="input-group-append ">
                                  <button type="button" class="btn btn-info btn-xs" onclick="empleado();" id="guardar1">B</button>
                              </div> 
                          </label>  
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-lg-6">
                        <label> Nombre: <input type=text class="form-control limpiar-celdas" name="nombre" id="nombre" autocomplete="off" readonly="readonly"></label>
                      </div> 
                      <div class="form-group col-med-6">
                        <label> Apellido Paterno: <input type=text class="form-control limpiar-celdas" name="ape_paterno" id="ape_paterno" autocomplete="off" readonly="readonly"></label>
                      </div> 
                  </div>
                  <div class="form-row">
                      <div class="form-group col-med-6">
                          <label> Apellido Materno: <input type=text class="form-control limpiar-celdas" name="ape_materno" id="ape_materno" autocomplete="off" readonly="readonly"></label>
                      </div> 
                      <div class="form-group col-med-6"> 
                          <label>Jefe:<input type=text class="form-control limpiar-celdas" name="jefe" id="jefe" autocomplete="off"></label>
                      </div>
                      <div class="form-group col-med-6"> 
                          <label>Gerente:<input type=text class="form-control limpiar-celdas" name="gerente" id="gerente" autocomplete="off"></label>
                      </div>
                      <div class="form-group col-med-6">
                          <label>Campaña:<input type=text class="form-control limpiar-celdas" name="campana" id="campana" autocomplete="off"></label>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-med-6">
                          <label>Servicio: <input type="text" class="form-control limpiar-celdas" name="servicio" id="servicio" readonly="readonly" ></label>
                      </div>
                      <div class="form-group col-sm-4">
                          <label>Centro: <input type=text class="form-control limpiar-celdas" id="centro" autocomplete="off" readonly="readonly"></label>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-xs-4" style="display: none">
                          <label>Edificio:<input type="text" class="form-control" id="edificio" value="${edifioSelected}" readonly="readonly"></label>
                      </div>
                      <div class="form-group  col-xs-4" style="display: none">
                          <label>Piso:<input type="text" class="form-control" id="piso" value="${pisoSelected}" readonly="readonly"></label>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-xs" onclick="Confirmacion();">Limpiar Posicion</button>
                      <button type="button" class="btn btn-primary btn-xs" onclick="guardar();" id="guardar" >Guardar</button>
                  </div>
                  
                  <div class="modal-footer">
                    <br><label id="mensaje"></label>
                    <br><label id="mens"></label>
                    <br><label id="menslimpiar"></label>
                  </div>
              </div>
          </div>
      </div>
  </div>
  `;
  $("#ModalContainer").html(HTML);
  $('#exampleModal').modal('toggle');
  $('#posicion').val(Pos);
};