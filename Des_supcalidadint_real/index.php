<?php
  header('Content-Type: text/html; charset=UTF-8');
  session_start();
  if (!isset($_SESSION['log']) == 1) {
    header('Location: login.php');	
    die();
  }
?>
<!-- Hecho por Adrian Lopez  -->
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Sistema De Supervisión Integral</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=8;IE=9;IE=10;IE=Edge;"  >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <input  type="hidden" id="puesto" value="<?php echo $_SESSION['puesto'];?>"  >
  <input  type="hidden" id="nc" value="<?php echo $_SESSION['nom_emp'];?>"  >
  
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/key_coppel.ico">
  <link rel="stylesheet" media="screen" href="assets/css/alertify.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/estilo_login.css">
  <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/semantic.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/css/imagenes/key_coppel.ico">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/estilo_login.css">
  <link rel="stylesheet" type="text/css" href="assets/css/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/default.min.css">
  <link href="assets/css/jquery.ui.all.css" rel="stylesheet"  type="text/css">
  <link href="assets/css/alertify.min.css" rel="stylesheet" media="screen">

  <style>
  .btnborrar {
 background: steelblue;
 background-image: url("assets/css/imagenes/close.png");
 background-size: cover;
 background-position: center;
 display: inline-block;
 border: none;
 padding: 8px;
 width: 25px;
 border-radius: 450px;
 height: 25px;
 transition: all 0.5s;
 cursor: pointer;
}




.add{
	 background: steelblue;
 background-image: url("assets/css/imagenes/Add.png");
 background-size: cover;
 background-position: center;
 display: inline-block;
 border: none;
 padding: 8px;
 width: 25px;
 border-radius: 450px;
 height: 25px;
 transition: all 0.5s;
 cursor: pointer;
	
	
}



 input{
      @extend .transition;
      appearance: none;
      background-color: none;
      line-height: 0;
      font-size: 17px;
      width: 100%;
      display: block;
      box-sizing: border-box;
      padding: 10px 15px;
      color: $red;
      font-weight: 100;
      letter-spacing: 0.01em;
      position: none;
      z-index: 1;
 }
      
  input:focus{
    
  
	border-color:red;
    color:black;
	font-weight:bold;
  }  
 
audio{
	
	filter: sepia(20%) saturate(70%) grayscale(1) contrast(99%) invert(12%);
	height:30px;
	width:300px;

}

  </style>

  <script type="text/javascript" src="assets/js/js-verificarusuario.js"></script>
  <script type="text/javascript" src="assets/js/moment.js"></script>
  <script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="assets/js/bootbox.min.js"></script>
  <script type="text/javascript" src="assets/js/alertify.min.js" ></script>
  <script type="text/javascript" src="assets/js/sweetalert2.all.js" ></script>
  <script type="text/javascript" src="assets/js/calcular_fecha.js" ></script>
  

  

</head>
<body>
  <header class="titulo">
    <div>
        <div class="col-md-10">
          <img id="imgcoppel" src="assets/img/COPPEL.jpg">
          <label class="label">Sistema De Supervisión Integral</label>
		  

        </div>
		
        <div class="col-md-2">
		<label id="tu_nombre_es" style="color:white;"></label>
          <p>
		  
            <button id ="btnSession" class="btn btn-primary btn-xs text-center" onclick="destruyesession()">
              <span class="glyphicon glyphicon-log-out" ></span>
              Cerrar Sesión
            </button>            
          </p>
        </div>
    </div>
       
       
   </header>

  <div id="principal_frm">
      <div class="bb-alert" style="display:none;">
          <span></span>
      </div>

      <center>
        <div  id="panel_principal" class="panel panel-primary" style="margin-top: 50px; width: 97.5%; margin-bottom: 5%" >
          <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 15px; text-align: center;">Sistema De Supervisión Integral</h3>
          </div>
          <div class="panel">
		  
		  
		          <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                  <li id="btn_administrador"  onclick="general(1)"><a href="#">Administrador del sistema integral de calidad</a></li>
                  <li id="btn_supervicion" onclick="general(2)"><a href="#">Supervisión de calidad</a></li>
                  <li id="btn_consulta" onclick="general(3)"><a href="#">Consulta de calificaciones</a></li>
                  <li id="btn_certificacion" onclick="general(4)"><a href="#">Administrador de certificación de llamadas</a></li> 
                </ul> 
              </div>

          <div>
            <div class="row">
              <div id="groupbtns_supervicion" style="display:none;">
                <div class="col-md-8"></div>
                <div class="col-md-2" align="right">
                  <button class="btn btn-primary btn-md text-center" id="btn_buscar">
                    <span class="glyphicon glyphicon-search" ></span> Buscar
                  </button>
                </div>
                <div class="col-md-2" align="left">
                  <button class="btn btn-primary btn-md text-center" id="btn_limpiar">
                    <span class="glyphicon glyphicon-erase" ></span> Limpiar
                  </button>
                </div>
              </div>
			  
			  <div id="groupbtns_consultar" style="display:none;">
                <div class="col-md-8"></div>
                <div class="col-md-2" align="right">
                  <button class="btn btn-primary btn-md text-center" id="btn_buscar2">
                    <span class="glyphicon glyphicon-search" ></span> Buscar
                  </button>
                </div>
                <div class="col-md-2" align="left">
                  <button class="btn btn-primary btn-md text-center" id="btn_limpiar2">
                    <span class="glyphicon glyphicon-erase" ></span> Limpiar
                  </button>
                </div>
              </div>
			  
			
              <div id="groupbtns_administrador" style="display:none;">
                <div class="col-md-8"></div>
				<div>
                <div class="col-md-2" align="right">
                  <button class="btn btn-primary btn-md text-center" id="btn_editar" onclick="editar_plantilla()" disabled="true" >
                    <span class="glyphicon glyphicon-pencil" ></span> Editar
                  </button>
				</div>
                <div class="col-md-2" align="left">
                  <button class="btn btn-primary btn-md text-center"  id="inser_preg" disabled="true" >
                    <span class=" glyphicon glyphicon-floppy-saved" ></span> Guardar
                  </button>
                </div>
				    <div class="col-md-2" align="left">
                  <button class="btn btn-primary btn-md text-center"  id="estatus_platilla" data-toggle="modal" data-target="#ModalPlantillasEnEspera"  onclick="ver_estatus_plantillas()">
                    <span class="glyphicon glyphicon-search" ></span> Consultar Plantillas
                  </button>
                </div>
				</div>
	
			<div id="groupbtns_admin">
                <div class="col-md-8" align="left" style="margin-top:2%">
                  <div class="input-group input-group-sm" >
                    <span class="input-group-addon"><strong>Edicion de plantilla:</strong></span>
                    <select style="width:150px;" class="form-control"  autofocus="" id="serv_admin"  name="combobit" id="combobit" onclick="Muestra_plantilla()">
                    </select>					
                  </div>  
                </div>
              </div>
			</div>	

     <div id="form_preguntas" style="display:none">

		

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
<td  style="width:20%" ="true">5</td>
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
<td  style="width:20%" >5</td>
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
<td  style="width:20%" ="true">5</td>
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

</div>

<!--- termina formulario tabla ---->

				
              </div>
			  
		  
                      
              <div id="btns_certificacion"><?php  include('loads/CertificacionDeLlamadas.php'); ?></div>
            </div><br>

            <div>

 
              <div id="groupbtns_super">
                <div class="col-md-10">
                  <div class="input-group fade in active input-group-sm" style="margin-left:20%;margin-top:-5%">
                    <span class="input-group-addon"><strong># Centro:</strong></span>
                    <input style="width:100px;" type="text" class="form-control" maxlength="6" autofocus="" id="txt_centro" disabled>
                    <span class="input-group-addon"><strong># Empleado:</strong></span>
                    <input style="width:100px;" type="text" class="form-control" maxlength="8" autofocus="" id="txt_numEmpleado"  onkeyup="return validacionDatos(event)" >
                    <span class="input-group-addon"><strong>Nombre Empleado:</strong></span>
                    <input style="width:220px;" type="text" class="form-control"  autofocus="" id="txt_nombre" readonly="readonly">
                    <span class="input-group-addon"><strong>Fecha:</strong></span>
                    <input style="width:160px;" onpaste="return false" type="date" class="form-control" step="1" min="2018-12-01" max="9999-01-01" id="date_fecha">
                  </div>
                  <div class="input-group fade in active input-group-sm" style="margin-left:20%;margin-top:1%">
                    <span class="input-group-addon"><strong>Nombre Del Jefe:</strong></span>
                    <input style="width:220px;" type="text" class="form-control"  maxlength="6" autofocus="" id="txt_jefe" readonly="readonly">
                    <span class="input-group-addon"><strong>Servicio:</strong></span>
                    <select style="width:175px;" class="form-control"  autofocus="" id="selectServicio">
                    </select>
                    <span class="input-group-addon"><strong>Fin De Gestión:</strong></span>
                    <select style="width:175px;" class="form-control"  autofocus="" id="finGestion">
                    </select>
                  </div>       
                </div>
              </div>
			  
              <div id="groupbtns_certificacion">
                
                  <div id="btns_certificacionAlta"></div>
                
              </div>

              <div id="groupbtns_consul" style="display:none;">
                <div class="col-md-10">
                  <div class="input-group fade in active input-group-sm" style="margin-left:20%;margin-top:-5%">
                    <span class="input-group-addon"><strong># Centro:</strong></span>
                    <input style="width:150px;" class="form-control"  autofocus="" id="txt_centro2" onkeyup="validacionDatos2()">
                    </select>
                    <span class="input-group-addon"><strong>Gerente:</strong></span>
                    <input style="width:200px;" type="text" class="form-control" maxlength="6" autofocus="" id="txt_gerente2" onkeyup="" readonly="readonly">
                    <span class="input-group-addon"><strong># Empleado:</strong></span>
                    <input style="width:100px;" type="text" class="form-control" maxlength="8" autofocus="" id="txt_numEmpleado2"  onkeyup="validacionDatos2()" >
                    <span class="input-group-addon"><strong>Nombre ejecutivo:</strong></span>
                    <input style="width:150px;" class="form-control"  autofocus="" id="txt_nombre2" readonly="readonly">
                    
                  </div>
                  <div class="input-group fade in active input-group-sm" style="margin-left:20%;margin-top:1%">
                    <span class="input-group-addon"><strong>Nombre Del Jefe:</strong></span>
                    <input style="width:200px;" class="form-control"  autofocus="" id="txt_jefe2" readonly="readonly">
                   
                    <span class="input-group-addon"><strong>De:</strong></span>
                    <input style="width:160px;" onpaste="return false" type="date" class="form-control" step="1" min="2018-12-01" max="9999-01-01" id="defecha">
                    <span class="input-group-addon"><strong>A:</strong></span>
                    <input style="width:160px;" onpaste="return false" type="date" class="form-control" step="1" min="2018-12-01" max="9999-01-01" id="afecha">
                    <span class="input-group-addon"><strong>Tipo de grafica:</strong></span>
                    <select style="width:150px;" class="form-control"  autofocus="" id="Concentrado" onclick="tipo_grafica()">
					    <option value="ConcentradoDiario"><strong>Concentrado Diario</strong></option>
                       <option value="SemaforoSemanal"><strong>Semaforo Semanal</strong></option>
                      <option value="SemaforoMensual"><strong>Semaforo Mensual</strong></option>
                    </select>
                  </div>       
                </div>
              </div>              
            </div>
          </div>
          <div id = "tableGeneral" ></div>
		  <div id = "tableCertificacion"></div>
		  <div id = "tableCalificaciones" ></div>
          <div id="container"></div>
          </div>            
        </div>        
      </center>
	  

	  
	    <div id="ModalContainer"></div> 
	  
	  <!------------------ modal supervicion ---------------->
	  
	  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:100%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Monitoreo calido</h4>
			</div>
			<div class="modal-body" id="modal_preguntas">
			
		
<div id="resultado"></div>

<!-- fin modal supervicion -->
          
      </div>		   
   </div>			  
</div>
</div>

<!---------------------- modal replica ------------------------->


			  <div class="modal fade" id="ModalReplica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:90%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			
			</div>
			
			<div class="modal-body" id="modal_replica">

			<div id="result"></div>
			
       </div>		   
   </div>			  
</div>
</div>


<!------------------ modal observaciones ----------------------->

			  <div class="modal fade" id="ModalObservaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:80%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			
			</div>
			
			<div class="modal-body" id="modal_replica">

			<div id="result"></div>
			
       </div>		   
   </div>			  
</div>
</div>


<!---------------- modal alta usuarios ------------------------>

			  <div class="modal fade" id="ModalAlta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:hidden">
	<div class="modal-dialog" role="document" style="width:30%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			        <h2 class="modal-title">Alta Usuario</h2>	
		   
				   
			
			</div>
			
			<div class="modal-body" id="modal_replica">

	         <span class="input-group-addon" style="width:100px;">Num. Empleado:
				    <input style="width:100px;display:inline-block;" type="text" class="form-control"  maxlength="8" autofocus="" id="txt_alta_empleado" onkeyup='validaEmp()' />
                    </span>
       		        <br></br>
					<span class="input-group-addon" style="width:250px;">Nombre:
					<input style="width:250px;display:inline-block;" type="text" class="form-control"  autofocus="" id="txt_alta_nombre" />
                    </span>
				   	<br></br>		
					<span class="input-group-addon" style="width:100px;">Centro:
					<input style="width:100px;display:inline-block;" type="text" class="form-control" maxlength="6" autofocus="" id="txt_alta_centro" />
                    </span>
		            <br></br>
					<span class="input-group-addon" style="width:200px;">Puesto:
					<input style="width:200px;display:inline-block;" type="text" class="form-control" maxlength="6" autofocus="" id="txt_alta_puesto" />
                    </span>
					<br></br>		
				    <span class="input-group-addon" style="width:100px;">Roll:
					<select id="select_alta_roll" disabled="true"> 
					<option value="#"></option> 
					<option value="Jefe Cat">Jefe Cat</option>
                    <option value="Operativo">Operativo</option>
                    <option value="Administrador">Administrador</option>
					</select>
                    </span>
			  		<br></br>   
					<span class="input-group-addon" style="width:250px">Correo:
					<input style="width:250px;display:inline-block;" type="email" class="form-control" maxlength="64" autofocus="" id="txt_alta_correo"  disabled="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  placeholder="Ej.: usuario@servidor.com" required  onblur="validaEmail()" onkeypress="return CaracteresvalidosCorreo(event);"/>
                    </span>
				    <br></br>
					<span class="input-group-addon" style="width:150px;">Celular:
					<input style="width:100px;display:inline-block;" type="text" class="form-control" maxlength="10" autofocus="" id="txt_alta_celular"  disabled="true" onkeyup="validacofetel()"/>
                    </span>
				    <br></br>
					<button class="btn btn-primary btn-md text-center" id="realizar_alta" onclick="alta_usuario()" disabled>Ingresar Alta</button>
			
       </div>		   
   </div>			  
</div>
</div>

<!-------- modal alta servicio ------------->	

			  <div class="modal fade" id="ModalAltaServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:35%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Alta Servicio</h4>	
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					
                  
				
			
			</div>
			
			<div class="modal-body" id="modal_replica">
			
				 <span class="input-group-addon" style="width:100px;">Servicio
				 <select id="select_alta_serv">
                 <option value="VACIO">VACIO</option>
			     <option value="COBRANZA COPPEL">COBRANZA COPPEL</option>
		         <option value="COBRANZA BANCOPPEL">COBRANZA BANCOPPEL</option>
			     <option value="COBRANZA ARGENTINA">COBRANZA ARGENTINA</option>
			     <option value="PROMOCION COPPEL">PROMOCION COPPEL</option>
			     <option value="SOLICITANTES BANCO">SOLICITANTES BANCO</option>
			     <option value="SOLICITUD DE CREDITO">SOLICITUD DE CREDITO</option>
			     <option value="VENTAS">VENTAS</option>
			     <option value="ATENCION COPPEL">ATENCION COPPEL</option>
			     <option value="ATENCION ARGENTINA">ATENCION ARGENTINA</option>
			     <option value="ATENCION ZUUM">ATENCION ZUUM</option>
			     <option value="ATENCION AFORE">ATENCION AFORE</option>
			     <option value="ATENCION SOPORTE TECNICO">ATENCION SOPORTE TECNICO</option>
			     <option value="CAMPANAS UNICAS">CAMPANAS UNICAS</option>
			     <option value="PROMOCION BANCOPPEL">PROMOCION BANCOPPEL</option>
			     <option value="PROMOCION COPPEL ARGENTINA">PROMOCION COPPEL ARGENTINA</option>
				 <option value="ATENCION A CLIENTES BANCOPPEL">ATENCION A CLIENTES BANCOPPEL</option>
				</select>
				</span>
				<br></br>
				<span class="input-group-addon" style="width:100px;">Funcional
				 <select id="select_alta_funcional">
				 <option value=""></option>
				 
				</select>
				</span>
				<br></br>
				
				<span class="input-group-addon" style="width:100px;">Centralizador
				 <select id="select_alta_centralizador">
				 <option value=""></option>
				 
				</select>
				</span>
				<br></br>
				<button class="btn btn-primary btn-md text-center" onclick="guarda_alta_servicio()">Alta servicio</button>

			
       </div>		   
   </div>			  
</div>
</div>		


<!-------------modal alta check-------------->	

			  <div class="modal fade" id="ModalAltaCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:30%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title">Alta  check</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			
			</div>
			
			<div class="modal-body" id="modal_replica">
            
			 <span class="input-group-addon" style="width:50px;">Alta check
			 <select id="select_alta_check">
                <option value="VACIO">VACIO</option>
			     <option value="COBRANZA COPPEL">COBRANZA COPPEL</option>
		         <option value="COBRANZA BANCOPPEL">COBRANZA BANCOPPEL</option>
			     <option value="COBRANZA ARGENTINA">COBRANZA ARGENTINA</option>
			     <option value="PROMOCION COPPEL">PROMOCION COPPEL</option>
			     <option value="SOLICITANTES BANCO">SOLICITANTES BANCO</option>
			     <option value="SOLICITUD DE CREDITO">SOLICITUD DE CREDITO</option>
			     <option value="VENTAS">VENTAS</option>
			     <option value="ATENCION COPPEL">ATENCION COPPEL</option>
			     <option value="ATENCION ARGENTINA">ATENCION ARGENTINA</option>
			     <option value="ATENCION ZUUM">ATENCION ZUUM</option>
			     <option value="ATENCION AFORE">ATENCION AFORE</option>
			     <option value="ATENCION SOPORTE TECNICO">ATENCION SOPORTE TECNICO</option>
			     <option value="CAMPANAS UNICAS">CAMPANAS UNICAS</option>
			     <option value="PROMOCION BANCOPPEL">PROMOCION BANCOPPEL</option>
			     <option value="PROMOCION COPPEL ARGENTINA">PROMOCION COPPEL ARGENTINA</option>
				 <option value="ATENCION A CLIENTES BANCOPPEL">ATENCION A CLIENTES BANCOPPEL</option>
			 </select>
			 </span>
			  
             <br></br>
             <button  class="btn btn-primary btn-md text-center" data-toggle="modal" data-target="#ModalNuevoCheck" onclick="cerrar1()">alta check</button>			 
 			
       </div>		   
   </div>			  
</div>
</div>


<!--------------crear nuevo check------------>
			  <div class="modal fade" id="ModalNuevoCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:30%;height:25%;overflow: hidden;">
		<div class="modal-content">
		   
		    <br></br>
		    <h4 style="text-align:center" class="modal-title">Crear nuevo check</h4>
		    
			<div class="modal-body" id="modal_replica">
			<button class="btn btn-primary btn-md text-center"  onclick="cerrar2()" style="margin-left:40%" data-toggle="modal" data-target="#ModalEvaluaciones" >aceptar</button>
			
       </div>		   
   </div>	

   
</div>



</div>

<!--------------check evaluacion -------------->


			  <div class="modal fade" id="ModalEvaluaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:80%;height:100%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			   <h4 class="modal-title">Check de Evaluacion para Certificacion Llamadas CAT</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			
			</div>
			
		
<table border=2  id="evaluacion_tabla1" style="margin-left:10%;width:80%">
<tr bgcolor="#AAB7B8">
<th style="width:10%;font-weight:bold;color:black;"  id="habilitar1" >Habilitar</th>
<th style="width:90%;font-weight:bold;color:black;"  id="subtitulo1" >ASPECTOS TECNICOS</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check1_tbl1" onchange="check(1,1)"></td>
<th>
<input  type="text"  class="Tbl1_Eval1" class="form-control" style="width:100%;height:10px;" id="Tbl1_Pregunta1"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check2_tbl1" onchange="check(1,2)"></td>
<th>
<input  type="text"  class="Tbl1_Eval1" class="form-control" style="width:100%;height:10px;"  id="Tbl1_Pregunta2" disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check3_tbl1" onchange="check(1,3)"></td>
<th>
<input  type="text"  class="Tbl1_Eval1" class="form-control" style="width:100%;height:10px;" id="Tbl1_Pregunta3" disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check4_tbl1" onchange="check(1,4)"></td>
<th>
<input  type="text"  class="Tbl1_Eval1" class="form-control" style="width:100%;height:10px;" id="Tbl1_Pregunta4"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check5_tbl1" onchange="check(1,5)"></td>
<th>
<input  type="text"  class="Tbl1_Eval1" class="form-control" style="width:100%;height:10px;" id="Tbl1_Pregunta5"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check6_tbl1" onchange="check(1,6)"></td>
<th>
<input  type="text"  class="Tbl1_Eval1" class="form-control" style="width:100%;height:10px;" id="Tbl1_Pregunta6"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check7_tbl1" onchange="check(1,7)"></td>
<th>
<input  type="text"  class="Tbl1_Eval1" class="form-control" style="width:100%;height:10px;" id="Tbl1_Pregunta7"  disabled/>
</th>
</tr>
</table>

<br></br>


<table border=2  id="evaluacion_tabla2" style="margin-left:10%;width:80%">
<tr bgcolor="#AAB7B8">
<th style="width:10%;font-weight:bold;color:black;"  id="habilitar2" >Habilitar</th>
<th style="width:90%;font-weight:bold;color:black;"  id="subtitulo2" >ASPECTOS ESPECIALIZADOS DEL SERVICIO</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check1_tbl2" onchange="check(2,1)"></td>
<th>
<input  type="text"   class="Tbl2_Eval2" class="form-control" style="width:100%;height:10px;" id="Tbl2_Pregunta1"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check2_tbl2" onchange="check(2,2)"></td>
<th>
<input  type="text"   class="Tbl2_Eval2" class="form-control" style="width:100%;height:10px;" id="Tbl2_Pregunta2"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check3_tbl2" onchange="check(2,3)"></td>
<th>
<input  type="text"   class="Tbl2_Eval2" class="form-control" style="width:100%;height:10px;" id="Tbl2_Pregunta3"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check4_tbl2" onchange="check(2,4)"></td>
<th>
<input  type="text"   class="Tbl2_Eval2" class="form-control" style="width:100%;height:10px;"  id="Tbl2_Pregunta4"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check5_tbl2" onchange="check(2,5)"></td>
<th>
<input  type="text"   class="Tbl2_Eval2" class="form-control" style="width:100%;height:10px;" id="Tbl2_Pregunta5"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check6_tbl2" onchange="check(2,6)"></td>
<th>
<input  type="text"   class="Tbl2_Eval2" class="form-control" style="width:100%;height:10px;"  id="Tbl2_Pregunta6" disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check7_tbl2" onchange="check(2,7)"></td>
<th>
<input  type="text"   class="Tbl2_Eval2" class="form-control" style="width:100%;height:10px;" id="Tbl2_Pregunta7"  disabled/>
</th>
</tr>
</table>


<br></br>

<table border=2  id="evaluacion_tabla3" style="margin-left:10%;width:80%">
<tr bgcolor="#AAB7B8">
<th style="width:10%;font-weight:bold;color:black;"  id="habilitar3" >Habilitar</th>
<th style="width:90%;font-weight:bold;color:black;" colspan="2" id="subtitulo" >ASPECTOS ESPECIALIZADOS DEL SERVICIO</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check1_tbl3" onchange="check(3,1)"></td>
<th>
<input  type="text"   class="Tbl3_Eval3" class="form-control" style="width:100%;height:10px;" id="Tbl3_Pregunta1"   disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check2_tbl3" onchange="check(3,2)"></td>
<th>
<input  type="text"   class="Tbl3_Eval3" class="form-control" style="width:100%;height:10px;"  id="Tbl3_Pregunta2" disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check3_tbl3" onchange="check(3,3)"></td>
<th>
<input  type="text"   class="Tbl3_Eval3" class="form-control" style="width:100%;height:10px;" id="Tbl3_Pregunta3"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check4_tbl3" onchange="check(3,4)"></td>
<th>
<input  type="text"   class="Tbl3_Eval3" class="form-control" style="width:100%;height:10px;"  id="Tbl3_Pregunta4"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check5_tbl3" onchange="check(3,5)"></td>
<th>
<input  type="text"   class="Tbl3_Eval3" class="form-control" style="width:100%;height:10px;" id="Tbl3_Pregunta5"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check6_tbl3" onchange="check(3,6)"></td>
<th>
<input  type="text"   class="Tbl3_Eval3" class="form-control" style="width:100%;height:10px;" id="Tbl3_Pregunta6"  disabled/>
</th>
</tr>
<tr>
<td style="width:10%"><input type="checkbox" name="habilitar" id="check7_tbl3" onchange="check(3,7)"></td>
<th>
<input  type="text"   class="Tbl3_Eval3" class="form-control" style="width:100%;height:10px;"  id="Tbl3_Pregunta7"  disabled/>
</th>
</tr>
</table>
			

       	
			
<button  class="btn btn-primary btn-md text-center" style="margin-left:90%" onclick="Recojer_Preguntas_AltaCheck()" >Guardar</button> 


			
			
       </div>	

	   
   </div>			  
</div>
</div>
		
		
<!----------- modal baja usuario ------------------->

			  <div class="modal fade" id="ModalBajaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:30%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			   <h4 class="modal-title">Bajas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
	                <div style="margin-left:5%;">
	                <span class="input-group-addon" style="width:150px;">Num. Empleado:
				    <input style="width:150px;display:inline-block;" type="text" class="form-control"  maxlength="8" autofocus=""  id="baja_usuario"/>
                    </span>
       		        <br></br>
					<span>Motivo de Baja</span>
					<br></br>
					<textarea rows="10" cols="40" id="textarea_baja"></textarea>
					<br></br>
					<button class="btn btn-primary btn-md text-center" onclick="elimina_usuario()">ingresar</button>
                    </div> 
			
			<div class="modal-body" id="modal_replica">

			
       </div>		   
   </div>			  
</div>
</div>		

<!---------- modal baja servicio ------------------>

			  <div class="modal fade" id="ModalBajaServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:100%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
            <div class="modal-body" id="modal_baja_servicio"></div>

			
       </div>		   
   </div>			  
</div>
</div>


<!----------- motivo de baja del servicio ----------->

			  <div class="modal fade" id="ModalMotivoBajaServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:100%;overflow:hidden;">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Motivo de Baja del Servicio </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<br></br>
			<textarea style="width:95%;height:80%;margin-left:2%" rows="10" cols="50"></textarea>
            <br></br>
           <button class="btn btn-primary btn-xs" style="margin-left:80%" onclick="siguiente()">SIGUIENTE</button>
		   <br></br>
			
       </div>		   
   </div>			  
</div>
</div>


<!---------------------Baja check ------------------------------->

			  <div class="modal fade" id="ModalBajaCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:100%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>			
       </div>		   
   </div>			  
</div>
</div>

<!------------------ Motivo de baja check ------------------------>


			  <div class="modal fade" id="ModalMotivoBajaCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:25%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Motivo de Baja del Servicio </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<textarea style="width:100%;height:80%"></textarea>
            

			
       </div>		   
   </div>			  
</div>
</div>


<!-----------------Modal plantillas en espera ------------------>

			  <div class="modal fade" id="ModalPlantillasEnEspera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:45%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			<h3 class="modal-title">Plantillas en espera de ser aceptadas</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
	        <div id="content_plantilla_status"></div>
            
       </div>		   
   </div>			  
</div>
</div>


<!---------------- Consulta de plantillas ------------------------> 

			  <div class="modal fade" id="ModalVerPreguntas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:100%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			<h3 class="modal-title">Preguntas de la plantilla seleccionada</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
	        <div id="content_questions"></div>
            
       </div>		   
   </div>			  
</div>
</div>


<!--------------- consulta llamadas certificacion --------------->


			  <div class="modal fade" id="ModalConsultaCertificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:100%;overflow: hidden;">
		<div class="modal-content">
			<div class="modal-header">
			<h3 class="modal-title">Consulta llamadas en proceso de certificar</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
	        <div id="folios_llamadas"></div>
            
       </div>		   
   </div>			  
</div>
</div>




		
   <div id="piedepagina" style="z-index" ><?php print date('Y')?> - Coppel - Control Cr&eacute;dito - 
        <span>Todos los Derechos Reservados</span>&copy;&nbsp;
    </div>
</body>




<script>

//valida puesto

var puesto = $('#puesto').val();
console.log(puesto);

var nc = $('#nc').val();

var minombre = document.getElementById("tu_nombre_es");

minombre.innerHTML = nc;

console.log(nc);

if(puesto==="Jefe Cat")
{
	
   var btn_administrador = document.getElementById("btn_administrador").style.display="none";
    //var btn_certificacion = document.getElementById("btn_certificacion").style.display="none";	
      
	
} else if(puesto==="Operativo")
{
	 
	
	var btn_administrador = document.getElementById("btn_administrador").style.display="none";	
    var btn_certificacion = document.getElementById("btn_certificacion").style.display="none";
	

	
}else if(puesto==="Administrador")
{
	
	console.log("tienes todos los poderes :D");
	
}


function general($id){
	console.log("general");
	if($id==1)
	{
			
	 document.getElementById('tableGeneral').style.display="none";
	 
	}
	

	
	
}


function llamarfin(){
	
	
	  consultaFinGestion();
	
	
}


function check(tabla,Eval) {

       console.log(tabla,Eval);

       var questions = document.getElementById("Tbl"+tabla+"_Pregunta"+Eval).disabled=false;
 
 
}

function cerrar1(){
		
     $("#ModalAltaCheck").hide();
  
     $(".modal-backdrop").remove();
  

}

function cerrar2(){
	
	
	 $("#ModalNuevoCheck").hide();
		
	 $(".modal-backdrop").remove();
	
}




function validaEmp() {
    
	 var numempleado = $('#txt_alta_empleado').val().length;
	 console.log(numempleado);
	
     if(numempleado == 8 )
     {

     console.log(numempleado);
     consultaEmpleado();
 

     }	
	
	
}

function validaEmail()
{
	
     var correo= $('#txt_alta_correo').val();

	 var split=correo.split('');

	 var dominio="";

	 var bandera=false;

	 //validar que no empiece con punto 
	 if(split[0]!='.')
	{
			
		for (var i = 0; i < correo.length; i++) 
		{
			if (split[i]=='.' && split[i+1] =='.') 
			{
				i=correo.length;
			}
			
			if (split[i]=='-' && split[i+1] =='-') 
			{
				i=correo.length;
			}

			if(split[i]=='@')
			{
				
				if (split[i-1]!='.') 
				{
					
					for (var j = i+1; j < correo.length; j++) 
					{
						dominio=dominio+split[j];
					}
					if(dominio=="hotmail.com"||dominio=="outlook.com"||dominio=="gmail.com"||dominio=="yahoo.com"||dominio=="coppel.com")
					{
						
						if (correo.length>1 && correo.length<321) 
						{
							bandera=true;
							 var telefono = document.getElementById("txt_alta_celular").disabled=false;
						}

					}
				}
			}
		}
	}

	if(bandera!=true)
	{
		
		alert("El correo electronico ingresado es invalido favor de verificar e intentar de nuevo");
		
	}

	

}

function CaracteresvalidosCorreo(evt) {
    var code = evt.which ? evt.which : evt.keyCode;
    if ((code == 8) || (code == 46) || code==64 ||(code >= 48 && code <= 57)||code==45||code==95||
    	code>=65 && code<=90||code>=97 && code<=122) {
        return true;
    } else {
        return false;
    }
}//FIN CaracteresvalidosIP()

function validacofetel()
{
	  
	 var cantidad = $("#txt_alta_celular").val().length;
	
	if(cantidad == 10)
	{
		
		var btn_alta = document.getElementById("realizar_alta").disabled=false;
		
	}
}



function consultaEmpleado(){
	
     var parametros ="opc=llamarEmpleado" 
		+"&empleado="+ $('#txt_alta_empleado').val();
	     console.log(parametros);
	 
	
	 	 
	 	$.ajax ({
      cache: false,
      url: 'assets/php/funciones_certificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
      	if (response.estado == 't') {
	
      		$('#txt_alta_nombre').val(response.nombrecompleto);
      		$('#txt_alta_centro').val(response.centro);
			$('#txt_alta_puesto').val(response.puestonominal);
			

			 var roll = document.getElementById("select_alta_roll").disabled=false;
			 var correo = document.getElementById("txt_alta_correo").disabled=false;
			 //var telefono = document.getElementById("txt_alta_celular").disabled=false;
	  
	  
			
			
			
      	}else{
			
			alert("el numero de empleado no existe o no se encuentra activo en el catalogo de empleados cat favor de validar");
			
      	}
      },
      error:function(xhr,status,error) {
        
		
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
		
		
      }
  });
  


	
}



	  

		   
			   

$(function() {
    

	
      jQuery("#miform").validationEngine({
        promptPosition: "centerRight:0,-5"
      });

      $(document).on("click", "#btnadd", function(event) {
		  
		let count = document.getElementsByClassName("edicion_platilla_filas_a").length;	
			
        count++;
		console.log(count);
        $('#tabla1_1 tr:last').after('<tr id="tr'+count+'" class="edicion_platilla_filas_a""><td style="width:10%;text-align:center;">' + count + '<button class="btnborrar" type="button" onclick="elimina('+ count +')" title="ELIMINAR CELDA"></button></td><td><input id="t1_col2_input'+count+'" class="input-text-t1" name="st1_colum2[]" style="width:100%" placeholder="Descripcion 50 caracteres" disabled /></td><td><input id="t1_col3_input'+count+'" class="input-text-col3-t1" name="st1_colum3[]" style="width:100%" disabled /></td><td></td></tr>');
        event.preventDefault();
		
		var puntos = "PA1";

	    puntos_que_aplican(count,puntos);
	   
      });
    });
	
	$(function() {
    
	 
	
      jQuery("#miform").validationEngine({
        promptPosition: "centerRight:0,-5"
      });

      $(document).on("click", "#btnadd2", function(event) {
		  
		  let count2 = document.getElementsByClassName("edicion_platilla_filas_b").length;
		
		  
		  count2++;
        $('#tabla2_1 tr:last').after('<tr id="tbl2_tr'+count2+'" class="edicion_platilla_filas_b"><td style="width:10%;text-align:center;">' + count2 + '<button class="btnborrar" type="button" onclick="elimina2('+ count2 +')" title="ELIMINAR CELDA"></button></td><td><input id="t2_col2_input'+count2+'" class="input-text-t2" name="st2_colum2[]" style="width:100%"  placeholder="Descripcion 50 caracteres" disabled /></td><td><input id="t2_col3_input'+count2+'" class="input-text-col3-t2" name="st2_colum3[]" style="width:100%" disabled /></td><td></td></tr>');
        event.preventDefault();
		
		var puntos = "PA2"
		
		puntos_que_aplican(count2,puntos);
		
      });
    });
	
    	$(function() {
   
   	   
   
      jQuery("#miform").validationEngine({
        promptPosition: "centerRight:0,-5"
      });

      $(document).on("click", "#btnadd3", function(event) {
        
        let count3 = document.getElementsByClassName("edicion_platilla_filas_c").length;
		
		count3++;
        $('#tabla3_1 tr:last').after('<tr id="tbl3_tr'+count3+'" class="edicion_platilla_filas_c"><td style="width:10%;text-align:center;">' + count3 + '<button class="btnborrar" type="button" onclick="elimina3('+ count3 +')" title="ELIMINA CELDA"></button></td><td><input id="t3_col2_input'+count3+'" class="input-text-t3" name="st3_colum2[]" style="width:100%" placeholder="Descripcion 50 caracteres" disabled /></td><td><input id="t3_col3_input'+count3+'" class="input-text-col3-t3" name="st3_colum3[]" style="width:100%" disabled /></td><td></td></tr>');
        event.preventDefault();
		
		var puntos = "PA3"
		
		puntos_que_aplican(count3,puntos);
		
      });
    });
	
//modal de calificaciones	

	  	$(function() {
      $(document).on("click", "#calif_add", function(event) {
		
	   var fila = document.getElementsByClassName("num_filas").length;
	   console.log(fila);
	   fila ++;
		
        $('#suptable1 tr:last').after('<tr id="fila'+fila+'"  class="num_filas"><td nowrap style="width:10%;text-align:center;">'+ fila +'</td><td nowrap style="width:70%;"><input style="height:25px;text-align:center;" /></td><td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="select_min"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td><td nowrap style="width:10%;"><select class="certificado" style="width:100%;" onclick="combobox()" class="certificado"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td></tr>');
        event.preventDefault();
		
      });
    });
	
	
		  	$(function() {
      $(document).on("click", "#calif_add2", function(event) {
		
	   var fila = document.getElementsByClassName("num_filas2").length;
	   console.log(fila);
	   fila ++;
		
        $('#suptable2 tr:last').after('<tr id="#"  class="num_filas"><td nowrap style="width:10%;text-align:center;">'+ fila +'</td><td nowrap style="width:70%;"><input style="height:25px;text-align:center;" /></td><td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="select_min2"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td><td nowrap style="width:10%;"><select class="certificado2" style="width:100%;" onclick="combobox()" class="certificado"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td></tr>');
        event.preventDefault();
		
      });
    });
	
		    $(function() {
      $(document).on("click", "#calif_add3", function(event) {
		
	   var fila = document.getElementsByClassName("num_filas3").length;
	   console.log(fila);
	   fila ++;
		
        $('#suptable3 tr:last').after('<tr id="#"  class="num_filas"><td nowrap style="width:10%;text-align:center;">'+ fila +'</td><td nowrap style="width:70%;"><input style="height:25px;text-align:center;" /></td><td nowrap style="width:10%;"><select style="width:100%;" onclick="combobox()" class="select_min3"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td><td nowrap style="width:10%;"><select class="certificado3" style="width:100%;" onclick="combobox()" class="certificado"><option value="1">1</option><option value="0">0</option><option value="NA">NA</option></select></td></tr>');
        event.preventDefault();
		
      });
    });
	

	
function elimina(parametro){

    var count = document.getElementsByClassName("edicion_platilla_filas_a").length;	

     var parametro;
	 count--;
	 

	 
	 if(count>=1)
	 {
	
	 var columna = document.getElementById("tr"+parametro);
	 columna.parentNode.removeChild(columna);
	
	var pa1 = document.getElementById("PA1").innerHTML=count;
	 
	 }else{
		 
		 console.log("nou");
		 count++;
		 
	 }
}

function elimina2(parametro){
	
	 var count2 = document.getElementsByClassName("edicion_platilla_filas_b").length;	
  
     var parametro;
	 count2--;
	 

	 
	 if(count2>=1)
	 {
	 
	 var columna = document.getElementById("tbl2_tr"+parametro);
	 columna.parentNode.removeChild(columna);
	 
	  var pa2 = document.getElementById("PA2").innerHTML=count2;
	 
	 }else{
		 
		 console.log("nou");
		 count2++;
		 
	 }
	 
	 
}
function elimina3(parametro){

    var count3 = document.getElementsByClassName("edicion_platilla_filas_c").length;

     var parametro;
	 count3--;
	 

	
	if(count3>=1)
	{
	
	 var columna = document.getElementById("tbl3_tr"+parametro);
	 columna.parentNode.removeChild(columna);
	 
	 var pa3 = document.getElementById("PA3").innerHTML=count3;
	 
	}else{
		
		console.log("nou");
		count3++;
		
	}
	 
}

var select = document.getElementById('serv_admin');

     select.addEventListener('change',
     function(){
     var selectedOption = this.options[select.selectedIndex];
     console.log(selectedOption.value + ': ' + selectedOption.text);
	 if(selectedOption.value != 0)
	 {
		 console.log("no es cero");
		
		 var btn = document.getElementById('btn_editar').disabled=false;
		 
		
		
	 }
	
  });
  
  <!-- modal supervicion -->
  
  var aspectos_tecnicos,negociacion,dialogo_calido,resultado_total;
  var total , total2  , total3  , total4  , total5  ,total6  ;
    
	
	
	
	function combobox(){
			
 
      var button_guardar = document.getElementById("btnguarda");
	  
	      button_guardar.disabled=false;
	  	 
	  var combo;
	  var acumulador = 0;
	  var acumulador2 = 0;
	  var acumulador3 = 0;
	  var acumulador4 = 0;
	  var acumulador5 = 0;
	  var acumulador6 = 0;
	  
	  var select_min = 0;
	  var certificado = 0;
	  var select_min2 = 0;
	  var certificado2 = 0;
	  var select_min3 = 0;
	  var certificado3 = 0;
	  
	  var st1 = document.getElementsByClassName("select_min");
	  var st2 = document.getElementsByClassName("certificado");
	  var st3 = document.getElementsByClassName("select_min2");
	  var st4 = document.getElementsByClassName("certificado2");
	  var st5 = document.getElementsByClassName("select_min3");
	  var st6 = document.getElementsByClassName("certificado3");
	


 for(i=0;i<st1.length;i++)
 {
	 combo = document.getElementsByClassName("select_min")[i].value;
	if(isNaN(combo))
	{		

		console.log(acumulador);
		
	}else{	
	 select_min++;
     acumulador += parseInt(combo);
     console.log(select_min);	
	}
 }

console.log(acumulador); 
 
   for(i=0;i<st2.length;i++)
 {
     combo = document.getElementsByClassName("certificado")[i].value;
	if(isNaN(combo))
	{		
        console.log("no sumar");

	}else{
	 certificado++;	
     acumulador2 += parseInt(combo);
     console.log(certificado);	
	}
 }

 for(i=0;i<st3.length;i++)
 {
     combo = document.getElementsByClassName("select_min2")[i].value;
	if(isNaN(combo))
	{		
        console.log("no sumar");

	}else{
	 select_min2++;	
     acumulador3 += parseInt(combo);
     console.log(select_min2);	
	}
 }


 for(i=0;i<st4.length;i++)
 {
     combo = document.getElementsByClassName("certificado2")[i].value;
	if(isNaN(combo))
	{		
        console.log("no sumar");

	}else{
	certificado2++;	
    acumulador4 += parseInt(combo);
    console.log(certificado2);	
	}
 } 
 
 
 for(i=0;i<st5.length;i++)
 {
     combo = document.getElementsByClassName("select_min3")[i].value;
	if(isNaN(combo))
	{		
        console.log("no sumar");

	}else{
	 select_min3++;	
     acumulador5 += parseInt(combo);
     console.log(select_min3);	
	}
 }
 
 
 for(i=0;i<st6.length;i++)
 {
     combo = document.getElementsByClassName("certificado3")[i].value;
	if(isNaN(combo))
	{		
        console.log("no sumar");

	}else{
	 certificado3++;	
     acumulador6 += parseInt(combo);
     console.log(certificado3);	
	}
 }
 
 
 
    var R1 = acumulador * 100;
     var R2 = acumulador2 * 100;
      var R3 = acumulador3 * 100;
       var R4 = acumulador4 * 100;	 
        var R5 = acumulador5 * 100;
	     var R6 = acumulador6 * 100;
 

	
	     var div1 = R1 / select_min;
	     var div2 = R2 / certificado;
	     var div3 = R3 / select_min2;
	     var div4 = R4 / certificado2;
	     var div5 = R5 / select_min3;
	     var div6 = R6 / certificado3;

 
		 var minimo = document.getElementById("total1").innerHTML = Math.round(div1*100)/100;
		 var cert = document.getElementById("total2").innerHTML = Math.round(div2*100)/100;
		 var minimo2 = document.getElementById("total3").innerHTML = Math.round(div3*100)/100;
		 var cert2 = document.getElementById("total4").innerHTML = Math.round(div4*100)/100;
		 var minimo3 = document.getElementById("total5").innerHTML = Math.round(div5*100)/100;
		 var cert3 = document.getElementById("total6").innerHTML = Math.round(div6*100)/100;
		
		 var Puntos_minimo = document.getElementById("Puntos_minimo").innerHTML = select_min;
		 var Puntos_certificado = document.getElementById("Puntos_certificado").innerHTML = certificado;
		 var Puntos_minimo2 = document.getElementById("Puntos_minimo2").innerHTML = select_min2;
		 var Puntos_certificado2 = document.getElementById("Puntos_certificado2").innerHTML = certificado2;
		 var Puntos_minimo3 = document.getElementById("Puntos_minimo3").innerHTML = select_min3;
		 var Puntos_certificado3 = document.getElementById("Puntos_certificado3").innerHTML = certificado3;

		
		//pintar primera celda

		if(div1<=100&&div1>=95){
			
			
         document.getElementById("total1").style.background = "blue";
		 document.getElementById("total1").style.color = "white";


		}else if(div1<=94.99&&div1>=90){

         document.getElementById("total1").style.background = "green";
		 document.getElementById("total1").style.color = "white";


		}else if(div1<=89.99&&div1>=80){

         document.getElementById("total1").style.background = "yellow";
		 document.getElementById("total1").style.color = "black";


		}else if(div1<=79.99&&div1>=70){

		 document.getElementById("total1").style.background = "orange";
		 document.getElementById("total1").style.color = "white";


		}else if(div1<=69.99&&div1>=30){

		 document.getElementById("total1").style.background = "red";
		 document.getElementById("total1").style.color = "white";


		}else if(div1<=29.99&&div1>=0){

		 document.getElementById("total1").style.background = "purple";
		 document.getElementById("total1").style.color = "white";



		}
				
      if(div2<=100&&div2>=95){

         document.getElementById("total2").style.background = "blue";
		 document.getElementById("total2").style.color = "white";



	}else if(div2<=94.99&&div2>=90){

         document.getElementById("total2").style.background = "green";
		 document.getElementById("total2").style.color = "white";



		}else if(div2<=89.99&&div2>=80){

         document.getElementById("total2").style.background = "yellow";
		 document.getElementById("total2").style.color = "black";


		}else if(div2<=79.99&&div2>=70){

		 document.getElementById("total2").style.background = "orange";
		 document.getElementById("total2").style.color = "white";



		}else if(div2<=69.99&&div2>=30){

		 document.getElementById("total2").style.background = "red";
		 document.getElementById("total2").style.color = "white";



		}else if(div2<=29.99&&div2>=0){

		 document.getElementById("total2").style.background = "purple";
		 document.getElementById("total2").style.color = "white";



		}
		
        if(div3<=100&&div3>=95){

         document.getElementById("total3").style.background = "blue";
		 document.getElementById("total3").style.color = "white";



		}else if(div3<=94.99&&div3>=90){

         document.getElementById("total3").style.background = "green";
		 document.getElementById("total3").style.color = "white";


		}else if(div3<=89.99&&div3>=80){

         document.getElementById("total3").style.background = "yellow";
		 document.getElementById("total3").style.color = "black";


		}else if(div3<=79.99&&div3>=70){

		 document.getElementById("total3").style.background = "orange";
		 document.getElementById("total3").style.color = "white";



		}else if(div3<=69.99&&div3>=30){

		 document.getElementById("total3").style.background = "red";
		 document.getElementById("total3").style.color = "white";



		}else if(div3<=29.99&&div3>=0){

		 document.getElementById("total3").style.background = "purple";
		 document.getElementById("total3").style.color = "white";



		}
		
        if(div4<=100&&div4>=95){

         document.getElementById("total4").style.background = "blue";
		 document.getElementById("total4").style.color = "white";



		}else if(div4<=94.99&&div4>=90){

         document.getElementById("total4").style.background = "green";
		 document.getElementById("total4").style.color = "white";



		}else if(div4<=89.99&&div4>=80){

         document.getElementById("total4").style.background = "yellow";
		 document.getElementById("total4").style.color = "black";


		}else if(div4<=79.99&&div4>=70){

		 document.getElementById("total4").style.background = "orange";
		 document.getElementById("total4").style.color = "white";




		}else if(div4<=69.99&&div4>=30){

		 document.getElementById("total4").style.background = "red";
		 document.getElementById("total4").style.color = "white";



		}else if(div4<=29.99&&div4>=0){

		 document.getElementById("total4").style.background = "purple";
		 document.getElementById("total4").style.color = "white";



		}
		
         if(div5<=100&&div5>=95){

         document.getElementById("total5").style.background = "blue";
		 document.getElementById("total5").style.color = "white";



		}else if(div5<=94.99&&div5>=90){

         document.getElementById("total5").style.background = "green";
		 document.getElementById("total5").style.color = "white";



		}else if(div5<=89.99&&div5>=80){

         document.getElementById("total5").style.background = "yellow";
		 document.getElementById("total5").style.color = "black";


		}else if(div5<=79.99&&div5>=70){

		 document.getElementById("total5").style.background = "orange";
		 document.getElementById("total5").style.color = "white";





		}else if(div5<=69.99&&div5>=30){

		 document.getElementById("total5").style.background = "red";
		 document.getElementById("total5").style.color = "white";



		}else if(div5<=29.99&&div5>=0){

		 document.getElementById("total5").style.background = "purple";
		 document.getElementById("total5").style.color = "white";

 
		}
			
         if(div6<=100&&div6>=95){

         document.getElementById("total6").style.background = "blue";
		 document.getElementById("total6").style.color = "white";


		}else if(div6<=94.99&&div6>=90){

        document.getElementById("total6").style.background = "green";
		document.getElementById("total6").style.color = "white";


		}else if(div6<=89.99&&div6>=80){

         document.getElementById("total6").style.background = "yellow";
		 document.getElementById("total6").style.color = "black";



		}else if(div6<=79.99&&div6>=70){

		 document.getElementById("total6").style.background = "orange";
		 document.getElementById("total6").style.color = "white";



		}else if(div6<=69.99&&div6>=30){

		 document.getElementById("total6").style.background = "red";
		 document.getElementById("total6").style.color = "white";



		}else if(div6<=29.99&&div6>=0){

		 document.getElementById("total6").style.background = "purple";
		 document.getElementById("total6").style.color = "white";


		}
		
		 total = div1;
		 total2 = div2;
		 total3 =  div3;
		 total4 = div4;
		 total5 = div5;
		 total6 = div6;
				
     aspectos_tecnicos  = (parseInt(total) + parseInt(total2))/2;
     negociacion = (parseInt(total3) + parseInt(total4))/2;
     dialogo_calido = (parseInt(total5) + parseInt(total6))/2;
	 
     resultado_total = (parseInt(aspectos_tecnicos)+parseInt(negociacion)+parseInt(dialogo_calido))/3;
    	 
	

	}
	
	function btn_plantilla(count,Bandera){
		
		console.log(count);
			console.log(Bandera);
	
	if(Bandera==1){
		console.log("supervicion");
		
		
		var btn_color = document.getElementById("btn"+count);
		
		var cliente = btn_color.getAttribute("client");
		
		console.log(cliente);
		
		
		var servicio = $("#selectServicio").val();
		console.log(servicio);
		
		var parametros = " opc=plantilla_supervicion"+ "&Servicios=" + servicio+"&Cliente="+ cliente;
          
        var ruta = 'assets/php/consulta_preguntas.php';
		console.log(parametros);
			  
       	$.ajax({
	
     cache: false,
     async: false,
     url:ruta,
     type:'POST',
	 dataType: 'JSON',
	 data:parametros,
     success:function (response) { 
      if(response.estados == 1)
	  {         
                
                $('#modal_preguntas').html(response.tabla);
        		$('#modal_preguntas').show();
				
			    btn_color.className = "btn btn-success btn-xs";
				

	  }else if(response.estados == -200){

	    Swal.fire("nose encontro informacion");
	   
	  }	  
     
	   
      },error:function(xhr,status,error) {
        	Swal.fire("error");
      	}		
});	

	}else if(Bandera==2){
		
		console.log("certificacion");
		
		var inicio = 0;
		
		var fin = 32;
		
		var  btn_color = document.getElementById("btn"+count);
		
		var servicio = $("#CCS").val();

		var button = document.getElementById("btn-audio"+count);
		
        var id_llamada = button.getAttribute("dataid");
		
        var subcadena = id_llamada.substring(inicio, fin);
 
		var parametros = "opc=plantilla_certificacion"+"&Servicios="+servicio+"&dataID="+subcadena;
		
		console.log(parametros);
		
        var ruta = 'assets/php/consulta_preguntas.php';
			  
       	$.ajax({
	
     cache: false,
     async: false,
     url:ruta,
     type:'POST',
	 dataType: 'JSON',
	 data:parametros,
     success:function (response) { 
      if(response.estados == 1)
	  {         
                
                $('#modal_preguntas').html(response.tabla);
        		$('#modal_preguntas').show();
				
				
			    btn_color.className = "btn btn-success btn-xs";

	  }else if(response.estados == -200){

	     Swal.fire("nose encontro informacion");
	   
	  }	  
     
	   
      },error:function(xhr,status,error) {
        	Swal.fire("error");
      	}		
});	
		
		
		
	}
        
		
			
	}
	
				
function guarda(){	

    
     var MyDate = new Date();
     var horas =	MyDate.getHours();
     var minutos = MyDate.getMinutes();
     var segundos = MyDate.getSeconds();
     var MyDateString;
     MyDate.setDate(MyDate.getDate());
     MyDateString = MyDate.getFullYear()+'-'+('0' + (MyDate.getMonth()+1)).slice(-2)+'-'+('0' + MyDate.getDate()).slice(-2);

     console.log(MyDateString);
	
	 var tiempo_actual = horas + ":" + minutos + ":" + segundos; 
	
	 console.log(horas + ":" + minutos + ":" + segundos);
    
     var textarea1 = $('#text-area1').val();
	  var textarea2 = $('#text-area2').val();
	   var textarea3= $('#text-area3').val();
		
		 var observaciones = "1:  "+"  "+textarea1+"2:  "+"  "+textarea2+"3:  "+"  "+textarea3;
          console.log(observaciones);		 
    
	 console.log(textarea1);
     console.log(textarea2);
	 console.log(textarea3);
     
     
	 var btn_guarda_calificaciones = document.getElementById("btnguarda");
	 
	 var cliente = btn_guarda_calificaciones.getAttribute("client");
	 
     var fin_gestion = $('#finGestion').val();
     var servicio = $('#selectServicio').val();	 
	 var esclavo = $('#txt_numEmpleado').val();
	 var nombre = $('#txt_nombre').val();
	 var jefe = $('#txt_jefe').val();
	 var centro = $('#txt_centro').val();
     var fecha = $('#date_fecha').val();


					
     var ruta ='assets/php/guarda_modal.php';
	
     var parametros = {
		   "Empleado":esclavo,
		   "Nombre":nombre,
		   "Jefe":jefe,
		   "Centro":centro,
		   "Cliente":cliente,
		   "FinGestion":fin_gestion,
		   "Servicio":servicio,
		   "Aspectos_Tecnicos":aspectos_tecnicos,
		   "Minimo1":total,
		   "Certificado1":total2,
		   "Negociacion":negociacion,
		   "Minimo2":total3,
		   "Certificado2":total4,
		   "Dialogo_Calido":dialogo_calido,
		   "Minimo3":total5,
		   "Certificado3":total6,
		   "Total":resultado_total,
		   "Fecha":fecha,
		   "MyDateString":MyDateString,
		   "Hora":tiempo_actual,
		   "Observaciones":observaciones
 	};	
    console.log(parametros);
	$.ajax({
        cache: false,
		async: false,
        url:ruta,
        type: 'POST',
		dataType:'JSON',
        data: parametros,
        success: function(response){
			   
			     console.log(response);
                if(response.estado == 1)
				{
                 Swal.fire("Se guardo correctamente");
				 
				 $('#miModal').hide();
				 $('.modal-backdrop').remove();
				 
				
				 
				 
				}else if(response.estado == 2)
				{
				 	
				  Swal.fire("la llamada a sido calificada anteriormente favor de verificar");
				  
				  $('#miModal').hide();
				 $('.modal-backdrop').remove();
				  
				 
				}else if(response.estado == 3)
				{
					
					Swal.fire("favor de llenar los campos");
					
				}

   
      	},
      	error:function(xhr,status,error) {
       
        	Swal.fire("error al guardar");
      	}
  	});
	
  	

}


function modal_replica(count){
	
  console.log("modal replicas");
   var select  = document.getElementById("Concentrado").value;	 
   

     var esclavo = $('#txt_numEmpleado2').val();
	 var opresor = $('#txt_jefe2').val();
	 var centro  = $('#txt_centro2').val();
	 var boton = document.getElementById("btn_replica"+count);
	 var replica = boton.getAttribute("dataID");

	 var parametros
	 
	    if(select === "ConcentradoDiario")
   {
	       var parametros = "opc=modal_replica"+"&numempleado="+esclavo+"&dataID="+replica+"&select="+select+"&nomjefe="+opresor+"&centro="+centro;
     console.log(parametros);
	   
   }else if(select === "SemaforoSemanal")
   {
	   
	       var parametros = "opc=modal_replica"+"&numempleado="+esclavo+"&dataID="+replica+"&select="+select;
     console.log(parametros);
	   
   }
	 
   console.log(parametros);
 
   
   $.ajax ({
      cache: false,
      url: 'assets/php/funciones_consCalificacion.php',
      type: 'POST',
      dataType: 'json',
      data: parametros,
      success: function(response) {
      if (response.estado == 1) {
		
			
        		$('#result').html(response.table);
        		$('#result').show();
				
					if(puesto==="Administrador")
	{
		
	  var text_replica = document.getElementById("text_replica").disabled=false;
	  var text_respuesta = document.getElementById("text_respuesta").disabled=false;
		
		
	}else if(puesto==="Jefe Cat")
	{
		
      var text_replica = document.getElementById("text_replica").disabled=false;

				
	}else if(puesto==="Operativo")
	{
		
		
		
	}
				
        	}else{
				
				alert("error");
				
			}
      },
      error:function(xhr,status,error) {
     
        alert("<div class='error'>informationResult:"+xhr.responseText+"</div>", function(){});
	
      }
  });
  	
}
</script>
  
  <script type="text/javascript" src="assets/js/alertify.min.js"></script>
  <script type="text/javascript" src="assets/js/bootbox.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="assets/js/functions_SupCalidad.js"></script>
    <script type="text/javascript" src="assets/js/funciones_ConsultaCalif.js"></script>
  <script type="text/javascript" src="assets/js/funciones_administrador.js"></script>
  <script type="text/javascript" src="assets/js/funciones_certificacion.js"></script>
  <script type="text/javascript" src="assets/js/descargar_audio.js"></script>
      <script type="text/javascript" src="assets/js/Login.js"></script>
  	  <!--query de la plantilla-->
  

  <link  rel="stylesheet" type="text/css" href="assets/css/validationEngine.jquery.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.validationEngine.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.validationEngine-es.js"></script>
  
</html>