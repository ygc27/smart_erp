<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Fornecedor
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/fornecedor'); ?>"><i class="fa fa-truck"></i> Fornecedores</a>
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
            <?php echo form_open(base_url('admin/fornecedor/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data')); ?>
            <input type="hidden" name="idfornecedor" id="idfornecedor" value="{idfornecedor}" />

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Dados do Fornecedor - {ACAO}</h3>
                    </div>
                    <div class="box-body">


                        <div class="form-group">
                            <label for="fornecedor">Fornecedor <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-building-o fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="fornecedor" id="fornecedor" data-error="O campo fornecedor é obrigatorio" required autofocus />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="nome">Pessoa/Contato <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-male fa-fw"></i>
                                </div>
                                <input type="text" class="form-control" name="nome" id="nome" data-error="O campo nome é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

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
                            <label for="sexo">Sexo:</label>
                            <label class="radio-inline">
                                <input type="radio" class="minimal" name="sexo" id="sexoM" value="M" required />&nbsp;&nbsp;Masculino
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="minimal" name="sexo" id="sexoF" value="F" required />&nbsp;&nbsp;Feminino
                            </label>
                        </div>

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
                    </div>
                </div>

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
                        <h3 class="box-title">Dados Bancários</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="banco">Banco <span class="required">*</span></label>
                            <select class="form-control select2" name="banco" id="tipo_perfil" data-error="Selecione um banco" required>
                                <option value="">Selecione um banco</option>
                                <option value="itau">Itau</option>
                                <option value="bradesco">Bradesco</option>
                                <option value="santander">Santander</option>
                                <option value="caixa_economica">Caixa Economica</option>
                                <option value="banco_brasil">Banco de Brasil</option>
                                <option value="citibank">Citibank</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="agencia">Agencia <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bank"></i>
                                </div>
                                <input type="text" class="form-control" name="agencia" id="agencia" data-error="O campo agencia é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="conta">Conta <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bank"></i>
                                </div>
                                <input type="text" class="form-control" name="conta" id="conta" data-error="O campo conta é obrigatorio" required />
                            </div>
                            <div class="help-block with-errors"></div>
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

        //Consulta o webservice viacep.com.br/
        jQuery("#cep").blur(function () {
            jQuery.getJSON("https://viacep.com.br/ws/" + jQuery("#cep").val() + "/json", function (dados) {
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    jQuery("#endereco").val(dados.logradouro);
                    jQuery("#bairro").val(dados.bairro);
                    jQuery("#cidade").val(dados.localidade);
                    jQuery("#uf").val(dados.uf);
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
            url: '<?php echo base_url(); ?>admin/fornecedor/get_valida_email',
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

