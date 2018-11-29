let table 	= document.getElementById('table'),
	salario 	= document.getElementById('smensual'),
	send 	  	= document.getElementById('envio'),
	quincenal	= document.getElementById("squincenal"),
	fhanton1	= document.getElementById("fhanton1"),
	aptsso		= document.getElementById("aptsso"),
	faov		= document.getElementById("faov"),
	retsso		= document.getElementById("retsso"),
	mensual     = document.getElementById("mensual")
	valueChange = false;
		
	//VALORES DE FORMULAS
	let faov_ = $("#faov_").val()
	let retsso_ = $("#retsso_").val()
	let aptsso_ = $("#aptsso_").val()
	
	//Valor De Cambio Para Los Llenados Del Modal
	let change = function(valor){valueChange = valor}

		//Determinamos Hacia Donde Va La Funcion
	$(".rowList").click(function(){
		let i = $(this).index();              	
		document.getElementById("cargo").value = table.rows[i].cells[1].innerHTML;
		document.getElementById("smensual").value=table.rows[i].cells[2].innerHTML;
		document.getElementById("fhanton1").value=table.rows[i].cells[3].innerHTML;
		document.getElementById("squincenal").value=table.rows[i].cells[3].innerHTML;
		document.getElementById("ticket").value=table.rows[i].cells[4].innerHTML;
		faov.value		= ((salario.value/2)*faov_).toFixed(2);
		retsso.value	= ((salario.value/2)*retsso_).toFixed(2);
		aptsso.value 	= ((salario.value/2)*aptsso_).toFixed(2);

	});


	
// let FullRowDelete = function(i)
	// 	{
	// 		document.getElementById("chargeName").value   = table.rows[i].cells[1].innerHTML;                    
	// 		document.getElementById("codigoDelete").value = table.rows[i].cells[0].innerHTML;
	// 	};


	// let FullRowUpdate = function(i)
	// {
		
	// 	document.getElementById("codigo").value      = table.rows[i].cells[0].innerHTML;      
	// 	document.getElementById("cargo").value       = table.rows[i].cells[1].innerHTML;
	// 	document.getElementById("mensual").value   	 = table.rows[i].cells[2].innerHTML;
	// 	document.getElementById("quincenal").value   = table.rows[i].cells[3].innerHTML;
	// 	document.getElementById("fhanton").value     = table.rows[i].cells[3].innerHTML;
	// };
	salario.addEventListener("change",function(){
		fhanton1.value 	= salario.value/2;
		aptsso.value 	= ((salario.value/2)*aptsso_).toFixed(2);
		faov.value		= ((salario.value/2)*faov_).toFixed(2);
		retsso.value	= ((salario.value/2)*retsso_).toFixed(2);

	})
	// mensual.addEventListener("change",function(){
	// 	fhanton.value 	= mensual.value/2;
	// 	document.getElementById("quincenal").value = mensual.value/2;

	// })
	
	$("#form-register").submit(function(e) {
    e.preventDefault();
    quincenal.value = fhanton1.value;
	}).validate({
	    rules: {
	        ticket: 	{ required: true, minlength: 2},
	        smensual: 	{ required: true,minlength:4,number:true}
	    },
	    messages: {
	        ticket: 	"Debe Introducir El CestaTicket",
	        smensual: 	"Debe Introducir El Salario Mensual. Mayor > 4 Caracteres"
	    },
	    submitHandler : function(){
	        document.getElementById('form-register').submit();    
	    }
	});






