/**
 * Created by Abel on 15/03/2015.
 */
$(document).ready(function(){

    if($(".mydiv"))
    {
        $('#card-form').submit(function(event) {
            event.preventDefault();
            var $form;
            $form = $(this);
            if($form.find('.cupon').val())
            {
                checkcode($form);
            }

            return false;
        });
        $('#cash-form-banorte').submit(function(event) {
            event.preventDefault();
            var $form;
            $form = $(this);
            checkcode($form);
            return false;
        });
        $('#cash-form-oxxo').submit(function(event) {
            event.preventDefault();
            var $form;
            $form = $(this);
            checkcode($form);
            return false;
        });

        function checkcode(value)
        {
            value.find("button").prop("disabled", true);

            var consulta = $.post("inscripcion.php?set=controllers_Content&run=verify_cupon_ajax",value.serialize(),
                function (data) {
                    if(data.response == 'ok') {
                        value.append($("<input type=\"hidden\" name=\"descuento\" />").val(data.value));
                        value.get(0).submit();
                    }
                    else if(data.response == 'error')
                    {
                        alert(data.message);
                        value.find("button").prop("disabled", false);
                    }
                }, "json");
        }
    }
});
