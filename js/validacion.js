$(function() {


        $('#registro-form').validate({
            rules: {
                        "email" : {email: true},
                        "nombre": {required : true, lettersonly: true },
                        "aPaterno": {required : true, lettersonly: true }, 
                        "aMaterno": {required : true, lettersonly: true },
                        "dia": {required : true, valueNotEquals: "-" },
                        "mes": {required : true, valueNotEquals: "-" },
                        "anio": {required : true, valueNotEquals: "-" },
                        "estado": {required : true, valueNotEquals: "-" },
                        "pais": {required : true, lettersonly: true },
                        "sex": {required : true}
                       
                    },

                    messages: {
                        "email": {required: "Este campo es obligatorio", email : "El formato de correo no es valido"},  
                        "nombre": {required: "Este campo es obligatorio", lettersonly: "Solo puedes introducir letras"},
                        "aPaterno": {required: "Este campo es obligatorio", lettersonly: "Solo puedes introducir letras"}, 
                        "aMaterno": {required: "Este campo es obligatorio", lettersonly: "Solo puedes introducir letras"},
                        "dia": {required: "Este campo es obligatorio", valueNotEquals: "Debes seleccionar un día"},
                        "mes": {required: "Este campo es obligatorio", valueNotEquals: "Debes seleccionar un mes"},
                        "anio": {required: "Este campo es obligatorio", valueNotEquals: "Debes seleccionar un año"},
                        "estado": {required: "Este campo es obligatorio", valueNotEquals: "Debes seleccionar un estado"},
                        "pais": {required: "Este campo es obligatorio", lettersonly: "Solo puedes introducir letras"},
                        "sex": {required: "Debes seleccionar tu sexo"}
                       	
                    },
            onkeyup : false  
        });
    });




    





$(document).ready(function(){

$("#email").blur(function() {
$.ajax({
 url: 'core/comprobarMail.php' ,
 type: 'POST' ,
 dataType: "json",
 data: $("#email").serialize(),
 success: function(response) {
  if(response.msg=="1"){  
    $(".mensajeMailExistente").show();
    $(".mensajeMail").hide();
    $(".ocultarMail").hide();
  }
  else{
   $(".mensajeMail").show();
    $(".ocultarMail").show(); 
    $(".mensajeMailExistente").hide();
  }
}            
});

  });

$("#elegir-pago").change(function(){
 
		if($(this).val()=="tc"){
			$("#card-form").show("slow");
			$("#cash-form").hide("slow");
		}
		else if($(this).val()=="efectivo"){
			$("#card-form").hide("slow");
			$("#cash-form").show("slow");
		}else{
			$("#card-form").hide("slow");
			$("#cash-form").hide("slow");
		}

});


$('#card-form').validate({
            rules: {
                        "nombre-tc": {required : true },
                        "cvc" : {required: true, integer:true},
                        "mes": {required : true, integer: true },
                        "anio": {required : true, integer: true }
                        
                    },

                    messages: {
                        "nombre-tc": {required : "Este campo es requerido"},
                        "cvc" : {required: "Este campo es requerido", integer:"Solo puedes introducir numeros"},
                        "mes": {required : "Este campo es requerido", integer: "Solo puedes introducir numeros" },
                        "anio": {required : "Este campo es requerido", integer: "Solo puedes introducir numeros" }
                    },
            onkeyup : false  
        });


}); /*fin de document ready*/

