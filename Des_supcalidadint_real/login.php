
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8;IE=9;IE=10;IE=Edge;">
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/css/imagenes/key_coppel.ico">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/estilo_login.css">
    <link rel="stylesheet" type="text/css" href="assets/css/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/default.min.css">
    <link href="assets/css/jquery.ui.all.css" rel="stylesheet"    type="text/css">
    <link href="assets/css/alertify.min.css" rel="stylesheet" media="screen">

    <!-- <script type="text/javascript" src="assets/js/bootbox.min.js"></script> -->

    <script type="text/javascript" src="assets/js/js-verificarusuario.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootbox.min.js"></script>
    <script type="text/javascript" src="assets/js/alertify.min.js" ></script>
    <script type="text/javascript" src="assets/js/Login.js"></script>
    
</head>
<body>
    <div class="bb-alert">
        <span></span>
    </div>
    <header class="titulo">
        <img id="imgcoppel" src="assets/css/imagenes/COPPEL.jpg">
        <label class="label">Sistema De Supervición Integral
        </label><span id="" style="position:absolute;left:89%;top:10px;color:white;"></span>
    </header>

    <div>
        <div id="container">
            <div class="panel panel-info" style="width: 30%; margin: 0 auto;margin-top: 10%;" > 
                <div class="panel-heading">
                    <a href="src/SETUP_AGENTECOPPEL_1.0.4.exe" style="float: right;font-size: 14px;"><!-- <span class="glyphicon glyphicon-download"></span>Generar huella --></a>
                    <h3 class="panel-title"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>Login</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li id="tab1"><a data-toggle="tab" onclick="CambiarOpc(1)">Contraseña</a></li>
                        <!--    <li id="tab2"><a data-toggle="tab" onclick="CambiarOpc(2)">Huella</a></li> -->
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div id="tabContra" class="form-group" >
                            <div class="input-group" >
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input id="numero" autocomplete="off" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size ="8" maxlength="8" type="text" class="form-control" placeholder="Número de empleado">
                            </div>
                        
                            <div class="input-group" style="margin-top:15px;">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input id="clave" type="password" class="form-control"  placeholder="Contraseña" size ="8">
                            </div>
                            <div>
                                <center>
                                    <button type="button" name="" id ="myBtn" class="btn btn-block btn-info" onclick="fnValidaUsuario()" style="width:100%;height:30px; margin-top: 15px;">Ingresar
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div id="tabHuella" class="tab-pane fade in active" >
                        <div class="form-group">
                            <div class="input-group" style="margin-top:-15px;left:4%; width: 92%;">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input id="txtEmpleado" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" type="text" required="undefined" class="form-control"  placeholder="Número de empleado" size ="8" maxlength="8" autofocus/>
                            </div>
                            <center>
                                <button type="button" id="btnEntrar" style="width:93%;height:30px; margin-top: 15px;" class="btn btn-block btn-info" onclick="LevantaHuella($('#txtEmpleado')['0'].value)">Ingresar
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div id="piedepagina" ><?php print date('Y')?> - Coppel - Creacion De Campañas - 
                <span>Todos los Derechos Reservados</span>&copy;&nbsp;
            </div>
        </div>
</body>
    <div id="hiddenform"></div>
</html>
</body>
</html>
<script> 
    var input = document.getElementById("numero");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) 
        {
            fnValidaUsuario();
        }         
    });
</script>
<script> 
    var input = document.getElementById("clave");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) 
        {
            fnValidaUsuario();
        }         
    });
</script>
<script> 
    var huella= document.getElementById("txtEmpleado");
    huella.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) 
        {
            document.getElementById("btnEntrar").click();
        }
    });
</script> 
<!-- <script type="text/javascript">
console.log('login');
    function show5() {
        if (!document.layers&&!document.all&&!document.getElementById)
	        return

	        var Digital=new Date()
	        var hours=Digital.getHours()
	        var minutes=Digital.getMinutes()
	        var seconds=Digital.getSeconds()

	        var dn="p.m."
	        if (hours<12)
	        	dn="a.m."
	        if (hours>12)
	       		hours=hours-12
	        if (hours==0)
	        	hours=12

	        if (minutes<=9)
	        	minutes="0"+minutes
	        if (seconds<=9)
	        	seconds="0"+seconds
	        //change font size here to your desire
	        myclock="<font size='4'><b><font size='3'>"+hours+":"+minutes+":"+seconds+" "+dn+"</font>"
	        if (document.layers) {
		        document.layers.liveclock.document.write(myclock)
		        document.layers.liveclock.document.close()
	        }
	        else if (document.all)
	        	liveclock.innerHTML=myclock
	        else if (document.getElementById)
		        document.getElementById("liveclock").innerHTML=myclock
		        setTimeout("show5()",1000)
        }
    window.onload=show5
</script> -->
                