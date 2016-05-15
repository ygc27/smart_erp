<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/cliente'); ?>"><i class="fa fa-users"></i> Clientes</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <br/>
                {MENSAGEM_SISTEMA_ERRO}
                {MENSAGEM_SISTEMA_SUCESSO}
            </div>
        </div>

        <div class="row">
            <?php echo form_open(base_url('admin/cliente/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data')); ?>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Dados do Cliente - {ACAO}</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo_cliente">Código do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="ion-code-working"></i>
                                    </div>
                                    <input type="text" class="form-control" name="codigo_cliente" id="codigo_cliente" value="{codigo_cliente}" readonly />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tipo_perfil">Tipo de Conta <span class="required">*</span></label>
                                <select class="form-control" name="tipo_perfil" id="tipo_perfil" data-error="Selecione um tipo de conta" required>
                                    <option value="">Selecione um tipo de conta</option>
                                    <option value="pf">Pessoa Física</option>
                                    <option value="pj">Pessoa Jurídica</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div id="perfil_pf"></div>
                            <div id="perfil_pj"></div>

                            <div class="form-group">
                                <label for="telefone">Telefone <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control telefone" name="telefone" id="telefone" maxlength="13" data-error="O campo telefone é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-mobile fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control celular" name="celular" id="celular" maxlength="14" data-error="O campo celular é obrigatorio" required />  
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <label>Imagem</label>
                            <div class="form-group">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="http://placehold.it/200x150" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">Selecione imagem</span>
                                            <span class="fileinput-exists">Alterar</span>
                                            <input type="file" name="image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desconto">Desconto</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-money fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control desconto" name="desconto" id="desconto" value="{desconto}" />   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"> Endereço</h3>
                    </div>

                    <div class="box-body">

                        <div class="form-group">
                            <label for="cep">CEP <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control cep" name="cep" id="cep" maxlength="9" data-error="O campo cep é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="endereco">Endereço <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="endereco" id="endereco" data-error="O campo endereço é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="numero">Nº <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="numero" id="numero" data-error="O campo número é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="complemento">Complemento <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="complemento" id="complemento" data-error="O campo complemento é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="bairro">Bairro <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="bairro" id="bairro" data-error="O campo bairro é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="cidade">Cidade <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="cidade" id="cidade" data-error="O campo cidade é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="uf">UF <span class="required">*</span></label>

                            <select class="form-control" name="uf" id="uf" data-error="Selecione um estado" required>
                                <option value="">Selecione um estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Endereço Entrega</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="cep_entrega">CEP <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control cep" name="cep_entrega" id="cep_entrega" maxlength="9" onblur="pesquisacep(this.value);" data-error="O campo cep é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="endereco_entrega">Endereço/Entrega <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="endereco_entrega" id="endereco_entrega" data-error="O campo endereço é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="numero_entrega">Nº <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="numero_entrega" id="numero_entrega" data-error="O campo número é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="complemento_entrega">Complemento <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="complemento_entrega" id="complemento_entrega" data-error="O campo complemento é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="bairro_entrega">Bairro <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="bairro_entrega" id="bairro_entrega" data-error="O campo bairro é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="cidade_entrega">Cidade <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="cidade_entrega" id="cidade_entrega" data-error="O campo cidade é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="uf_entrega">UF <span class="required">*</span></label>

                            <select class="form-control" name="uf_entrega" id="uf_entrega" data-error="Selecione um estado" required>
                                <option value="">Selecione um estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"> Dados de Acesso</h3>
                    </div>

                    <div class="box-body">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope fa-fw"></i>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email" data-error="O campo email é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group">
                                <label for="senha">Senha <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock fa-fw"></i>
                                    </div>
                                    <input type="password" class="form-control" name="senha" id="senha" data-error="O campo senha é obrigatorio" required />               
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <div class="row" id="pwd-container">
                                    <div class="col-sm-12">
                                        <div class="pwstrength_viewport_progress"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ative">
                                    <input type="checkbox" class="minimal" name="ativo" id="ativo" value="S" />&nbsp;&nbsp;Ativo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="well">
                    <div class="tooltip-demo">
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save fa-fw"></i></button>&nbsp;&nbsp;

                        <a href="{URLLISTAR}" title="Voltar" data-toggle="tooltip" data-placement="top" class="btn btn-primary"><i class="fa fa-mail-reply-all fa-fw"></i></a>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>

<script>
    jQuery(document).ready(function () {

        // Verificação da força da senha
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


        //Consulta o webservice viacep.com.br/
        jQuery("#cep").blur(function () {
            jQuery.getJSON("https://viacep.com.br/ws/" + jQuery("#cep").val() + "/json", function (dados) {
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
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
        });
        //var uf = jQuery("#uf").val(dados.uf);

    });

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('endereco_entrega').value = ("");
        document.getElementById('bairro_entrega').value = ("");
        document.getElementById('cidade_entrega').value = ("");
        document.getElementById('uf_entrega').value = ("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco_entrega').value = (conteudo.logradouro);
            document.getElementById('bairro_entrega').value = (conteudo.bairro);
            document.getElementById('cidade_entrega').value = (conteudo.localidade);
            document.getElementById('uf_entrega').value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep_entrega = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep_entrega != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep_entrega)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco_entrega').value = "...";
                document.getElementById('bairro_entrega').value = "...";
                document.getElementById('cidade_entrega').value = "...";
                document.getElementById('uf_entrega').value = "...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/' + cep_entrega + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }

    // Valida Perfil Usuário
    jQuery(document).ready(function () {

        $("#tipo_perfil").change(function () {

            var tipo_perfil = $('#tipo_perfil').val();

            $('#perfil_pf').empty();
            var perfil_pf = '<div class="form-group">';
            perfil_pf += '<label for="cpf">CPF <span class="required">*</span></label>';
            perfil_pf += '<div class="input-group">';
            perfil_pf += '<div class="input-group-addon">';
            perfil_pf += '<i class="fa fa-user fa-fw"></i>';
            perfil_pf += '</div>';
            perfil_pf += '<input type="text" class="form-control cpf" onchange="return valida_cpf(this.value)" name="cpf" id="cpf" data-error="O campo cpf é obrigatorio" required autofocus />';
            perfil_pf += '</div>';
            perfil_pf += '<div class="help-block with-errors"></div>';
            perfil_pf += '</div>';
            perfil_pf += '<div class="form-group">';
            perfil_pf += '<label for="cliente">Cliente <span class="required">*</span></label>';
            perfil_pf += '<div class="input-group">';
            perfil_pf += '<div class="input-group-addon">';
            perfil_pf += '<i class="fa fa-user fa-fw"></i>';
            perfil_pf += '</div>';
            perfil_pf += '<input type="text" class="form-control" name="cliente" id="cliente" data-error="O campo cliente é obrigatorio" required />';
            perfil_pf += '</div>';
            perfil_pf += '<div class="help-block with-errors"></div>';
            perfil_pf += '</div>';
            perfil_pf += '<div class="form-group">';
            perfil_pf += '<label for="sexo">Sexo:</label>&nbsp;&nbsp;';
            perfil_pf += '<label class="radio-inline">';
            perfil_pf += '<input type="radio" class="minimal" name="sexo" id="sexoM" value="M" required />&nbsp;Masculino';
            perfil_pf += '</label>';
            perfil_pf += '<label class="radio-inline">';
            perfil_pf += ' <input type="radio" class="minimal" name="sexo" id="sexoF" value="F" required />&nbsp;Feminino';
            perfil_pf += ' </label>';
            perfil_pf += '</div>';

            $('#perfil_pj').empty();
            var perfil_pj = '<div class="form-group">';
            perfil_pj += '<label for="cnpj">CNPJ <span class="required">*</span></label>';
            perfil_pj += '<div class="input-group">';
            perfil_pj += '<div class="input-group-addon">';
            perfil_pj += '<i class="fa fa-building-o fa-fw"></i>';
            perfil_pj += '</div>';
            perfil_pj += '<input type="text" class="form-control cnpj" onchange="return valida_cnpj(this.value)" name="cnpj" id="cnpj" data-error="O campo cnpj é obrigatorio" required autofocus />';
            perfil_pj += '</div>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += '</div>';

            perfil_pj += '<div class="form-group">';
            perfil_pj += '<label for="cliente">Empresa <span class="required">*</span></label>';
            perfil_pj += '<div class="input-group">';
            perfil_pj += '<div class="input-group-addon">';
            perfil_pj += '<i class="fa fa-building-o fa-fw"></i>';
            perfil_pj += '</div>';
            perfil_pj += '<input type="text" class="form-control" name="cliente" id="cliente" data-error="O campo empresa é obrigatorio" required />';
            perfil_pj += '</div>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += '</div>';

            perfil_pj += '<div class="form-group">';
            perfil_pj += '<label for="razao_social">Razão Social <span class="required">*</span></label>';
            perfil_pj += '<div class="input-group">';
            perfil_pj += '<div class="input-group-addon">';
            perfil_pj += '<i class="fa fa-building-o fa-fw"></i>';
            perfil_pj += '</div>';
            perfil_pj += '<input type="text" class="form-control" name="razao_social" id="razao_social" data-error="O campo razão social é obrigatorio" required />';
            perfil_pj += '</div>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += '</div>';

            perfil_pj += '<div class="form-group">';
            perfil_pj += '<label for="pessoa_contato">Pessoa/Contato <span class="required">*</span></label>';
            perfil_pj += '<div class="input-group">';
            perfil_pj += '<div class="input-group-addon">';
            perfil_pj += '<i class="fa fa-building-o fa-fw"></i>';
            perfil_pj += '</div>';
            perfil_pj += '<input type="text" class="form-control" name="pessoa_contato" id="pessoa_contato" data-error="O campo pessoa/contato é obrigatorio" required />';
            perfil_pj += '</div>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += '</div>';

            $.ajax({
                url: '<?php echo base_url(); ?>admin/cliente/get_perfil',
                type: 'POST',
                data: {
                    tipo_perfil: tipo_perfil
                },
                success: function (result)
                {
                    if (result == 'pf') {
                        //console.log(result);
                        jQuery('#perfil_pf').append(perfil_pf);
                    } else {
                        jQuery('#perfil_pj').html(perfil_pj);
                    }
                }
            });
        });
    });

    // Valida CPF 
    function valida_cpf(cpf) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/cliente/get_valida_cpf/' + cpf,
            success: function (result)
            {
                if (result == 1) {
                    Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "CPF informado é inválido."
                            });
                }
                if (result == 2) {

                    Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "CPF já cadastrado no sistema."
                            });
                }
            }
        });
    }

    // Valida CNPJ
    function valida_cnpj() {

        var cnpj = $('#cnpj').val();

        $.ajax({
            url: '<?php echo base_url(); ?>admin/cliente/get_valida_cnpj',
            type: 'POST',
            data: {
                cnpj: cnpj
            },
            success: function (result)
            {
                if (result == 1) {
                    Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "CNPJ informado é inválido."
                            });
                }
                if (result == 2) {
                    Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "CNPJ já cadastrado no sistema."
                            });
                }
            }
        });
    }

    // Valida Email
    $("#email").change(function () {

        var email = $('#email').val();

        $.ajax({
            url: '<?php echo base_url(); ?>admin/cliente/get_valida_email',
            type: 'POST',
            data: {
                email: email
            },
            success: function (result)
            {
                if (result == 1) {
                    Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "Email já cadastrado no sistema."
                            });
                }
            }
        });
    });
</script>


