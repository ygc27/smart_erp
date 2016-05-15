<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart ERP | Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url('assets/css/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo base_url('assets/plugins/iCheck/all.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/Lobibox.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js'); ?>" type="text/javascript"></script>
        <script>
            function copiar(email, senha)
            {
                document.getElementById("email").value = email;
                document.getElementById("senha").value = senha;
            }
        </script>
    </head>
    <body class="login-page">

        {CONTEUDO}
        <!-- JS -->
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/js/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap Validator -->
        <script src="<?php echo base_url('assets/js/validator.js'); ?>"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery.mask.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/pwstrength.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/lobibox.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
        <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        </script>
    </body>
</html>
