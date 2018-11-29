let general  	= document.getElementById("general");
let opciones	= document.getElementById("opciones");
let tab 		= document.getElementById('table');
let todos 		= document.getElementById('todos');
let filtro 		= document.getElementById('filtro');



atajos = function(clas,valor=""){
	let atajo = "<input  class='form-control "+clas+"' style='width: 85px;height: 23px; display: block;' type='number' value='"+ valor +"'>";
	return atajo;
};

filtro.addEventListener("change",function(){
	let determinante = filtro.value;
	$.ajax({
	    
	    url : '../logica/control/controlNomina.php',	 	
	    data: {
	    	choice 	   	: "filtrado",
	    	byFilter    : determinante
	    },
	    type : 'POST',	    
	    
	    dataType: 'json',

	    success : function(data) {

	    	var cuerpo = "";
	    	for (var i = 0; i < data.length; i++) {cuerpo+="<tr><td>"+data[i][0]+data[i][1]+"</td><td>"+data[i][2]+"</td><td>"+data[i][3]+"</td><td>"+data[i][4]+"</td><td>"+atajos("x1")+"</td><td>"+atajos("x2")+"</td><td>"+atajos("x3")+"</td><td>"+atajos("x4")+"</td></tr>";}
	    	$("#tableBody").empty();
	    	$("#tableBody").append(cuerpo);
	    },
	    error : function(xhr, status) {alert('gibert: '+xhr+status);},

	});
});

todos.addEventListener("click",function(){
	location.reload();
});

document.getElementById('agregar').addEventListener("click",function(){

	switch(opciones.value) {
	    case "bono":
	        fullRow(4,general.value,"x1");
	        break;
	    case "vacacional":
	        fullRow(5,general.value,"x2");
	        break;
	    case "retroactivo":
	        fullRow(6,general.value,"x3");
	        break;
	    case "inacistencia":
	        fullRow(7,general.value,"x4");
	        break;
    }
});

let fullRow = function(c,valor,clas){
	let restul = atajos(clas,valor)
	for (var i=1;i < tab.rows.length; i++){    		
        tab.rows[i].cells[c].innerHTML= restul;
    }
};


var retorno = function(text){
	if(text == ""){return 0;}
	else if(parseInt(text)< 0){return 0;}
	else if(isNaN(text)){return 0;}
	else{return text;}
};


document.getElementById('generar').addEventListener("click",function(){

	for (var i=0;i < tab.rows.length-1; i++){ 
        let cedula 	= tab.rows[i+1].cells[1].innerHTML; 
        let quincena= parseInt(tab.rows[i+1].cells[3].innerHTML)/2;         
        var bono	=retorno(document.getElementsByClassName("x1")[i].value);        
        var vaciona =retorno(document.getElementsByClassName("x2")[i].value);
        var retroac =retorno(document.getElementsByClassName("x3")[i].value);
        var faltas	=retorno(document.getElementsByClassName("x4")[i].value);

         
        nominaInsertion(cedula,bono,vaciona,retroac,faltas,quincena);
    }
});


//MEROJA EL CODIGO GUARDANDO UN OBJETO QUE CONTENGA TODAS LAS OPERACIONES !! USA UNA TRANSACCION A NIVEL DE SQL
var nominaInsertion = function(cedula,bono,vaciona,retroac,faltas,quincena){
	let dia 		= document.getElementById('dia').value;
	let mes 		= document.getElementById('mes').value;
	let ano 		= document.getElementById('ano').value;
	let fecha		= ano+"-"+mes+"-"+dia;
	if(mes == 2){dia = 28;}
	
	
	 
	$.ajax({
	    
	    url : '../logica/control/controlNomina.php',	 	
	    data: {
	    	choice		:"nomina", 
	    	bono 	   	: bono, 
			vaciona     : vaciona,
			retroac    	: retroac,
			faltas    	: faltas,
			cedula    	: cedula,
			quincena    : quincena,
			fecha		: fecha
	    },
	    type : 'POST',	    
	    success : function(data) {	    	
	    	var mesje = "<div class='alert alert-info alert-dismissable'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>"+data+"</strong></div>"
	    	$('#msj').html(mesje);
	    	// console.log(data);
	    },
	    error : function(xhr, status) {alert('fhdjshf: '+xhr+status);},
	    
	});

}	

