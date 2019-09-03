
var parametros;
function create(){
	
	
     var select = document.getElementsByClassName("select_min")[0].value;
	      var select2 = document.getElementsByClassName("select_min")[1].value;
		       var select3 = document.getElementsByClassName("select_min")[2].value;
			        var select4 = document.getElementsByClassName("select_min")[3].value;
					     var select5 = document.getElementsByClassName("select_min")[4].value;


	var select_cert = document.getElementsByClassName("certificado")[0].value;
        var select_cert2 = document.getElementsByClassName("certificado")[1].value;
            var select_cert3 = document.getElementsByClassName("certificado")[2].value;
	            var select_cert4 = document.getElementsByClassName("certificado")[3].value;
                    var select_cert5 = document.getElementsByClassName("certificado")[4].value;


     var selecttbl2_1 = document.getElementsByClassName("select_min2")[0].value;
	      var selecttbl2_2 = document.getElementsByClassName("select_min2")[1].value;
		       var selecttbl2_3 = document.getElementsByClassName("select_min2")[2].value;
			        var selecttbl2_4 = document.getElementsByClassName("select_min2")[3].value;
					     var selecttbl2_5 = document.getElementsByClassName("select_min2")[4].value;


	  var selecttbl2_cert = document.getElementsByClassName("certificado2")[0].value;
        var selecttbl2_cert2 = document.getElementsByClassName("certificado2")[1].value;
            var selecttbl2_cert3 = document.getElementsByClassName("certificado2")[2].value;
	            var selecttbl2_cert4 = document.getElementsByClassName("certificado2")[3].value;
                    var selecttbl2_cert5 = document.getElementsByClassName("certificado2")[4].value;


	var selecttbl3_1 = document.getElementsByClassName("select_min3")[0].value;
	      var selecttbl3_2 = document.getElementsByClassName("select_min3")[1].value;
		       var selecttbl3_3 = document.getElementsByClassName("select_min3")[2].value;
			        var selecttbl3_4 = document.getElementsByClassName("select_min3")[3].value;
					     var selecttbl3_5 = document.getElementsByClassName("select_min3")[4].value;


	  var selecttbl3_cert = document.getElementsByClassName("certificado3")[0].value;
        var selecttbl3_cert2 = document.getElementsByClassName("certificado3")[1].value;
            var selecttbl3_cert3 = document.getElementsByClassName("certificado3")[2].value;
	            var selecttbl3_cert4 = document.getElementsByClassName("certificado3")[3].value;
                    var selecttbl3_cert5 = document.getElementsByClassName("certificado3")[4].value;


if(select=='NA'){

parseInt(select) = 0;
parseInt(select2) =5;
parseInt(select3) =5;
parseInt(select4) =5;
parseInt(select5) =5;


}


	var	total = parseInt(select) + parseInt(select2) + parseInt(select3) + parseInt(select4) + parseInt(select5);

	var  total2 = parseInt(select_cert) + parseInt(select_cert2) + parseInt(select_cert3) + parseInt(select_cert4) + parseInt(select_cert5);

	var  total3 = parseInt(selecttbl2_1) + parseInt(selecttbl2_2) + parseInt(selecttbl2_3) + parseInt(selecttbl2_4) + parseInt(selecttbl2_5);

	var  total4 = parseInt(selecttbl2_cert) + parseInt(selecttbl2_cert2) + parseInt(selecttbl2_cert3) + parseInt(selecttbl2_cert4) + parseInt(selecttbl2_cert5);

	var  total5 = parseInt(selecttbl3_1) + parseInt(selecttbl3_2) + parseInt(selecttbl3_3) + parseInt(selecttbl3_4) + parseInt(selecttbl3_5);

	var  total6 = parseInt(selecttbl3_cert) + parseInt(selecttbl3_cert2) + parseInt(selecttbl3_cert3) + parseInt(selecttbl3_cert4) + parseInt(selecttbl3_cert5);


		var minimo = document.getElementById("total1").innerHTML = total;
		var certificado = document.getElementById("total2").innerHTML = total2;
		var minimo2 = document.getElementById("total3").innerHTML = total3;
		var certificado2 = document.getElementById("total4").innerHTML = total4;
		var minimo3 = document.getElementById("total5").innerHTML = total5;
		var certificado3 = document.getElementById("total6").innerHTML = total6;


		//pintar primera celda

		if(total<=100&&total>=95){
			
		
			
        document.getElementById("total1").style.background = "blue";
		document.getElementById("total1").style.color = "white";


        //document.getElementById("total2").style.background = "blue";
	    //document.getElementById("total2").style.color = "white";


		}else if(total<=94.99&&total>=90){

        document.getElementById("total1").style.background = "green";
		document.getElementById("total1").style.color = "white";


        //document.getElementById("total2").style.background = "green";
		//document.getElementById("total2").style.color = "white";

		}else if(total<=89.99&&total>=80){

        document.getElementById("total1").style.background = "yellow";
		document.getElementById("total1").style.color = "black";

	    //document.getElementById("total2").style.background = "yellow";
		//document.getElementById("total2").style.color = "black";

		}else if(total<=79.99&&total>=70){

		document.getElementById("total1").style.background = "orange";
		document.getElementById("total1").style.color = "white";


		//document.getElementById("total2").style.background = "orange";
		//document.getElementById("total2").style.color = "white";


		}else if(total<=69.99&&total>=30){

		document.getElementById("total1").style.background = "red";
		document.getElementById("total1").style.color = "white";


		//document.getElementById("total2").style.background = "red";
		//document.getElementById("total2").style.color = "white";


		}else if(total<=29.99&&total>=0){

		document.getElementById("total1").style.background = "purple";
		document.getElementById("total1").style.color = "white";


		//document.getElementById("total2").style.background = "purple";
		//document.getElementById("total2").style.color = "white";


		

		}
		
      if(total2<=100&&total2>=95){

        document.getElementById("total2").style.background = "blue";
		document.getElementById("total2").style.color = "white";


        //document.getElementById("total2").style.background = "blue";
	    //document.getElementById("total2").style.color = "white";


		}else if(total2<=94.99&&total2>=90){

        document.getElementById("total2").style.background = "green";
		document.getElementById("total2").style.color = "white";


        //document.getElementById("total2").style.background = "green";
		//document.getElementById("total2").style.color = "white";

		}else if(total2<=89.99&&total2>=80){

        document.getElementById("total2").style.background = "yellow";
		document.getElementById("total2").style.color = "black";

	    //document.getElementById("total2").style.background = "yellow";
		//document.getElementById("total2").style.color = "black";

		}else if(total2<=79.99&&total2>=70){

		document.getElementById("total2").style.background = "orange";
		document.getElementById("total2").style.color = "white";


		//document.getElementById("total2").style.background = "orange";
		//document.getElementById("total2").style.color = "white";


		}else if(total2<=69.99&&total2>=30){

		document.getElementById("total2").style.background = "red";
		document.getElementById("total2").style.color = "white";


		//document.getElementById("total2").style.background = "red";
		//document.getElementById("total2").style.color = "white";


		}else if(total2<=29.99&&total2>=0){

		document.getElementById("total2").style.background = "purple";
		document.getElementById("total2").style.color = "white";


		//document.getElementById("total2").style.background = "purple";
		//document.getElementById("total2").style.color = "white";


		
		}
		



        if(total3<=100&&total3>=95){

        document.getElementById("total3").style.background = "blue";
		document.getElementById("total3").style.color = "white";


        //document.getElementById("total2").style.background = "blue";
	    //document.getElementById("total2").style.color = "white";


		}else if(total3<=94.99&&total3>=90){

        document.getElementById("total3").style.background = "green";
		document.getElementById("total3").style.color = "white";


        //document.getElementById("total2").style.background = "green";
		//document.getElementById("total2").style.color = "white";

		}else if(total3<=89.99&&total3>=80){

        document.getElementById("total3").style.background = "yellow";
		document.getElementById("total3").style.color = "black";

	    //document.getElementById("total2").style.background = "yellow";
		//document.getElementById("total2").style.color = "black";

		}else if(total3<=79.99&&total3>=70){

		document.getElementById("total3").style.background = "orange";
		document.getElementById("total3").style.color = "white";


		//document.getElementById("total2").style.background = "orange";
		//document.getElementById("total2").style.color = "white";


		}else if(total3<=69.99&&total3>=30){

		document.getElementById("total3").style.background = "red";
		document.getElementById("total3").style.color = "white";


		//document.getElementById("total2").style.background = "red";
		//document.getElementById("total2").style.color = "white";


		}else if(total3<=29.99&&total3>=0){

		document.getElementById("total3").style.background = "purple";
		document.getElementById("total3").style.color = "white";


		//document.getElementById("total2").style.background = "purple";
		//document.getElementById("total2").style.color = "white";

		
		

		}
		
	


        if(total4<=100&&total4>=95){

        document.getElementById("total4").style.background = "blue";
		document.getElementById("total4").style.color = "white";


        //document.getElementById("total2").style.background = "blue";
	    //document.getElementById("total2").style.color = "white";


		}else if(total4<=94.99&&total4>=90){

        document.getElementById("total4").style.background = "green";
		document.getElementById("total4").style.color = "white";


        //document.getElementById("total2").style.background = "green";
		//document.getElementById("total2").style.color = "white";

		}else if(total4<=89.99&&total4>=80){

        document.getElementById("total4").style.background = "yellow";
		document.getElementById("total4").style.color = "black";

	    //document.getElementById("total2").style.background = "yellow";
		//document.getElementById("total2").style.color = "black";

		}else if(total4<=79.99&&total4>=70){

		document.getElementById("total4").style.background = "orange";
		document.getElementById("total4").style.color = "white";


		//document.getElementById("total2").style.background = "orange";
		//document.getElementById("total2").style.color = "white";


		}else if(total4<=69.99&&total4>=30){

		document.getElementById("total4").style.background = "red";
		document.getElementById("total4").style.color = "white";


		//document.getElementById("total2").style.background = "red";
		//document.getElementById("total2").style.color = "white";


		}else if(total4<=29.99&&total4>=0){

		document.getElementById("total4").style.background = "purple";
		document.getElementById("total4").style.color = "white";


		//document.getElementById("total2").style.background = "purple";
		//document.getElementById("total2").style.color = "white";

		
		

		}
		


         if(total5<=100&&total5>=95){

        document.getElementById("total5").style.background = "blue";
		document.getElementById("total5").style.color = "white";


        //document.getElementById("total2").style.background = "blue";
	    //document.getElementById("total2").style.color = "white";


		}else if(total5<=94.99&&total5>=90){

        document.getElementById("total5").style.background = "green";
		document.getElementById("total5").style.color = "white";


        //document.getElementById("total2").style.background = "green";
		//document.getElementById("total2").style.color = "white";

		}else if(total5<=89.99&&total5>=80){

        document.getElementById("total5").style.background = "yellow";
		document.getElementById("total5").style.color = "black";

	    //document.getElementById("total2").style.background = "yellow";
		//document.getElementById("total2").style.color = "black";

		}else if(total5<=79.99&&total5>=70){

		document.getElementById("total5").style.background = "orange";
		document.getElementById("total5").style.color = "white";


		//document.getElementById("total2").style.background = "orange";
		//document.getElementById("total2").style.color = "white";


		}else if(total5<=69.99&&total5>=30){

		document.getElementById("total5").style.background = "red";
		document.getElementById("total5").style.color = "white";


		//document.getElementById("total2").style.background = "red";
		//document.getElementById("total2").style.color = "white";


		}else if(total5<=29.99&&total5>=0){

		document.getElementById("total5").style.background = "purple";
		document.getElementById("total5").style.color = "white";


		//document.getElementById("total2").style.background = "purple";
		//document.getElementById("total2").style.color = "white";

        
		 
		}
		
		

		
		
		

         if(total6<=100&&total6>=95){

        document.getElementById("total6").style.background = "blue";
		document.getElementById("total6").style.color = "white";


        //document.getElementById("total2").style.background = "blue";
	    //document.getElementById("total2").style.color = "white";


		}else if(total6<=94.99&&total6>=90){

        document.getElementById("total6").style.background = "green";
		document.getElementById("total6").style.color = "white";


        //document.getElementById("total2").style.background = "green";
		//document.getElementById("total2").style.color = "white";

		}else if(total6<=89.99&&total6>=80){

        document.getElementById("total6").style.background = "yellow";
		document.getElementById("total6").style.color = "black";

	    //document.getElementById("total2").style.background = "yellow";
		//document.getElementById("total2").style.color = "black";

		}else if(total6<=79.99&&total6>=70){

		document.getElementById("total6").style.background = "orange";
		document.getElementById("total6").style.color = "white";


		//document.getElementById("total2").style.background = "orange";
		//document.getElementById("total2").style.color = "white";


		}else if(total6<=69.99&&total6>=30){

		document.getElementById("total6").style.background = "red";
		document.getElementById("total6").style.color = "white";


		//document.getElementById("total2").style.background = "red";
		//document.getElementById("total2").style.color = "white";


		}else if(total6<=29.99&&total6>=0){

		document.getElementById("total6").style.background = "purple";
		document.getElementById("total6").style.color = "white";


		//document.getElementById("total2").style.background = "purple";
		//document.getElementById("total2").style.color = "white";


		}
		
    var aspectos_tecnicos  = (parseInt(total) + parseInt(total2))/2;
    var negociacion = (parseInt(total3) + parseInt(total4))/2;
    var dialogo_calido = (parseInt(total5) + parseInt(total6))/2;
    var resultado_total = (parseInt(aspectos_tecnicos)+parseInt(negociacion)+parseInt(dialogo_calido))/3;	
	
    
	var esclavo = $('#txt_numEmpleado').val();
	var nombre = $('#txt_nombre').val();
	var jefe = $('#txt_jefe').val();

		
	var parametros = {
		   "Empleado":esclavo,
		   "Nombre":nombre,
		   "Jefe":jefe,
		   "Aspectos_Tecnicos":aspectos_tecnicos,
		   "Negociacion":negociacion,
		   "Dialogo_Calido":dialogo_calido,
		   "Total":resultado_total
 	};

      //guardar_plantilla(parametros);

	$(document).ready(function(){
	$('#btnguarda').click(function(){
				
var array = parametros;

    
	
var ruta ='assets/php/guarda_modal.php';
	
console.log(parametros);
	
$.ajax({
	
     cache:false,
     url:ruta,
     type:'POST',
	 data:array,
     success:function (data) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            
       alert("OK");
			

			
                }
});	
		
		
	});
});
	
	  
	 
}
