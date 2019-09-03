
	 $('#inser_preg').click(function() {
	
	// inputs por clase
	
	$('input[color="rojo"]').removeAttr("color");
	
    var inputs1 = document.getElementsByClassName("input-text-t1").length;
	   var inputs2 = document.getElementsByClassName("input-text-t2").length;
	      var inputs3 = document.getElementsByClassName("input-text-t3").length;
		  
		  //inputs ponderados
		      var ponderado1 = $("#ponderado_1").val();
			      var ponderado2 = $("#ponderado_2").val();
				      var ponderado3 = $("#ponderado_3").val();
        					  
                          var TP1 = $("#TP1").val();
						  var TP2 = $("#TP2").val();
						  var TP3 = $("#TP3").val();
						  
						  var com = document.getElementById("serv_admin");
                          var selected = com.options[com.selectedIndex].text;
                          console.log(selected);
						  
						  
						  
					  
	var campos = [];
	var parametros = [];
    var pregunta1;
	var valor1;
	var pregunta2;
	var valor2;
	var pregunta3;
	var valor3;
	var ruta;
	var questions1;
	var questions2;
	var questions3;
	
	var color1;
	var color2;
	var color3;
	
	var color1_1;
	var color2_2;
	var color3_3;
	
	
	var count1;
	var count2;
	var count3;

	count1=0;
	count2=0;
	count3=0;
	
	var total1;
	var total2;
	var total3;
	
	total1 = 0;
	total2 = 0;
	total3 = 0;
	
	var acum;
	var quest;
	var rest;
	
	acum = 0;
	quest = 0;
	rest = 0;
	
	var t;
	var tot;
	
	questions1 = inputs1;
	questions2 = inputs2;
	questions3 = inputs3;
	
	t = parseInt(questions1)+ parseInt(inputs2)+parseInt(inputs3);
	
		
	  var combo = $("#serv_admin").val();


	  if(ponderado1 === "" || ponderado2 === "" || ponderado3 === "" ){
		  
		  Swal.fire("Favor de llenar ponderados");
		  
	  }else{
		  
		  
		  			
	
   for(i=0;i<inputs1;i++)
   {   
	   count1++;
       console.log(count1);
	   
	   
	   pregunta1 = $("#t1_col2_input"+count1).val();
	   valor1 = $("#t1_col3_input"+count1).val();
   

        if(pregunta1 === "")
		{
		 	

		 color1 = document.getElementById("t1_col2_input"+count1);
		 color1.setAttribute("color","rojo");
		 
		 
		 if(valor1 === "")
		 {
		 
		 color1_1 = document.getElementById("t1_col3_input"+count1);
		 color1_1.setAttribute("color","rojo");
		 
		
		 }
		 
	 	
		}else{
        
             parametros.push({"combobit":combo,"st1_colum2":pregunta1,"st1_colum3":valor1});
			 
			 //ruta = 'assets/php/enviar_parametros.php';
			 
			 total1++;
			 
		}
			 
   }
     
      for(i=0;i<inputs2;i++)
   {   
	   count2++;
       console.log(count2);

	  pregunta2 = $("#t2_col2_input"+count2).val();
	    valor2 = $("#t2_col3_input"+count2).val();
		
		
        if(pregunta2 === "" || valor1 === "")
		{
		 	
	     //ruta = "vacia";
		 //Swal.fire("Favor de llenar campos");
		 
		 //pregunta2 = document.getElementById("t2_col2_input"+count2).focus();
		 //break;
		 
		 if(pregunta2==="")
		 {
			 
		 
		 color2 = document.getElementById("t2_col2_input"+count2);
		 color2.setAttribute("color","rojo"); 
		 
		 
		 }
		 else if(valor2 === "")
		 {
		 
		 
		 color2_2 = document.getElementById("t2_col3_input"+count2);
		 color2_2.setAttribute("color","rojo");
		
		 }
		 
		 
			
		}else{
		
			parametros.push({"combobit":combo,"st2_colum2":pregunta2,"st2_colum3":valor2});
			
			//ruta = 'assets/php/enviar_parametros.php';
			total2++;
			
		}
	   
   }
   
   
   
      for(i=0;i<inputs3;i++)
   {   
	   count3++;
       console.log(count3);

		pregunta3 = $("#t3_col2_input"+count3).val();
		valor3 = $("#t3_col3_input"+count3).val();
		
				
        if(pregunta3 === "" || valor2 === "")
		{
		 	
	     //ruta = "vacia";
		 //Swal.fire("Favor de llenar campos");

		 //pregunta3 = document.getElementById("t3_col2_input"+count3).focus();
         //break;
		 
		 if(pregunta3 ==="")
		 {
		 
		 color3 = document.getElementById("t3_col2_input"+count3);
		 color3.setAttribute("color","rojo");
		 
		 
		 }
		 else if(valor3 === "")
		 {
		 
		 
		 
		 color3_3 = document.getElementById("t3_col3_input"+count3);
		 color3_3.setAttribute("color","rojo");
		
		 }
		 
			
		}else{
			
	
			 parametros.push({"combobit":combo,"st3_colum2":pregunta3,"st3_colum3":valor3});
			 
			 //ruta = 'assets/php/enviar_parametros.php';
			 total3++;
			 
		}
			  
   }
    
	tot = parseInt(total1)+parseInt(total2)+parseInt(total3);
	console.log(t);
	console.log(tot);
	
   
   campos.push({"combobit":combo,"ponderado_1":ponderado1,"Porcentaje1":TP1});
      campos.push({"combobit":combo,"ponderado_2":ponderado2,"Porcentaje2":TP2});
	     campos.push({"combobit":combo,"ponderado_3":ponderado3,"Porcentaje3":TP3});
	 
	 
        if(t == tot)
		  {
			  
			console.log("preguntas igual a total");  
	 
	     ruta = 'assets/php/enviar_parametros.php';
		 
		 	 $.ajax({
	
     cache:false,
	 async:false,
     url:ruta,
     type:'POST',
	 data:{'array':JSON.stringify(parametros),'ponderados':JSON.stringify(campos),"opc":selected},
     success:function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
	   

       Swal.fire("guardado exitoso");
	
		   
	//$("#resultado").html(data);				
                },
				error:function(xhr,status,error) {
        
        Swal.fire("faltan por llenar"+"  "+rest);
	
      }
								
});	
		 
	}else{

		   acum = parseInt(total1)+parseInt(total2)+parseInt(total3);
		   quest = parseInt(questions1)+parseInt(questions2)+parseInt(questions3);
		   rest = parseInt(quest)-parseInt(acum);
		  
		  console.log(acum);
		  console.log(quest);
		  console.log(rest);
		  

		  
			$( "input" ).each(function() {				

			   if($('input[color="rojo"]'))
			   {
				   $('input[color="rojo"]').css({"border":"1px solid red"});
				   
			   }
			
			});
	
		  
          if(rest == 1)
		  {
          		  
           Swal.fire("faltan por llenar "+"  "+rest+"  "+"pregunta color en rojo");
		    
		  }else{
			  
			  Swal.fire("faltan por llenar "+"  "+rest+"  "+"preguntas color en rojo");
			  
			  
		  }
		   

		  }		  


	  }
	 	 
	 }); 

 function ver_estatus_plantillas(){
	
  var opcion="opc=consulta_plantillas";	
  var ruta="assets/php/consulta_estatus_plantillas.php";
	
	
		 $.ajax({
     cache: false,
     async: false,
     url:ruta,
     type:'POST',
	 dataType: 'JSON',
	 data:opcion,
     success:function (response) {
            console.log(response);
			if(response.estado==1)
			{
				
			   $('#content_plantilla_status').html(response.table);
        	   $('#content_plantilla_status').show();
				
			}else if(response.estado==-200)
			{
		
				Swal.fire("No se encontraron plantillas nuevas para revisar");
				
				
			}
		
                },
				error:function(xhr,status,error) {
        
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
								
});	

	
}

function acepta_platilla(val){

   console.log(val);
  var parametros = "opc=actualiza_estatus"+"&id="+val;
  var ruta  = 'assets/php/consulta_estatus_plantillas.php';

 console.log(parametros);
	 $.ajax({
     cache: false,
     async: false,
     url:ruta,
     type:'POST',
	 dataType: 'JSON',
	 data:parametros,
     success:function (response) {
            console.log(response);
			if(response.estado==1)
			{
				
			  console.log("actualizo correctamente el estatus de la plantilla");
			  
			  
		      location.reload();
			
				
			}else{
				
				console.log("error intente de nuevo");
				
			}
			
		
                },
				error:function(xhr,status,error) {
        
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
								
});	
	
	
	
}


function rechaza_plantilla(val){
	
	console.log(val);
	
	var parametros= "opc=rechaza_plantilla"+"&id="+val;
	var ruta = "assets/php/consulta_estatus_plantillas.php";
	
	console.log(parametros);
	
		 $.ajax({
     cache: false,
     async: false,
     url:ruta,
     type:'POST',
	 dataType: 'JSON',
	 data:parametros,
     success:function (response) {
            console.log(response);
			if(response.query)
			{
				
			  console.log("se rechazo plantilla correctamente");
			  
			  
		      location.reload();
			
				
			}else{
				
				console.log("error intente de nuevo");
				
			}
			
		
                },
				error:function(xhr,status,error) {
        
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
								
});
	
	
}

function ver_preguntas(val){
	
	console.log(val);
	
	var parametros="opc=ver_preguntas"+"&id="+val;
	var ruta="assets/php/consulta_estatus_plantillas.php";
	
	
			 $.ajax({
     cache: false,
     async: false,
     url:ruta,
     type:'POST',
	 dataType: 'JSON',
	 data:parametros,
     success:function (response) {
    
			   $('#content_questions').html(response.table);
        	   $('#content_questions').show();
						
		
                },
				error:function(xhr,status,error) {
        
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
								
});
	
	

}


function actualiza_ponderados(){
	
	var filas_a = document.getElementsByClassName("edicion_platilla_filas_a").length;
	var filas_b = document.getElementsByClassName("edicion_platilla_filas_b").length;
	var filas_c = document.getElementsByClassName("edicion_platilla_filas_c").length;
	var ponderado_1 = document.getElementById("TP1").value;
	var ponderado_2 = document.getElementById("TP2").value;
	var ponderado_3 = document.getElementById("TP3").value;
	var fila;
	
	var divi = ponderado_1 / filas_a;
	var divi2 = ponderado_2 / filas_b;
	var divi3 = ponderado_3 / filas_c;
	

	var i;
	
	 for(i=1;i<=filas_a;i++)
	 {
		
		//var input = document.getElementById("t1_col3_input"+i);
		   $('#t1_col3_input'+i).val(parseFloat(divi).toFixed(2));
		   
		   
       	
	 }
	 var o;
	 
	 for(o=1;o<=filas_b;o++)
	 {
		//var input = document.getElementById("t2_col3_input"+o);
			$('#t2_col3_input'+o).val(parseFloat(divi2).toFixed(2));
		 
	 }
	 
	 var e;
	 
	 for(e=1;e<=filas_c;e++)
	 {
		//var input = document.getElementById("t1_col3_input"+e);
		    $('#t3_col3_input'+e).val(parseFloat(divi3).toFixed(2));
		 
	 }
	 
	
	
	
	
}

function Muestra_plantilla(){
	


var select = document.getElementById("serv_admin").value;

console.log(select);

var parametros = "opc=edita_plantilla"+"&select="+select;

var ruta="assets/php/consulta_estatus_plantillas.php";

var bandera;

 if(select != 0)
 {
	 
	bandera = select;
    console.log(bandera);	
 
 $('#form_preguntas').show();

		 $.ajax({
     cache: false,
     async: false,
     url:ruta,
     type:'POST',
	 dataType: 'JSON',
	 data:parametros,
     success:function (response) {
            console.log(response);
			
			
			if(response.estado==1)
			{
				
				
				alert("plantilla obtenida correctamente");
				
				$('#form_preguntas').remove();
				
				var div = document.createElement("div");
				div.setAttribute("id","form_preguntas2");
				var panel = document.getElementById("panel_principal");
				panel.appendChild(div);
				
				
				$('#form_preguntas2').html(response.table);
				$('#form_preguntas2').show();
				
		
			    
				
			}else if(response.estado==-200)
			{
				
				alert("no se encontraron resultados");
				
				$('#form_preguntas2').remove();
			
			    var div2 = document.createElement("div");
				div2.setAttribute("id","form_preguntas");
				var panel = document.getElementById("panel_principal");
				panel.appendChild(div2);
				
							
				plantilla_dinamica();
				
				
			}
			
                },
				error:function(xhr,status,error) {
        
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
								
   });

 }else{
	 
	console.log("nada"); 
	 
	 
 }


	
}

function puntos_que_aplican(count,puntos){
	
	console.log(count);
	var Puntos1;
	var Puntos2;
	var Puntos3;
	
	if(puntos==="PA1")
	{
      console.log("puntos que aplican 1");	
	   Puntos1 = document.getElementById("PA1").innerHTML=count;
	  console.log(Puntos1);
	  
	
	}else if(puntos==="PA2")
	{
		
	   console.log("puntos que aplican 2");
        Puntos2 = document.getElementById("PA2").innerHTML=count;	  
	  console.log(Puntos2);	   
	
    }else if(puntos==="PA3")
    {

      console.log("puntos que aplican 3");	
	    Puntos3 = document.getElementById("PA3").innerHTML=count;
	   	  console.log(Puntos3);

	}
	
	
	
}



function plantilla_dinamica(){
	var html='';
	html=`
	    <div  style="width:80%;margin-left:auto;margin-right:auto;">
<!---- table ------>

<table border=2 style="width:100%;" id="tabla1">
<tr bgcolor="#AAB7B8">
<th style="width:60%;font-weight:bold;color:black;" colspan="2" id="subtitulo" >EJECUCION DE LA LLAMADA</th>
<th style="width:20%;font-weight:bold;color:black;">% por pregunta</th>
<th style="width:20%;font-weight:bold;color:black;">PONDERADOS</th>
</tr>
<tr bgcolor="#85C1E9">
<th   colspan="2" scope="col"  >
<input class="form-control" type="text" name="ponderado_1" style="background-color:#85C1E9" id="ponderado_1"    disabled />
</th>
<th></th>
<th style="font-weight:bold;color:black;">
<input type="text" style="background-color:#85C1E9" id="TP1" onkeyup="actualiza_ponderados()"  disabled />
</th>
</tr>

</table>



<table border=2 style="width:100%;" id="tabla1_1">

<tr  id="tr1"  class="edicion_platilla_filas_a">
<td  style="width:10%;text-align:center;"> 
1 
<button  type="button" onclick="elimina(1)" class="btnborrar" title="ELIMINAR CELDA"></button>
</td>
<td ='true'  style="width:50%;">

<input id="t1_col2_input1" class="input-text-t1" type="text" name="st1_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
    <span class="highlight"></span>
       <span class="bar"></span>
	   
</td>
<td style="width:20%" > 
<input id="t1_col3_input1"  type="text" name="st1_colum3[]" style="width:100%" autocomplete="off" disabled />
   <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td style="width:20%" ='true'></td>
</tr>

<tr  id="tr2" class="edicion_platilla_filas_a">
<td style="text-align:center;" > 
2
<button type="button" onclick="elimina(2)" class="btnborrar" title="ELIMINAR CELDA"></button>
 </td>
<td ='true'  style="width:50%;">
<input  id="t1_col2_input2"  class="input-text-t1" type="text" name="st1_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>
	   
</td>
<td ='true'>
<input  id="t1_col3_input2"  type="text" name="st1_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tr3" class="edicion_platilla_filas_a">
<td style="text-align:center;">
3
<button type="button" onclick="elimina(3)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input  id="t1_col2_input3" class="input-text-t1" type="text" name="st1_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input  id="t1_col3_input3"  type="text" name="st1_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tr4" class="edicion_platilla_filas_a">
<td style="text-align:center;">
4
<button type="button" onclick="elimina(4)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input  id="t1_col2_input4"  class="input-text-t1" type="text" name="st1_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input id="t1_col3_input4"  type="text" name="st1_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tr5" class="edicion_platilla_filas_a">
<td style="text-align:center;">
5
<button type="button" onclick="elimina(5)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input id="t1_col2_input5" class="input-text-t1" type="text" name="st1_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input id="t1_col3_input5"  type="text" name="st1_colum3[]" style="width:100%"  autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

</table>

<table border=2 style="width:100%;" id="tabla1_2">

<tr>
<td style="width:80%" colspan="3">
<button  id="btnadd" type="button"  class="add" title="AGREGAR NUEVA CELDA"></button>
Puntos que aplican
</td>
<td  id="PA1" style="width:20%" ="true">5</td>
</tr>

<tr>
<td colspan="3" style="text-align:left;font-weight:bold;color:black;" bgcolor="#85C1E9">Calificacion tecnica</td>
<td></td>
</tr>
</table>



<table border=2 style="width:100%;" id="tabla2">
<tr bgcolor="#3498DB">
<th style="width:60%;" colspan="2">
<input class="form-control validate[required]" type="text" name="ponderado_2"  style="background-color:#3498DB" id="ponderado_2" disabled />
</th>
<th style="width:20%;font-weight:bold;color:black;">% por pregunta</th>
<th style="width:20%;font-weight:bold;color:black;">
<input id="TP2" style="background-color:#3498DB" onkeyup="actualiza_ponderados()" disabled />
</th>
</tr>


</table>



<table border=2 style="width:100%;" id="tabla2_1">

<tr  id="tbl2_tr1" class="edicion_platilla_filas_b">
<td  style="width:10%;text-align:center;"> 
1 
<button type="button" onclick="elimina2(1)" class="btnborrar" title="ELIMINAR CELDA" ></button>
</td>
<td   style="width:50%;">
<input id="t2_col2_input1" class="input-text-t2" type="text" name="st2_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td style="width:20%"> 
<input id="t2_col3_input1"  type="text" name="st2_colum3[]" style="width:100%"  autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td style="width:20%" ='true'></td>
</tr>

<tr  id="tbl2_tr2" class="edicion_platilla_filas_b">
<td style="text-align:center;" > 
2
<button type="button" onclick="elimina2(2)" class="btnborrar" title="ELIMINAR CELDA"></button>
 </td>
<td ='true'  style="width:50%;">
<input  id="t2_col2_input2" class="input-text-t2" type="text" name="st2_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input  id="t2_col3_input2"  type="text" name="st2_colum3[]" style="width:100%"  autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tbl2_tr3" class="edicion_platilla_filas_b">
<td style="text-align:center;">
3
<button type="button" onclick="elimina2(3)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input id="t2_col2_input3" class="input-text-t2" type="text" name="st2_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input id="t2_col3_input3"  type="text" name="st2_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tbl2_tr4" class="edicion_platilla_filas_b">
<td style="text-align:center;">
4
<button type="button" onclick="elimina2(4)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input  id="t2_col2_input4" class="input-text-t2" type="text" name="st2_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input  id="t2_col3_input4"  type="text" name="st2_colum3[]" style="width:100%" autocomplete="off" disabled /> 
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tbl2_tr5" class="edicion_platilla_filas_b">
<td style="text-align:center;">
5
<button type="button" onclick="elimina2(5)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input  id="t2_col2_input5" class="input-text-t2" type="text" name="st2_colum2[]" style="width:100%" autocomplete="off"  placeholder="Descripcion 50 caracteres" disabled /> 
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input  id="t2_col3_input5"  type="text" name="st2_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

</table>

<table border=2 style="width:100%;" id="tabla2_3">

<tr>
<td style="width_80%" colspan="3" style="text-align:left;" >
<button  id="btnadd2" type="button" class="add" title="AGREGAR NUEVA CELDA"></button>
Puntos que aplican</td>
<td  id="PA2" style="width:20%" >5</td>
</tr>

<tr>
<td colspan="3" style="text-align:left;font-weight:bold;color:black;" bgcolor="#3498DB">Calificacion negociacion</td>
<td ="true"></td>
</tr>
</table>


<br></br>

<table border=2 style="width:100%;" id="tabla3">
<tr bgcolor="#2874A6">
<th style="width:60%;" colspan="2">
<input class="form-control validate[required]" type="text" name="ponderado_3" style="background-color:#2874A6" id="ponderado_3" disabled />
</th>
<th style="width:20%;font-weight:bold;color:black;">% por pregunta</th>
<th style="width:20%;font-weight:bold;color:black;">
<input id="TP3" style="background-color:#2874A6" onkeyup="actualiza_ponderados()" disabled />
</th>
</tr>

</tr>

</table>


<table border=2 style="width:100%;" id="tabla3_1">

<tr  id="tbl3_tr1" class="edicion_platilla_filas_c">
<td  style="width:10%;text-align:center;"> 
1 
<button type="button" onclick="elimina3(1)" class="btnborrar" title="ELIMINAR CELDA"></button>
</td>
<td ='true'  style="width:50%;">
<input id="t3_col2_input1" class="input-text-t3" type="text" name="st3_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td style="width:20%" ='true'> 
<input id="t3_col3_input1"  type="text" name="st3_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td style="width:20%" ='true'></td>
</tr>

<tr  id="tbl3_tr2" class="edicion_platilla_filas_c">
<td style="text-align:center;" > 
2
<button type="button" onclick="elimina3(2)" class="btnborrar" title="ELIMINAR CELDA"></button>
 </td>
<td ='true'  style="width:50%;">
<input  id="t3_col2_input2" class="input-text-t3" type="text" name="st3_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input  id="t3_col3_input2"  type="text" name="st3_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tbl3_tr3" class="edicion_platilla_filas_c">
<td style="text-align:center;">
3
<button type="button" onclick="elimina3(3)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input id="t3_col2_input3" class="input-text-t3" type="text" name="st3_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input id="t3_col3_input3"  type="text" name="st3_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tbl3_tr4" class="edicion_platilla_filas_c">
<td style="text-align:center;">
4
<button type="button" onclick="elimina3(4)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input id="t3_col2_input4" class="input-text-t3" type="text" name="st3_colum2[]" style="width:100%" autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />
 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input id="t3_col3_input4"  type="text" name="st3_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

<tr  id="tbl3_tr5" class="edicion_platilla_filas_c">
<td style="text-align:center;">
5
<button type="button" onclick="elimina3(5)" class="btnborrar" title="ELIMINAR CELDA"></button></td>
<td ='true'  style="width:50%;">
<input id="t3_col2_input5" class="input-text-t3" type="text" name="st3_colum2[]" style="width:100%"  autocomplete="off" placeholder="Descripcion 50 caracteres" disabled />

 <span class="highlight"></span>
       <span class="bar"></span>

</td>
<td ='true'>
<input id="t3_col3_input5"  type="text" name="st3_colum3[]" style="width:100%" autocomplete="off" disabled />
 <span class="highlight"></span>
       <span class="bar2"></span>

</td>
<td ='true'></td>
</tr>

</table>

<table border=2 style="width:100%;" id="tabla2_3">

<tr>
<td style="width_80%" colspan="3" style="text-align:left;" >
<button  id="btnadd3" type="button" class="add" title="AGREGAR NUEVA CELDA"></button>
Puntos que aplican</td>
<td id="PA3" style="width:20%" ="true">5</td>
</tr>

<tr>
<td colspan="3" style="text-align:left;font-weight:bold;color:black;" style="width:80%" bgcolor="#2874A6">Calificacion de dialogo calido</td>
<td ="true" style="width:20%"></td>
</tr>

<tr>
<td colspan="3" style="text-align:left;" style="width:80%">Fecha de llamada</td>
<td ="true" style="width:20%"> <input type="text" style="width:100%" autocomplete="off" placeholder="(15 caracteres)"/></td>
</tr>

<tr>
<td colspan="3" style="text-align:left;" style="width:80%">Hora de llamada</td>
<td ="true" style="width:20%"> <input type="text" style="width:100%" autocomplete="off" placeholder="(15 caracteres)" /> </td>
</tr>

<table border=2 style="width:100%;" id="tabla4">

<br></br>

<tr>
<th style="width:80%;font-weight:bold;color:black;" colspan="2" bgcolor="#AAB7B8">CALIFICACION GENERAL</th>
<th  style="width:20%;" ="true" bgcolor="#2874A6"></th>
</tr>



<table border=2 style="width:100%;" id="tabla4">

<br></br>

<tr>
<td style="width:10%;" bgcolor="#AAB7B8">
<button type="button" ></button>
</td>
<td  style="width:70%;" ="true" bgcolor="#AAB7B8"><input input="text" style="width:100%" autocomplete="off" placeholder="(50 caracteres)"/></td>
<td  style="width:20%;" ="true" bgcolor="#AAB7B8"><select style="width:100%;height:100%" ><option value="SI">SI</option><option value="NO">NO</option></select></td>
</tr>
<tr>
<td style="width:10%;" bgcolor="#AAB7B8">
<button type="button" ></button>
</td>
<td  style="width:70%;" ="true" bgcolor="#AAB7B8"><input input="text" style="width:100%" autocomplete="off" placeholder="(50 caracteres)"/></td>
<td  style="width:20%;" ="true" bgcolor="#AAB7B8"><select style="width:100%;height:100%" ><option value="SI">SI</option><option value="NO">NO</option></select></td>
</tr>
<tr>
<td style="width:10%;" bgcolor="#AAB7B8">
<button type="button" ></button>
</td>
<td  style="width:70%;" ="true" bgcolor="#AAB7B8"><input input="text" style="width:100%" autocomplete="off" placeholder="(50 caracteres)"/></td>
<td  style="width:20%;" ="true" bgcolor="#AAB7B8" bgcolor="#AAB7B8"><select style="width:100%;height:100%" ><option value="SI">SI</option><option value="NO">NO</option></select></td>
</tr>
</table>

</table>


<!-- </form> -->

</div>`;   

    $('#form_preguntas').html(html);
	
	
}

