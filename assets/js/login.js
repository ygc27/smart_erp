jQuery(document).ready(function () {
    "use strict";
    var options = {};
    options.ui = {
        container: "#pwd-container",
        showVerdictsInsideProgressBar: true,
        viewports: {
            progress: ".pwstrength_viewport_progress"
        }
    };
    $('#senha').pwstrength(options);

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
});

jQuery('.cpf').mask('000.000.000-00');
jQuery('.cnpj').mask('00.000.000/0000-00');
jQuery('.cep').mask('00000-000');
jQuery('.telefone').mask('(00)0000-0000');
jQuery('.celular').mask('(00)00000-0000');