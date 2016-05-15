<div class="login-box">
    <div class="login-logo">
        <a href="javascript:;"><b>Smart</b>&nbsp;ERP</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><b>Concluir Cadastro!</b></p>

        <?php
        foreach ($cliente as $row):

            echo form_open(base_url('cadastro_cliente/concluir_cadastro'), array('data-toggle' => 'validator'));
            ?>

            {MENSAGEM_SISTEMA_SUCESSO}
            {MENSAGEM_SISTEMA_ERRO}

            <?php if ($row->cpf): ?>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control cpf" name="cpf" value="<?php echo $row->cpf; ?>" readonly />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nome" value="<?php echo $row->nome; ?>" readonly />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" value="<?php echo $row->email; ?>" readonly />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

            <?php else: ?>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control cnpj" name="cnpj" value="<?php echo $row->cnpj; ?>" readonly />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nome" value="<?php echo $row->nome; ?>" readonly />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" value="<?php echo $row->email; ?>" readonly />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="pessoa_contato" value="<?php echo $row->pessoa_contato; ?>" readonly />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="razao_social" value="<?php echo $row->razao_social; ?>" readonly />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
            <?php endif; ?>
            <div class="form-group has-feedback">
                <input type="text" class="form-control telefone" name="telefone" id="telefone" value="<?php echo $row->telefone; ?>" readonly />
                <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
                <input type="text" class="form-control celular" name="celular" id="celular" value="<?php echo $row->celular; ?>" readonly />
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                <div class="help-block with-errors"></div>
            </div>
            <hr />

            <p class="login-box-msg"><b>Endereço</b></p>

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

            <input type="hidden" name="idcliente" id="idcliente" value="<?php echo $row->idcliente; ?>" />

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Concluir</button>
            </div>

            <?php
            echo form_close();
        endforeach;
        ?>
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
</script>

