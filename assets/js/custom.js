jQuery(function () {
    //Initialize DataTable
    jQuery(".dataTable").DataTable();

    //Initialize Select2 Elements
    jQuery(".select2").select2();
});

//iCheck for checkbox and radio inputs
jQuery('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
});

/*jQuery(document).ready(function () {
 "use strict";
 var options = {};
 options.ui = {
 container: "#pwd-container",
 showVerdictsInsideProgressBar: true,
 viewports: {
 progress: ".pwstrength_viewport_progress"
 }
 };
 $(':password').pwstrength(options);
 });*/

//Máscara dos campos
jQuery('.cpf').mask('000.000.000-00');
jQuery('.cnpj').mask('00.000.000/0000-00');
jQuery('.cep').mask('00000-000');
jQuery('.telefone').mask('(00)0000-0000');
jQuery('.celular').mask('(00)00000-0000');
jQuery('.desconto').mask('0000000');
jQuery('.estoque').mask('0000000');
$('.money2').mask('000.000.000.000.000,00', {reverse: true});
jQuery(".money").val('0,00');
jQuery(".money").keyup(function () {
    var element = $(this);
    var v = element.val()
    v = v.replace(/\D/g, "")
    v = v.replace(/^0+/g, '')
    switch (v.length) {
        case 15:
            v = '0,00'
            break;
        case 0:
        case 1:
        case 2:
            v = '0,' + ("00" + v).slice(-2)
            break;

        default:
            v = v.replace(/^(\d{1,3})(\d{2})$/, "$1,$2")
            v = v.replace(/^(\d{1,3})(\d{3})(\d{2})$/, "$1.$2,$3")
            v = v.replace(/^(\d{1,3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3,$4")
            v = v.replace(/^(\d{1,3})(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3.$4,$5")
    }

    element.val(v)
});

var phones = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(phones.apply({}, arguments), options);
            }
        };

jQuery('.phones').mask(phones, spOptions);

jQuery("input[name=desconto]").click(function () {
    var desconto = jQuery("input[name=desconto]").val();

    if (desconto == 0) {
        jQuery("input[name=desconto]").val('');
    }
});

jQuery(".textarea").wysihtml5();

jQuery('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
});


/*jQuery(document).ready(function () {
 //Consulta o webservice viacep.com.br/
 jQuery("#cep").blur(function () {
 jQuery.getJSON("https://viacep.com.br/ws/" + jQuery("#cep").val() + "/json", function (dados) {
 if (!("erro" in dados)) {
 //Atualiza os campos com os valores da consulta.
 
 //console.log(dados);
 
 jQuery("#endereco").val(dados.logradouro);
 jQuery("#bairro").val(dados.bairro);
 jQuery("#cidade").val(dados.localidade);
 jQuery("#uf").val(dados.uf);
 jQuery("#numero").focus();
 }
 else {
 alert("CEP não encontrado.");
 }
 });
 
 //var uf = jQuery("#uf").val(dados.uf);
 
 
 
 });
 
 });*/
