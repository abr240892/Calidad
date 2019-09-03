<!-- 	<div id="">
 -->    
	
				<div class="col-md-3" align="left">
	      <button class="btn btn-primary btn-md text-center" id="consulta_llamadas2" data-toggle="modal" data-target="#ModalConsultaCertificacion" onclick="consulta_llamadas_certificacion()" >
	        <span  ></span> Consulta llamadas en certificacion 
	      </button>
	    </div>

	    <div class="col-md-2" align="left">
	      <button class="btn btn-primary btn-md text-center" id="consulta_llamadas" onclick="certificacionConsulta()">
	        <span  ></span> Buscar llamadas
	      </button>
	    </div>
	    <div class="col-md-1" align="left">
	      <button class="btn btn-primary btn-md text-center" onclick="certificacionAlta();">
	        <span class="glyphicon glyphicon-arrow-up" ></span> Alta
	      </button>
	    </div>
	    <div class="col-md-2" align="left">
	      <button class="btn btn-primary btn-md text-center" onclick="certificacionBaja();">
	        <span class="glyphicon glyphicon-arrow-down" ></span> Baja
	      </button>
      </div>
	  	      <div class="col-md-2" align="left">
	      <button class="btn btn-primary btn-md text-center" id="consultarFolios" disabled="true">
	        <span class="glyphicon glyphicon-search" ></span> Buscar # empleado
	      </button>
	    </div>
		
		  	      <div class="col-md-1" align="left">
	      <button class="btn btn-primary btn-md text-center" id="consultarFolios2"  disabled="true">
	        <span class="glyphicon glyphicon-search" ></span> Buscar por id de llamada
	      </button>
	    </div>
	  
    <div id="ModalContainer"> </div>

    <!-- <div id="">
                <div class="col-md-10">
                  <div id="btns_certificacionAlta"></div>
                  <button class="btn btn-primary btn-md text-center" id="">
                    <span class="glyphicon glyphicon-erase" ></span> Alta Servicio
                  </button>
                  <button class="btn btn-primary btn-md text-center" id="">
                    <span class="glyphicon glyphicon-erase" ></span> Alta Usuarios
                  </button>
                  <button class="btn btn-primary btn-md text-center" id="">
                    <span class="glyphicon glyphicon-erase" ></span> Alta Servicio
                  </button>
                </div>
              </div>
 -->

    

<!--     <div class="dropdown">
		 <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Alta Usuarios<span class="caret"></span></button>
		 <div class="panel panel-info dropdown-menu" style="width: 30% !important;">   
	                <div class="panel-heading">
	                    <h3 class="panel-title"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>Alta</h3>
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
	                    </div> -->