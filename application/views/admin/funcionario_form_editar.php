<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Funcionários
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/funcionario'); ?>"><i class="fa fa-users"></i> Funcionários</a>
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
            <?php echo form_open(base_url('admin/funcionario/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data')); ?>
            <input type="hidden" name="idfuncionario" id="idfornecedor" value="{idfuncionario}" />

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Funcionário - {ACAO}</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="nome" id="nome" value="{nome}" data-error="O campo nome é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="sexo">Sexo: <span class="required">*</span></label>
                                <label class="radio-inline">
                                    <input type="radio" class="minimal" name="sexo" id="sexoM" value="M" {sexo_M} required />&nbsp;&nbsp;Masculino
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="minimal" name="sexo" id="sexoF" value="F" {sexo_F} required />&nbsp;&nbsp;Feminino
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="departamento">Departamento: <span class="required">*</span></label>
                                <label class="radio">
                                    <input type="radio" class="minimal" name="departamento" id="departamentoV" value="V" {departamento_V} required />&nbsp;&nbsp;Vendas
                                </label>
                                <label class="radio">
                                    <input type="radio" class="minimal" name="departamento" id="departamentoC" value="C" {departamento_C} required />&nbsp;&nbsp;Compras
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control telefone" name="telefone" id="telefone" value="{telefone}" maxlength="13" data-error="O campo telefone é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-mobile fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control celular" name="celular" id="celular" value="{celular}" maxlength="14" data-error="O campo celular é obrigatorio" required />  
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <label>Imagem</label>
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo $this->FuncionarioM->get_image_url('funcionario', $idfuncionario); ?>" alt="...">
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
                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Endereço</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cep">CEP <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control cep" name="cep" id="cep" value="{cep}" maxlength="9" data-error="O campo cep é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="endereco">Endereço <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="endereco" id="endereco" value="{endereco}" data-error="O campo endereço é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="numero">Nº <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="numero" id="numero" value="{numero}" data-error="O campo número é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="complemento">Complemento <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="complemento" id="complemento" value="{complemento}" data-error="O campo complemento é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="bairro">Bairro <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="bairro" id="bairro" value="{bairro}" data-error="O campo bairro é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="cidade">Cidade <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="cidade" id="cidade" value="{cidade}" data-error="O campo cidade é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="uf">UF <span class="required">*</span></label>

                                <select class="form-control select2" name="uf" id="uf" data-error="Selecione um estado" required>
                                    <option value="AC" {uf_AC} selected="selected">Acre</option>
                                    <option value="AL" {uf_AL}>Alagoas</option>
                                    <option value="AP" {uf_AP}>Amapá</option>
                                    <option value="AM" {uf_AM}>Amazonas</option>
                                    <option value="BA" {uf_BA}>Bahia</option>
                                    <option value="CE" {uf_CE}>Ceará</option>
                                    <option value="DF" {uf_DF}>Distrito Federal</option>
                                    <option value="ES" {uf_ES}>Espírito Santo</option>
                                    <option value="GO" {uf_GO}>Goiás</option>
                                    <option value="MA" {uf_MA}>Maranhão</option>
                                    <option value="MT" {uf_MT}>Mato Grosso</option>
                                    <option value="MS" {uf_MS}>Mato Grosso do Sul</option>
                                    <option value="MG" {uf_MG}>Minas Gerais</option>
                                    <option value="PA" {uf_PA}>Pará</option>
                                    <option value="PB" {uf_PB}>Paraíba</option>
                                    <option value="PR" {uf_PR}>Paraná</option>
                                    <option value="PE" {uf_PE}>Pernambuco</option>
                                    <option value="PI" {uf_PI}>Piauí</option>
                                    <option value="RJ" {uf_RJ}>Rio de Janeiro</option>
                                    <option value="RN" {uf_RN}>Rio Grande do Norte</option>
                                    <option value="RS" {uf_RS}>Rio Grande do Sul</option>
                                    <option value="RO" {uf_RO}>Rondônia</option>
                                    <option value="RR" {uf_RR}>Roraima</option>
                                    <option value="SC" {uf_SC}>Santa Catarina</option>
                                    <option value="SP" {uf_SP}>São Paulo</option>
                                    <option value="SE" {uf_SE}>Sergipe</option>
                                    <option value="TO" {uf_TO}>Tocantins</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    <input type="email" class="form-control" name="email" id="email" value="{email}" data-error="O campo email é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock fa-fw"></i>
                                    </div>
                                    <input type="password" class="form-control" name="senha" id="senha" />               
                                </div>
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
                                    <input type="checkbox" class="minimal" name="ativo" id="ativo" value="S" {ativo}>&nbsp;&nbsp;Ativo
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
        var uf = jQuery("#uf").val(dados.uf);

    });

    $("#email").change(function () {
        var email = $('#email').val();

        //alert(email);

        $.ajax({
            url: '<?php echo base_url(); ?>admin/funcionario/get_valida_email',
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