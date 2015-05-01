$(document).ready(function(){
Conekta.setPublishableKey('tu key publica');
});

    jQuery(function($) {
      $("#card-form").submit(function(event) {
        var $form;
        $form = $(this);
    /* Previene hacer submit más de una vez */
     $form.find("button").prop("disabled", true);
    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

    /* Previene que la información de la forma sea enviada al servidor */
    return false;
  });
});
var conektaSuccessResponseHandler;

conektaSuccessResponseHandler = function(token) {
  var $form;
  $form = $("#card-form");
  
/* Inserta el token_id en la forma para que se envíe al servidor */

  $form.append($("<input type=\"hidden\" name=\"conektaTokenId\" />").val(token.id));

/* and submit */

  $form.get(0).submit();
};
//errores
var conektaErrorResponseHandler;
conektaErrorResponseHandler = function(response) {
  var $form;
  $form = $("#card-form");

  
/* Muestra los errores en la forma */
var mensaje;
 if(response.message == "The card number is invalid."){
    mensaje = "El numero de la tarjeta es invalido";
  }else if(response.message == "The expiration month is invalid."){
    mensaje = "El mes de expiracion es invalido.";
  }else if(response.message == "The cardholder name is invalid."){
    mensaje = "El nombre del titular no es valido.";
  }else if(response.message == "The CVC (security code) of the card is invalid."){
    mensaje = "El CVC (codigo de seguridad) es invalido.";
  }else if(response.message == "This charge has been declined because buyer behavior is suspicious."){
    mensaje = "El cargo fue declinado (sospecho de fraude).";
    setTimeout("location.href  =  'inscripcion.php?accion=pagar';",3000);
  }else{
    mensaje = response.message;
  }
  

  $form.find(".card-errors").text(mensaje);
  $form.find("button").prop("disabled", false);
};