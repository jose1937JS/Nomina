let table = document.getElementById('table'),
	valueChange = false;

	//Valor De Cambio Para Los Llenados Del Modal
	let change = function(valor){valueChange = valor}

		//Determinamos Hacia Donde Va La Funcion
	$(".rowList").click(function(){
		let i = $(this).index();              
	  	(valueChange)? FullRowUpdate(i) : FullRowDelete(i) 
	});

	let FullRowDelete = function(i)
	  {
		  document.getElementById("nameWorker").value = table.rows[i].cells[0].innerHTML;                    
		  document.getElementById("cedulaDelete").value = table.rows[i].cells[1].innerHTML;
	  };


	let FullRowUpdate = function(i)
	{
				  
		let fullName= table.rows[i].cells[0].innerHTML;
		let listName= fullName.split(" ");
		document.getElementById("name").value 		= listName[0];
		document.getElementById("lastname").value 	= listName[1]; 
		document.getElementById("cedula").value 	= table.rows[i].cells[1].innerHTML;
		document.getElementById("fhanton").value 	= table.rows[i].cells[1].innerHTML; 
		document.getElementById("thelfone").value 	= table.rows[i].cells[2].innerHTML;                	
		document.getElementById("dependency").value = table.rows[i].cells[3].innerHTML;
		document.getElementById("email").value 		= table.rows[i].cells[4].innerHTML;
		document.getElementById("count").value 		= table.rows[i].cells[5].innerHTML;
		document.getElementById("charge").value 	= table.rows[i].cells[6].innerHTML;;

		
	};


