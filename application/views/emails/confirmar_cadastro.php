<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Smart ERP</title>
    </head>
    <body>
        <h2>Smart ERP</h2>
        <h3> Confirmação de cadastro. </h3>
        <p>Olá: <?php echo $nome ?>.<br> Muito obrigado por se cadastrar em nosso sistema.</p>
        <p>Para concluir seu cadastro e liberar sua conta para compras clique no link abaixo.</p>
        <p><a href="<?php echo base_url("cadastro_cliente/validacao_cadastro/" . md5($email)) ?>">Concluir cadastro!</a></p>
        <h4>Seja bem vindo, e boas compras!<br>Smart ERP. </h4>
    </body>
</html>