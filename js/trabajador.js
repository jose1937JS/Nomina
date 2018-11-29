$.validator.addMethod('onlyText',function(value,elem){
    if(isNaN(value)){return true}
    else{return false}
},'Solo se permiten letras')


$("#form-register").submit(function(e) {
    e.preventDefault();
    
}).validate({
    rules: {
        name:       { required: true, minlength: 3,maxlength: 40,onlyText:true},
        lastname:   { required: true, minlength: 2,maxlength: 40,onlyText:true},
        cedula:     { required:true, minlength:6,number:true},
        thelfone:   { required:true,minlength: 7,number:true, maxlength: 12,number:true},
        email:      { required: true,email: true},
        count:      { required:true, minlength: 20,maxlength: 21,number:true},
        date:       { required:true}
    },
    messages: {
        name:       "Debe introducir su nombre correctamente.",
        lastname:   "Debe introducir su apellido correctamente.",
        cedula:     "Debe introducir su cedula correctamente.",
        thelfone:   "El número de teléfono introducido no es correcto.",
        email:      "Debe introducir una direccion de correo validad.",
        count:      "Debe ingresar un numero de cuenta oficial.",
        date:       "Debe ingresar la fecha de inicio laboral."
    },
    submitHandler : function(){
        document.getElementById('form-register').submit();    
    }
});

