<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Perfil
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('cliente/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('cliente/perfil'); ?>"><i class="fa fa-user"></i> Perfil</a>
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                {MENSAGEM_SISTEMA_ERRO}
                {MENSAGEM_SISTEMA_SUCESSO}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> {ACAOPERFIL}</h3>
                    </div>
                    <div class="box-body">

                        <?php
                        foreach ($usuario as $row):

                            echo form_open(base_url('cliente/perfil/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data'));
                            ?>

                            <input type="hidden" name="idcliente" id="idcliente" value="<?php echo $this->session->userdata('idusuario'); ?>" />
                            <input type="hidden" name="tipo_perfil" id="tipo_perfil" value="<?php echo $row->tipo_perfil; ?>" />

                            <?php if ($row->tipo_perfil == 'pf'):
                                ?>

                                <div class="form-group">
                                    <label for="cliente">Nome</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control" name="cliente" id="cliente" value="<?php echo $row->nome; ?>" data-error="O campo nome é obrigatorio" required readonly />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo $row->cpf; ?>" data-error="O campo cpf é obrigatorio" required readonly />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="sexo">Sexo:</label>
                                    <label class="radio-inline">
                                        <input type="radio" class="minimal" name="sexo" id="sexoM" value="M" <?php echo ($row->sexo == 'M') ? 'checked' : null; ?>  required />&nbsp;&nbsp;Masculino
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="minimal" name="sexo" id="sexoF" value="F" <?php echo ($row->sexo == 'F') ? 'checked' : null; ?> required />&nbsp;&nbsp;Feminino
                                    </label>
                                </div>

                            <?php else: ?>
                                <div class="form-group">
                                    <label for="cliente">Empresa</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <input type="text" class="form-control" name="cliente" id="cliente" value="<?php echo $row->nome; ?>" data-error="O campo empresa é obrigatorio" required readonly />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="cnpj">CNPJ</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <input type="text" class="form-control cnpj" name="cnpj" id="cnpj" value="<?php echo $row->cnpj; ?>" data-error="O campo cnpj é obrigatorio" required readonly />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="razao_social">Razão Social</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo $row->razao_social; ?>" data-error="O campo razão social é obrigatorio" required readonly />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="pessoa_contato">Pessoa/Contato<span class="required">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <input type="text" class="form-control" name="pessoa_contato" id="pessoa_contato" value="<?php echo $row->pessoa_contato; ?>" data-error="O campo pessoa para contato é obrigatorio" required />
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="telefone">Telefone <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control telefone" name="telefone" id="telefone" value="<?php echo $row->telefone; ?>" maxlength="13" data-error="O campo telefone é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-mobile fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control celular" name="celular" id="celular" value="<?php echo $row->celular; ?>" maxlength="14" data-error="O campo celular é obrigatorio" required />  
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row->email; ?>" data-error="O campo email é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <label>Imagem</label>
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo $this->PerfilM->get_image_url('cliente', $row->idcliente); ?>" alt="...">
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
                                            <input type="text" class="form-control cep" name="cep" id="cep" value="<?php echo $row->cep; ?>" maxlength="9" data-error="O campo cep é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="endereco">Endereço <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo $row->endereco; ?>" data-error="O campo endereço é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="numero">Nº <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $row->numero; ?>" data-error="O campo número é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="complemento">Complemento <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $row->complemento; ?>" data-error="O campo complemento é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bairro">Bairro <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $row->bairro; ?>" data-error="O campo bairro é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cidade">Cidade <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $row->cidade; ?>" data-error="O campo cidade é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="uf">UF <span class="required">*</span></label>

                                        <select class="form-control" name="uf" id="uf" data-error="Selecione um estado" required>
                                            <option value="">Selecione um estado</option>
                                            <option value="AC" <?php echo ($row->uf == 'AC') ? 'selected' : null; ?>>Acre</option>
                                            <option value="AL" <?php echo ($row->uf == 'AL') ? 'selected' : null; ?>>Alagoas</option>
                                            <option value="AP" <?php echo ($row->uf == 'AP') ? 'selected' : null; ?>>Amapá</option>
                                            <option value="AM" <?php echo ($row->uf == 'AM') ? 'selected' : null; ?>>Amazonas</option>
                                            <option value="BA" <?php echo ($row->uf == 'BA') ? 'selected' : null; ?>>Bahia</option>
                                            <option value="CE" <?php echo ($row->uf == 'CE') ? 'selected' : null; ?>>Ceará</option>
                                            <option value="DF" <?php echo ($row->uf == 'DF') ? 'selected' : null; ?>>Distrito Federal</option>
                                            <option value="ES" <?php echo ($row->uf == 'ES') ? 'selected' : null; ?>>Espírito Santo</option>
                                            <option value="GO" <?php echo ($row->uf == 'GO') ? 'selected' : null; ?>>Goiás</option>
                                            <option value="MA" <?php echo ($row->uf == 'MA') ? 'selected' : null; ?>>Maranhão</option>
                                            <option value="MT" <?php echo ($row->uf == 'MT') ? 'selected' : null; ?>>Mato Grosso</option>
                                            <option value="MS" <?php echo ($row->uf == 'MS') ? 'selected' : null; ?>>Mato Grosso do Sul</option>
                                            <option value="MG" <?php echo ($row->uf == 'MG') ? 'selected' : null; ?>>Minas Gerais</option>
                                            <option value="PA" <?php echo ($row->uf == 'PA') ? 'selected' : null; ?>>Pará</option>
                                            <option value="PB" <?php echo ($row->uf == 'PB') ? 'selected' : null; ?>>Paraíba</option>
                                            <option value="PR" <?php echo ($row->uf == 'PR') ? 'selected' : null; ?>>Paraná</option>
                                            <option value="PE" <?php echo ($row->uf == 'PE') ? 'selected' : null; ?>>Pernambuco</option>
                                            <option value="PI" <?php echo ($row->uf == 'PI') ? 'selected' : null; ?>>Piauí</option>
                                            <option value="RJ" <?php echo ($row->uf == 'RJ') ? 'selected' : null; ?>>Rio de Janeiro</option>
                                            <option value="RN" <?php echo ($row->uf == 'RN') ? 'selected' : null; ?>>Rio Grande do Norte</option>
                                            <option value="RS" <?php echo ($row->uf == 'RS') ? 'selected' : null; ?>>Rio Grande do Sul</option>
                                            <option value="RO" <?php echo ($row->uf == 'RO') ? 'selected' : null; ?>>Rondônia</option>
                                            <option value="RR" <?php echo ($row->uf == 'RR') ? 'selected' : null; ?>>Roraima</option>
                                            <option value="SC" <?php echo ($row->uf == 'SC') ? 'selected' : null; ?>>Santa Catarina</option>
                                            <option value="SP" <?php echo ($row->uf == 'SP') ? 'selected' : null; ?>>São Paulo</option>
                                            <option value="SE" <?php echo ($row->uf == 'SE') ? 'selected' : null; ?>>Sergipe</option>
                                            <option value="TO" <?php echo ($row->uf == 'TO') ? 'selected' : null; ?>>Tocantins</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

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
                                            <input type="text" class="form-control cep" name="cep_entrega" id="cep_entrega" onblur="pesquisacep(this.value);" value="<?php echo $row->cep_entrega; ?>" maxlength="9" data-error="O campo cep é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="endereco_entrega">Endereço <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="endereco_entrega" id="endereco_entrega" value="<?php echo $row->endereco_entrega; ?>" data-error="O campo endereço é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="numero_entrega">Nº <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="numero_entrega" id="numero_entrega" value="<?php echo $row->numero_entrega; ?>" data-error="O campo número é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="complemento_entrega">Complemento <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="complemento_entrega" id="complemento_entrega" value="<?php echo $row->complemento_entrega; ?>" data-error="O campo complemento é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bairro_entrega">Bairro <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="bairro_entrega" id="bairro_entrega" value="<?php echo $row->bairro_entrega; ?>" data-error="O campo bairro é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cidade_entrega">Cidade <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker fa-fw"></i>
                                            </div>
                                            <input type="text" class="form-control" name="cidade_entrega" id="cidade_entrega" value="<?php echo $row->cidade_entrega; ?>" data-error="O campo cidade é obrigatorio" required />
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="uf_entrega">UF <span class="required">*</span></label>

                                        <select class="form-control" name="uf_entrega" id="uf_entrega" data-error="Selecione um estado" required>
                                            <option value="">Selecione um estado</option>
                                            <option value="AC" <?php echo ($row->uf_entrega == 'AC') ? 'selected' : null; ?>>Acre</option>
                                            <option value="AL" <?php echo ($row->uf_entrega == 'AL') ? 'selected' : null; ?>>Alagoas</option>
                                            <option value="AP" <?php echo ($row->uf_entrega == 'AP') ? 'selected' : null; ?>>Amapá</option>
                                            <option value="AM" <?php echo ($row->uf_entrega == 'AM') ? 'selected' : null; ?>>Amazonas</option>
                                            <option value="BA" <?php echo ($row->uf_entrega == 'BA') ? 'selected' : null; ?>>Bahia</option>
                                            <option value="CE" <?php echo ($row->uf_entrega == 'CE') ? 'selected' : null; ?>>Ceará</option>
                                            <option value="DF" <?php echo ($row->uf_entrega == 'DF') ? 'selected' : null; ?>>Distrito Federal</option>
                                            <option value="ES" <?php echo ($row->uf_entrega == 'ES') ? 'selected' : null; ?>>Espírito Santo</option>
                                            <option value="GO" <?php echo ($row->uf_entrega == 'GO') ? 'selected' : null; ?>>Goiás</option>
                                            <option value="MA" <?php echo ($row->uf_entrega == 'MA') ? 'selected' : null; ?>>Maranhão</option>
                                            <option value="MT" <?php echo ($row->uf_entrega == 'MT') ? 'selected' : null; ?>>Mato Grosso</option>
                                            <option value="MS" <?php echo ($row->uf_entrega == 'MS') ? 'selected' : null; ?>>Mato Grosso do Sul</option>
                                            <option value="MG" <?php echo ($row->uf_entrega == 'MG') ? 'selected' : null; ?>>Minas Gerais</option>
                                            <option value="PA" <?php echo ($row->uf_entrega == 'PA') ? 'selected' : null; ?>>Pará</option>
                                            <option value="PB" <?php echo ($row->uf_entrega == 'PB') ? 'selected' : null; ?>>Paraíba</option>
                                            <option value="PR" <?php echo ($row->uf_entrega == 'PR') ? 'selected' : null; ?>>Paraná</option>
                                            <option value="PE" <?php echo ($row->uf_entrega == 'PE') ? 'selected' : null; ?>>Pernambuco</option>
                                            <option value="PI" <?php echo ($row->uf_entrega == 'PI') ? 'selected' : null; ?>>Piauí</option>
                                            <option value="RJ" <?php echo ($row->uf_entrega == 'RJ') ? 'selected' : null; ?>>Rio de Janeiro</option>
                                            <option value="RN" <?php echo ($row->uf_entrega == 'RN') ? 'selected' : null; ?>>Rio Grande do Norte</option>
                                            <option value="RS" <?php echo ($row->uf_entrega == 'RS') ? 'selected' : null; ?>>Rio Grande do Sul</option>
                                            <option value="RO" <?php echo ($row->uf_entrega == 'RO') ? 'selected' : null; ?>>Rondônia</option>
                                            <option value="RR" <?php echo ($row->uf_entrega == 'RR') ? 'selected' : null; ?>>Roraima</option>
                                            <option value="SC" <?php echo ($row->uf_entrega == 'SC') ? 'selected' : null; ?>>Santa Catarina</option>
                                            <option value="SP" <?php echo ($row->uf_entrega == 'SP') ? 'selected' : null; ?>>São Paulo</option>
                                            <option value="SE" <?php echo ($row->uf_entrega == 'SE') ? 'selected' : null; ?>>Sergipe</option>
                                            <option value="TO" <?php echo ($row->uf_entrega == 'TO') ? 'selected' : null; ?>>Tocantins</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="well">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>
                            <?php
                            echo form_close();
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> {ACAOSENHA}</h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open(base_url('cliente/perfil/salvar_senha'), array('data-toggle' => 'validator')); ?>

                        <input type="hidden" name="idcliente" id="idcliente" value="<?php echo $this->session->userdata('idusuario'); ?>" />

                        <div class="form-group">

                            <label for="senha">Senha Atual <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock fa-fw"></i>
                                </div>
                                <input type="password" class="form-control" name="senha" id="senha" data-error="O campo senha atual é obrigatorio" required />               
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">

                            <label for="senha">Nova Senha <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock fa-fw"></i>
                                </div>
                                <input type="password" class="form-control" name="nova_senha" id="nova_senha" data-error="O campo nova senha é obrigatorio" required />               
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">

                            <label for="senha">Confirme/Nova Senha <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock fa-fw"></i>
                                </div>
                                <input type="password" class="form-control" name="confirme_senha" id="confirme_senha" data-error="O campo confirme nova senha é obrigatorio" required />               
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="well">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
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
                    jQuery("#numero").focus();
                }
                else {
                    alert("CEP não encontrado.");
                }
            });
        });
        var uf = jQuery("#uf").val(dados.uf);
    });

</script>

<script>

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
    ;

</script>
