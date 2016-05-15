<div class="login-box">
    <div class="login-logo">
        <a href="javascript:;"><b>Smart</b>&nbsp;ERP</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><b>Crie uma conta, é fácil e leva apenas alguns minutos!</b></p>

        <?php echo form_open(base_url('cadastro_cliente/salvar'), array('data-toggle' => 'validator')); ?>

        {MENSAGEM_SISTEMA_SUCESSO}
        {MENSAGEM_SISTEMA_ERRO}

        <div class="form-group has-feedback">
            <select class="form-control" name="tipo_perfil" id="tipo_perfil" data-error="Selecione um tipo de conta" required>
                <option value="">Selecione um tipo de conta</option>
                <option value="pf">Pessoa Física</option>
                <option value="pj">Pessoa Jurídica</option>
            </select>

            <div class="help-block with-errors"></div>
        </div>
        <div id="perfil_pf"></div>
        <div id="perfil_pj"></div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control telefone" name="telefone" id="telefone" data-error="O campo telefone é obrigatorio" placeholder="Telefone" required />
            <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control celular" name="celular" id="celular" data-error="O campo celular é obrigatorio" placeholder="Celular" required />
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>
        <hr />

        <!--<p class="login-box-msg"><b>Endereço</b></p>

        <div class="form-group has-feedback">
            <input type="text" class="form-control cep" name="cep" id="cep" data-error="O campo cep é obrigatorio" placeholder="CEP" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="endereco" id="endereco" data-error="O campo endereço é obrigatorio" placeholder="Endereço" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="numero" id="numero" data-error="O campo numero é obrigatorio" placeholder="Nº" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="complemento" id="complemento" data-error="O campo complemento é obrigatorio" placeholder="Complemento" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="bairro" id="bairro" data-error="O campo bairro é obrigatorio" placeholder="Bairro" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="cidade" id="cidade" data-error="O campo cidade é obrigatorio" placeholder="Cidade" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
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

        <p class="login-box-msg"><b>Endereço Entrega</b></p>

        <div class="form-group has-feedback">
            <input type="text" class="form-control cep" name="cep_entrega" id="cep_entrega" data-error="O campo cep é obrigatorio" placeholder="CEP" required onblur="pesquisacep(this.value);" />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="endereco_entrega" id="endereco_entrega" data-error="O campo endereço é obrigatorio" placeholder="Endereço" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="numero_entrega" id="numero_entrega" data-error="O campo numero é obrigatorio" placeholder="Nº" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="complemento_entrega" id="complemento_entrega" data-error="O campo complemento é obrigatorio" placeholder="Complemento" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="bairro_entrega" id="bairro_entrega" data-error="O campo bairro é obrigatorio" placeholder="Bairro" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="cidade_entrega" id="cidade_entrega" data-error="O campo cidade é obrigatorio" placeholder="Cidade" required />
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
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
        <hr />!-->
        <p class="login-box-msg"><b>Dados Acesso</b></p>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" data-error="O campo email é obrigatorio" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" data-error="O campo senha é obrigatorio" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
            <div class="row" id="pwd-container">
                <div class="col-sm-12">
                    <div class="pwstrength_viewport_progress"></div>
                </div>
            </div>
        </div>

        <div class="form-group has-feedback" style="margin-top: -15px;">
            <input type="password" class="form-control" name="confirme_senha" id="confirme_senha" placeholder="Confirmar Senha" data-error="O campo confirme senha é obrigatorio" required />
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
            <label for="ative">
                <input type="checkbox" class="minimal" name="ativo" id="ativo" data-error="Confirme os termos de condições" required />&nbsp;&nbsp;Eu concordo com os 
                <a href="javascript:;" data-toggle="modal" data-target="#myModal">termos</a>
                <div class="help-block with-errors"></div>
            </label>

            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
        </div>
        <?php echo form_close(); ?>

        <a href="<?php echo site_url('login'); ?>" style="font-weight: bold;">Fazer Login</a><br>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Título</h4>
                </div>
                <div class="modal-body">
                    Termos de Uso
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        //Consulta o webservice viacep.com.br/
        $("#cep").blur(function () {
            $.getJSON("https://viacep.com.br/ws/" + $("#cep").val() + "/json", function (dados) {
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#endereco").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#uf").val(dados.uf);
                    $("#numero").focus();
                }
                else {
                    alert("CEP não encontrado.");
                }
            });
        });
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
            var perfil_pf = '<div class="form-group has-feedback">';
            perfil_pf += '<input type="text" class="form-control cpf" onchange="return valida_cpf(this.value)" name="cpf" id="cpf" data-error="O campo cpf é obrigatorio" placeholder="CPF" required />';
            perfil_pf += ' <span class="glyphicon glyphicon-user form-control-feedback"></span>';
            perfil_pf += '<div class="help-block with-errors"></div>';
            perfil_pf += ' </div>';

            perfil_pf += '<div class="form-group has-feedback">';
            perfil_pf += '<input type="text" class="form-control" name="cliente" id="cliente" data-error="O campo cliente é obrigatorio" placeholder="Cliente" required />';
            perfil_pf += '<span class="glyphicon glyphicon-user form-control-feedback"></span>';
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
            var perfil_pj = '<div class="form-group has-feedback">';
            perfil_pj += '<input type="text" class="form-control cnpj" onchange="return valida_cnpj(this.value)" name="cnpj" id="cnpj" data-error="O campo cnpj é obrigatorio" placeholder="CNPJ" required />';
            perfil_pj += ' <span class="glyphicon glyphicon-user form-control-feedback"></span>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += ' </div>';

            perfil_pj += '<div class="form-group has-feedback">';
            perfil_pj += '<input type="text" class="form-control" name="cliente" id="cliente" data-error="O campo empresa é obrigatorio" placeholder="Empresa" required />';
            perfil_pj += '<span class="glyphicon glyphicon-user form-control-feedback"></span>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += '</div>';

            perfil_pj += '<div class="form-group has-feedback">';
            perfil_pj += '<input type="text" class="form-control" name="razao_social" id="razao_social" data-error="O campo razão social é obrigatorio" placeholder="Razão Social" required />';
            perfil_pj += '<span class="glyphicon glyphicon-user form-control-feedback"></span>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += '</div>';

            perfil_pj += '<div class="form-group has-feedback">';
            perfil_pj += '<input type="text" class="form-control" name="pessoa_contato" id="pessoa_contato" data-error="O campo pessoa/contato é obrigatorio" placeholder="Pessoa/Contato" required />';
            perfil_pj += '<span class="glyphicon glyphicon-user form-control-feedback"></span>';
            perfil_pj += '<div class="help-block with-errors"></div>';
            perfil_pj += '</div>';



            $.ajax({
                url: '<?php echo base_url(); ?>cadastro_cliente/get_perfil',
                type: 'POST',
                data: {
                    tipo_perfil: tipo_perfil
                },
                success: function (result)
                {
                    if (result == 'pf') {
                        //console.log(result);
                        jQuery('#perfil_pf').html(perfil_pf);
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
            url: '<?php echo base_url(); ?>cadastro_cliente/get_valida_cpf/' + cpf,
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
            url: '<?php echo base_url(); ?>cadastro_cliente/get_valida_cnpj',
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

    // Valida CNPJ
    jQuery(document).ready(function () {

        $("#email").change(function () {

            var email = $('#email').val();

            $.ajax({
                url: '<?php echo base_url(); ?>cadastro_cliente/get_valida_email',
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
    });
</script>

